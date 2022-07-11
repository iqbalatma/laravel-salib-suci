<?php

namespace App\Http\Controllers;

use App\Models\StudyCase;
use App\Models\User;
use Illuminate\Http\Request;

class CriteriaPairController extends Controller
{
    public function show(Request $request)
    {

        $studyCase = StudyCase::with('criteria.subcriteria')
            ->where('id', $request->input('studyCaseId'))
            ->first();
        $alternative = User::where('role_id', 1)
            ->whereIn('id', $request->input('idAlternative'))
            ->get();

        return response()->view('criteriapairs.criteriapair', [
            'title' => 'Criteria Pair',
            "studyCase" => $studyCase,
            "alternative" => $alternative
        ]);
    }
}
