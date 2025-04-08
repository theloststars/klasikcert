<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $domain = 'crowncerticheck.com';
    public function __construct()
    {
        $this->middleware('can:users create')->only(['create', 'store']);
        $this->middleware('can:users read')->only('index');
        $this->middleware('can:users update')->only(['edit', 'update']);
        $this->middleware('can:users delete')->only(['destroy', 'massDelete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->latest()->get();

        // return $users;

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $emailDomain = explode('@', $request->email)[1];

        if ($this->domain != $emailDomain) {
            event(new Registered($user));
        } else {
            $user->markEmailAsVerified();
        }

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
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
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)]
        ]);

        if ($request->password || $request->password_confirmation) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required']
            ]);
        }

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->password || $request->password_confirmation) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return User::find($id)->hasRole('super admin');
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot delete your self !');
        }

        if (Auth::user()->hasRole('admin') && User::find($id)->hasRole('super admin')) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot delete user who had Super Admin role !');
        }

        if (Auth::user()->hasRole('admin') && User::find($id)->hasRole('admin')) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot delete user who had Admin role !');
        }

        User::destroy($id);

        return redirect()->route('admin.users.index')->with('success', 'User deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);

        foreach ($arr as $id) {
            if (Auth::user()->id != $id) {
                User::destroy($id);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Bulk delete success');
    }
}
