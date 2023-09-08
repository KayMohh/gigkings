<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show Register / Create Form

    public function create()
    {
        return view('users.register');
    }

    // Store User

    public function store(Request $request)
    {
        $formFields = $request->calidate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);


        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'Registration and Login Successful');
    }
}
