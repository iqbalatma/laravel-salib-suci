<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::all();
        return response()->view('sekolah', [
            'title' => 'Nama Sekolah',
            'sekolah' => $sekolah
        ]);
    }

    public function store(Request $request)
    {
        Sekolah::create($request->input());
        return redirect()->route('sekolah.show');
    }

    public function edit($id)
    {
        $sekolah = Sekolah::find($id);

        return response()->view('editsekolah', [
            'title' => 'Edit Sekolah',
            'sekolah' => $sekolah
        ]);
    }

    public function update(Request $request)
    {
        Sekolah::where('id', $request->input('id'))->update(['nama_sekolah' => $request->input('nama_sekolah')]);
        return redirect()->route('sekolah.show');
    }

    public function delete($id)
    {
        Sekolah::destroy($id);
        return redirect()->route('sekolah.show');
    }
}
