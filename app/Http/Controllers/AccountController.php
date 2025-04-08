<?php

namespace App\Http\Controllers;

use App\Mail\SendNewEmailVerification;
use App\Models\PendingNewEmail;
use App\Models\User;
use App\Notifications\NewEmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
// use Illuminate\Auth\Events\Registered;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('password.confirm')->only('edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('accounts.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('accounts.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = 'Profile updated !';
        $user = Auth::user();

        if ($request->name || $request->email) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
            ]);

            $user->update([
                'name' => $request->name,
            ]);
        }

        if ($request->password || $request->password_confirmation) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required']
            ]);
        }

        if ($request->image) {
            $request->validate([
                'image' => ['required', 'file', 'image']
            ]);
            
            if (Storage::exists('public/photoProfiles/' . $user->image)) {
                Storage::delete('public/photoProfiles/' . $user->image);
            }

            $file = $request->file('image');
            $fileName = $file->hashName();
            $file->storeAs('public/photoProfiles', $fileName);
            $user->update([
                'image' => $fileName
            ]);
        }

        // if email changed
        if ($request->email) {
            if ($user->email != $request->email) {
                $token = uniqid();
    
                $user->pendingNewEmails()->create([
                    'new_email' => $request->email,
                    'token' => $token
                ]);
    
                // $user->notify(new NewEmailVerification($token));
                Mail::to($request->email)->send(new SendNewEmailVerification($token));
                $message = 'Profile updated, and you have to check your inbox to verify your new email address';
            }
        }

        if ($request->password) {
            if ($request->password || $request->password_confirmation) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
        }

        return redirect()->route('account.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verifyNewEmail($token)
    {
        $user = Auth::user();
        $newEmail = PendingNewEmail::where('token', $token)->firstOrFail();

        $checkEmail = User::where('email', $newEmail->new_email)->first();

        $pendingNewEmails = PendingNewEmail::where('user_id', $user->id)->get()->pluck('id');

        if (!$checkEmail) {
            $user->update([
                'email' => $newEmail->new_email
            ]);

            // $newEmail->delete();

            PendingNewEmail::destroy($pendingNewEmails);

            return redirect()->route('account.index')->with('success', 'Email updated !');
        }

        // $newEmail->delete();

        PendingNewEmail::destroy($pendingNewEmails);

        return redirect()->route('account.index')->with('warning', 'You cannot use this email !');
    }
}
