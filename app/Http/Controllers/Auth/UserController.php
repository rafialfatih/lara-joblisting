<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view("users.register");
    }

    public function store(StoreUserRequest $request)
    {
        $formFields = $request->validated();

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created successfully! You are now logged in!');
    }
}
