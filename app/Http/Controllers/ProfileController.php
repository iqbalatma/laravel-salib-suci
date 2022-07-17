<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\TeacherDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return response()->view('profile', [
            'title' => 'Profile',
            'teacherDetails' => TeacherDetail::where('user_id', Auth::id())->first(),
            'schools' => School::all()
        ]);
    }

    public function update(Request $request)
    {
        $dataUser = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'name' => $request->input('name')
        ];

        User::where('id', $request->input('id'))->update($dataUser);
        TeacherDetail::where('user_id', $request->input('id'))->update($request->except('_token', '_method', 'username', 'name', 'email'));


        return redirect()->route('teacherDetail.profile')->with('success', 'Update informasi guru berhasil !');
    }
}
