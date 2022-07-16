<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return response()->view('user.index', [
            'title' => 'Data Guru',
            'teacherDetails' => User::with('teacherDetail')->where('role_id', 1)->get()
        ]);
    }
}
