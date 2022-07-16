<?php

namespace App\Http\Controllers;

use App\Models\StudyCase;
use App\Models\User;
use Illuminate\Http\Request;

class CriteriaPairController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('idAlternative') == null || count($request->input('idAlternative')) < 2) {
            return redirect()->back()->with('error', 'Minimal pilih 2 alternaitf !');
        };
        $studyCase = StudyCase::with('criteria.subcriteria')
            ->where('id', $request->input('studyCaseId'))
            ->first();
        $alternative = User::where('role_id', 1)
            ->whereIn('id', $request->input('idAlternative'))
            ->get();

        if (count($studyCase->criteria) < 3) {
            return redirect()->back()->with('error', 'Minimal gunakan 3 kriteria !');
        }

        return response()->view('criteria-pairs.index', [
            'title' => 'Criteria Pair',
            "studyCase" => $studyCase,
            "alternative" => $alternative
        ]);
    }
}
