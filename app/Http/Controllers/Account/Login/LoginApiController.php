<?php

namespace App\Http\Controllers\Account\Login;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $data=[
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            $user = Auth::user();
            $token = $user->createToken('healtcare')->accessToken;
            return response()->json(['token' => $token],200);
        }else {
            return response()->json(['error' => 'unauthorised']);
        }
    }
}
