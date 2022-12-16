<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Utilities\ProxyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    protected $proxy;

    public function __construct(ProxyRequest $proxy)
    {
        $this->proxy = $proxy;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'role' => 'user',
            'password' => bcrypt(request('password')),
        ]);

        $resp = $this->proxy->grantPasswordToken(
            $user->email,
            request('password')
        );

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
            'message' => 'Your account has been created',
            'user' => $user->only(['name', 'email', 'role'])
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', request('email'))->first();

        abort_unless($user, 404, 'User does not exist.');
        abort_unless(
            Hash::check(request('password'), $user->password),
            403,
            'Invalid password.'
        );

        $resp = $this->proxy
            ->grantPasswordToken(request('email'), request('password'));

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
            'message' => 'You have been logged in',
            'user' => $user->only(['name', 'email', 'role'])
        ], 200);
    }

    public function refreshToken()
    {
        $resp = $this->proxy->refreshAccessToken();

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
            'message' => 'Token has been refreshed.',
        ], 200);
    }

    public function logout()
    {
        $token = request()->user()->token();
        $token->delete();

        // remove the httponly cookie
        cookie()->queue(cookie()->forget('refresh_token'));

        return response([
            'message' => 'You have been successfully logged out',
        ], 200);
    }
}
