<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function create()
    {
        return view("users.register");
    }
}
