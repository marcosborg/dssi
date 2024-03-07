<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\Company;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:App\Models\User,email|max:255',
            'password' => ['required', 'max:255', 'confirmed', Password::min(8)],
            'address' => 'required|max:255',
            'company_name' => 'required|max:255',
            'country_id' => 'required',
            'location' => 'required|max:255',
            'vat' => 'required|max:255',
            'zip' => 'required|max:255',
            'phone' => 'required|max:255',
        ], [], [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password confirmation',
            'address' => 'Address',
            'company_name' => 'Company name',
            'country_id' => 'Country',
            'location' => 'Location',
            'vat' => 'VAT number',
            'zip' => 'ZIP code',
            'phone' => 'Phone number',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->roles()->attach(2);

        $company = new Company;
        $company->name = $request->company_name;
        $company->address = $request->address;
        $company->zip = $request->zip;
        $company->location = $request->location;
        $company->phone = $request->phone;
        $company->vat = $request->vat;
        $company->country_id = $request->country_id;
        $company->type = 'user';
        $company->user_id = $user->id;
        $company->save();

        return $user;

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }

    public function user(Request $request)
    {
        $user = $request->user()->load('company');
        return $user;
    }
}