<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'country_id' => 'required'
        ]);

        return $request;

        /*
        

        $user->roles()->attach(2);

        return response()->json($user);

        */
    }
}