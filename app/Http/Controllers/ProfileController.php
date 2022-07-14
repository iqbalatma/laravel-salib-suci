<?php

namespace App\Http\Controllers;

use App\Models\DetailGuru;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return response()->view('profile', [
            'title' => 'Profile',
            'detailGuru' => DetailGuru::where('user_id', Auth::id())->first(),
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
        DetailGuru::where('user_id', $request->input('id'))->update($request->except('_token', '_method', 'username', 'name', 'email'));


        return redirect()->route('detail_guru.profile');
    }
}
