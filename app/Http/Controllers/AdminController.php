<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        return view('admin.dashboard',compact('usersCount'));
    }
}
