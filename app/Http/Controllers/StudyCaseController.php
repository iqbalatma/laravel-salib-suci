<?php

namespace App\Http\Controllers;

use App\Models\StudyCase;
use Illuminate\Http\Request;

class StudyCaseController extends Controller
{
  public function index()
  {
    $studyCase = StudyCase::all();
    return response()->view('studycase', [
      'title' => 'Study Case',
      'studyCase' => $studyCase
    ]);
  }

  public function store(Request $request)
  {
    $caseName = $request->input('case_name');

    StudyCase::create(['case_name' => $caseName]);

    return redirect()->route('studycase.show');
  }
}
