<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CalculationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CalculationController extends Controller
{
  private CalculationService $criteriaCalculationService;
  private CalculationService $subCriteriaCalculationService;

  public function __construct()
  {
    $this->criteriaCalculationService = new CalculationService();
    $this->subCriteriaCalculationService = new CalculationService();
  }
  public function calculate(Request $request)
  {
    $matrix = $request->input('matrix');
    $matrix = [
      [1, 4, 3, 5, 7],
      [0.25, 1, 3, 2, 7],
      [0.333333, 0.333333, 1, 2, 5],
      [0.2, 0.5, 0.5, 1, 3],
      [0.142857143, 0.142857143, 0.2, 0.333333, 1],
    ];
    $this->criteriaCalculationService->setMatrixCriteria($matrix)
      ->setSumColumnCriteria()
      ->setNewMatrixCriteria()
      ->setCriteriaPriority()
      ->setEigenVector()
      ->setSumEigenVector()
      ->setEigenVectorPlusCriteria()
      ->setLamdaCriteria()
      ->setConsistencyIndex()
      ->setConsistencyRatio();

    $subCriteria = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
    $subCriteriaMatrix = [
      [1, 3, 3, 7],
      [0.333333, 1, 3, 5],
      [0.333333, 0.333333, 1, 3],
      [0.142857143, 0.2, 0.333333, 1]
    ];
    $this->subCriteriaCalculationService->setMatrixCriteria($subCriteriaMatrix)
      ->setSumColumnCriteria()
      ->setNewMatrixCriteria()
      ->setCriteriaPriority()
      ->setEigenVector()
      ->setSumEigenVector()
      ->setLamdaCriteria()
      ->setConsistencyIndex()
      ->setConsistencyRatio()
      ->setSubPriorityValue();


    $response = [
      "data" => $request->input('matrix'),
      "subCriteriaSubPriority" => $this->subCriteriaCalculationService->subPriority,
      "criteriaPriority" =>    $this->criteriaCalculationService->criteriaPriority,
      "ci" =>    $this->criteriaCalculationService->ci,
      "cr" =>    $this->criteriaCalculationService->cr,
      "ri" =>    $this->criteriaCalculationService->ri,
      "subCriteriaSet" => $subCriteria,
      'allData' => $request->all()
    ];
    return response($response, Response::HTTP_OK);
  }
}
