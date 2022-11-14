<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->client = DB::table('oauth_clients')->where('password_client', true)->first();
    // }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $data['role'] = 'user';

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        $response = Http::asForm()->post(env("APP_URL", "http://localhost") . '/oauth/token', [
            'grant_type' => 'password',
            // 'client_id' => $this->client->id,
            'client_id' => '3',
            // 'client_secret' => $this->client->secret,
            'client_secret' => 'e3HC5KvOhzVwstVUkaSsFeBee9u7pyBX8DPzyna9',
            'username' => $data['email'],
            'password' => $request->password,
            'scope' => '',
        ]);

        return response(['user' => $user, 'tokens' => $response]);
        // return $response;
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // if (!auth()->attempt($data)) {
        //     return response(['error_message' => 'Incorrect Details.
        //     Please try again']);
        // }

        // $token = auth()->user()->createToken('API Token')->accessToken;
        $response = Http::asForm()->post(env("APP_URL", "http://localhost") . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $data['email'],
            'password' => $request->password,
            'scope' => '',
        ]);

        return response(['user' => auth()->user(), 'tokens' => $response]);
        // return $response;
    }
}
