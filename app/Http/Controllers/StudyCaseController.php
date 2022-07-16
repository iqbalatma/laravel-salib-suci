<?php

namespace App\Http\Controllers;

use App\Models\StudyCase;
use Illuminate\Http\Request;

class StudyCaseController extends Controller
{
  public function index()
  {
    $studyCase = StudyCase::with('criteria')->get();
    return response()->view('study-case.index', [
      'title' => 'Study Case',
      'studyCase' => $studyCase
    ]);
  }

  public function store(Request $request)
  {
    $caseName = $request->input('case_name');

    $studyCase = StudyCase::create(['case_name' => $caseName]);

    return redirect()->route('studycase.show')->with('success', "Tambah study case $studyCase->case_name berhasil !");
  }

  public function destroy(Request $request)
  {
    $id = $request->input('id');
    StudyCase::destroy($id);
    return redirect()->route('studycase.show')->with('success', "Hapus study case berhasil !");
  }
}
