<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\StudyCase;
use Illuminate\Http\Request;

class RankController extends Controller
{

    public function index()
    {
        $studyCase = StudyCase::with('rank.user')->get();
        return response()->view('ranks', [
            'title' => 'Result',
            'studyCase' => $studyCase
        ]);
    }

    public function detail($id)
    {
        $ranks = Rank::with('user')->where('study_case_id', $id)->get();
        return response()->view('ranksdetail', [
            'title' => 'Result',
            'ranks' => $ranks
        ]);
    }
}
