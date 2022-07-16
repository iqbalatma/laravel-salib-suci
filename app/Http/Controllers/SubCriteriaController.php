<?php

namespace App\Http\Controllers;

use App\Models\SubCriteria;
use Illuminate\Http\Request;

class SubCriteriaController extends Controller
{
    public function update(Request $request)
    {
        $dataSubCriteria = [
            'very_good' => $request->input('very_good') ?? "",
            'good' => $request->input('good') ?? "",
            'enough' => $request->input('enough') ?? "",
            'less' => $request->input('less') ?? "",
        ];

        SubCriteria::where('criteria_id', $request->input('criteria_id'))
            ->update($dataSubCriteria);

        return redirect()->route('criteria.show', $request->input('id_studyCase'))->with('success', 'Sub kriteria berhasil diperbaharui !');
    }
}
