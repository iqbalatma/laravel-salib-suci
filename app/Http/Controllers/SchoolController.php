<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::all();
        return response()->view('schools.index', [
            'title' => 'Nama Sekolah',
            'school' => $school
        ]);
    }

    public function store(Request $request)
    {
        School::create($request->input());
        return redirect()->route('school.index');
    }

    public function edit($id)
    {
        $schools = School::find($id);

        return response()->view('schools.edit', [
            'title' => 'Edit Sekolah',
            'schools' => $schools
        ]);
    }

    public function update(Request $request)
    {
        School::where('id', $request->input('id'))->update(['name' => $request->input('name')]);
        return redirect()->route('school.index');
    }

    public function delete($id)
    {
        School::destroy($id);
        return redirect()->route('school.index');
    }
}
