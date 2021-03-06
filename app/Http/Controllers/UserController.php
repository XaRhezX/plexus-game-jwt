<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        $users = User::WithSum('Coins','total')->WithSum('Experiences','total')->paginate();
        return view('users.index', compact('users'));
    }
}
