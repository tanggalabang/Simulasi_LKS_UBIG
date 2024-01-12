<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\Actor;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string|min:2|max:20',
            'last_name' => 'required|string|min:2|max:20',
            'username' => 'required|min:2|max:12',
            'password' => 'required|min:5|max:12'
        ]);

        $create = Actor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'password' => $request->password,
            'token' => md5($request->username)
        ]);

       

        return response()->json(['message'=> 'Register success','token'=> $create->token], 200);
    }

    public function login(Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //get actor
        $actor = Actor::where('username', $request->username)
            ->where('password', md5($request->password))
            ->first();

        // check actor 
        if(!$actor) return response()->json(['message'=>'Invalid login'], 401);

        // update token
        $token = md5($request->username);
        $actor->update(['token' => $token]);

        return response()->json(['message'=> 'Login success', 'token'=> $actor->token], 200);
    }

    public function logout(Request $request) {

        // get token
        $token = $request->query('token');
        // get actor
        $actor = Actor::where('token', $token)->first();
        //check actor
        if(!$actor) return request()->json(['message' => 'Logout failed'], 401);

        //update token
        $actor->update(['token' => null]);

        return response()->json(['message'=> 'logout success'], 200);
    }
}
