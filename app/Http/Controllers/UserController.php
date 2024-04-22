<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function reguister()
    {
        return view('users.registerUsers');
    }
}
