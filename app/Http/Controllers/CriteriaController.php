<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Rank;
use App\Models\StudyCase;
use App\Models\SubCriteria;
use App\Models\User;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index($id)
    {
        $studyCase = StudyCase::with('criteria.subcriteria')->where('id', $id)->first();
        $alternative = User::where('role_id', 1)->get();
        $rank = Rank::with('user')->where('study_case_id', $id)->get();


        return response()->view('detailCriteria', [
            'title' => "Detail Criteria",
            'studyCase' => $studyCase,
            'alternative' => $alternative,
            'rank' => $rank
        ]);
    }

    public function store(Request $request)
    {
        $criteria =  Criteria::create([
            'criteria_name' => $request->input('criteria_name'),
            'study_case_id' =>  $request->input('id_studyCase'),
        ]);

        SubCriteria::create(['criteria_id' => $criteria->id]);

        return redirect()->route('criteria.show', $request->input('id_studyCase'));
    }

    public function destroy($id, $idStudyCase)
    {
        SubCriteria::where('criteria_id', $id)->delete();
        Criteria::destroy($id);

        return redirect()->route('criteria.show', $idStudyCase);
    }
}
