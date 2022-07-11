<?php

namespace App\Http\Controllers;

use App\Models\DetailGuru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        return response()->view('user.index', [
            'title' => 'Data Guru',
            'dataGuru' => User::with('detail_guru')->where('role_id', 1)->get()
        ]);
    }
}
