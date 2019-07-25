<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct(User $user)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard');
    }
}
