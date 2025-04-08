<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout']);
    }

    public function register(Request $request)
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

        SendEmailVerification::dispatch($user);


        $client = DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first();

        if (!$client) {
            return response()->json(['message' => 'client not found, please run php artisan passport:install in target backend server'], 500);
        }

        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        return response()->json([
            'user' => $user,
            'tokens' => json_decode($response)
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $client = DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first();

        if (!$client) {
            return response()->json(['message' => 'client not found, please run php artisan passport:install in target backend server'], 500);
        }

        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        return response()->json(json_decode($response));
    }

    public function logout(Request $request)
    {
        $revoking = $request->user()->token()->revoke();

        if ($revoking) {
            return response()->json([
                'message' => 'token revoked.',
                'status' => true
            ]);
        } else {
            return response()->json([
                'message' => 'failed',
                'status' => false
            ]);
        }
    }

    public function refresh_token(Request $request)
    {
        $request->validate([
            'refresh_token' => ['required']
        ]);

        $client = DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first();

        if (!$client) {
            return response()->json(['message' => 'client not found, please run php artisan passport:install in target backend server'], 500);
        }

        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '',
        ]);

        return response()->json(json_decode($response));
    }
}
