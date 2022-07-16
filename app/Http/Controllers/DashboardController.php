<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\StudyCase;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teachers = User::where('role_id', 1)->get();
        $schools = School::all();
        $studyCase = StudyCase::all();
        return response()->view('dashboard', [
            'title' => 'Dashboard',
            'teachers' => $teachers,
            'school' => $schools,
            'studyCase' => $studyCase
        ]);
    }
}
