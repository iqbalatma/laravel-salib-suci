<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{

    public function index()
    {

        $teacherDetails = User::with('teacherDetail.school')->where('role_id', 1)->get();
        // dd($teacherDetails);
        return response()->view('user.index', [
            'title' => 'Data Guru',
            'teacherDetails' => $teacherDetails
        ]);
    }
}
