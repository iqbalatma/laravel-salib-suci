<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use App\Services\CalculationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RankController extends Controller
{

  public function setRank(Request $request)
  {
    $idStudyCase = $request->input('studyCaseId');
    $finalResult = $request->input('finalResult');


    Rank::where('study_case_id', $idStudyCase)->delete();


    foreach ($finalResult as $key => $item) {
      Rank::create([
        'rank' => $item['rank'],
        'total' => round($item['sum'], 2),
        'study_case_id' => $idStudyCase,
        'user_id' => $item['idAlternativeSet']
      ]);
    }

    $response = [
      'idStudyCase' => $idStudyCase,
      'finalResult' => $finalResult,
    ];


    return response($response, Response::HTTP_OK);
  }
}
