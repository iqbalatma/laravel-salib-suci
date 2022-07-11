<?php

namespace App\Services;

class SubCriteriaCalculationService
{
  public $RANDOM_INDEX = [
    "1" => 0,
    "2" => 0,
    "3" => 0.58,
    "4" => 0.90,
    "5" => 1.12,
    "6" => 1.24,
  ];

  public $matrix = [];
  public $newMatrix = [];
  public $criteriaPriority = [];
  public $eigenVector = [];
  public $sumEigenVector = [];
  public $sumEigenVectorPlusCriteria = [];
  public $colLength = 0;
  public $rowLength = 0;
  public $sumColValue = 0;
  public $lamdaCriteria = 0;
  public $ci = 0;
  public $cr = 0;

  public function setMatrixSubCriteria($matrix)
  {
    $this->matrix = $matrix;
    $this->colLength =  sizeof($matrix[0]);
    $this->rowLength =  sizeof($matrix);

    return $this;
  }

  public function setSumColumnSubCriteria()
  {
    /**
     * STEP 1
     * Penjumlahan setiap kolom, dari atas kebawah. Menghasilkan array baru bernama $jumlah
     */
    $sumColValue = [];

    for ($j = 0; $j < $this->colLength; $j++) {
      $sumColValue[$j] = 0;  // membuat kolom baru
      for ($i = 0; $i <= $this->rowLength - 1; $i++) {
        $sumColValue[$j] = $sumColValue[$j] + $this->matrix[$i][$j];  //menambahkan hasil penjumlahan ke kolom yang baru dibuat
      }
    }

    $this->sumColValue = $sumColValue;

    return $this;
  }

  public function setNewMatrixSubCriteria()
  {
    /**
     * STEP 2
     * Membagi semua baris, dari kiri ke kanan, sesuai dengan jumlah pada tiap kolom. 
     * Misalnya baris 1 kolom 1, dibagi dengan jumlah pada kolom 1
     * baris 1 kolom 2 dibagi dengan jumlah pada kolom 2
     * dan seterusnya
     */

    $newMatrix = $this->matrix;
    for ($i = 0; $i < $this->rowLength; $i++) {
      for ($j = 0; $j < $this->colLength; $j++) {
        $newMatrix[$i][$j] /= $this->sumColValue[$j];
      }
    }

    $this->newMatrix = $newMatrix;

    return $this;
  }

  public function setSubCriteriaPriority()
  {
    /**
     * STEP 3
     * Jumlahkan semua baris, untuk kemudian dibagi dengan total criteria.
     * Semua baris dari kir ke kanan, kemudian data tersebut disimpan dalam array baru bernama $nilaiPrioritas
     */
    $newMatrix = $this->newMatrix;
    $criteriaPriority  = [];

    for ($i = 0; $i < $this->rowLength; $i++) {
      $sumCurrentRow = 0;
      for ($j = 0; $j < $this->colLength; $j++) {
        $sumCurrentRow += $newMatrix[$i][$j];
      }
      array_push($criteriaPriority, $sumCurrentRow / $this->rowLength);
    }

    $this->criteriaPriority = $criteriaPriority;

    return $this;
  }

  public function setEigenVector()
  {
    /**
     * STEP 4
     * Membuat eigen vector dengan cara menghitung nilai setiap baris pada tabel matriks dengan perbandingan berpasangan
     * nilai skala * nilai prioritas
     */
    $eigenVector = [];
    for ($i = 0; $i < $this->rowLength; $i++) {
      $eigenVector[$i] = [];
      for ($j = 0; $j < $this->colLength; $j++) {
        $eigenVector[$i][$j] = $this->matrix[$i][$j] * $this->criteriaPriority[$j];
      }
    }


    $this->eigenVector = $eigenVector;
    return $this;
  }

  public function setSumEigenVector()
  {

    $sumEigenVector = [];
    for ($i = 0; $i < $this->rowLength; $i++) {
      $sumCurrentRow = 0;
      for ($j = 0; $j < $this->colLength; $j++) {
        $sumCurrentRow += $this->eigenVector[$i][$j];
      }
      array_push($sumEigenVector, $sumCurrentRow);
    }

    $this->sumEigenVector = $sumEigenVector;

    return $this;
  }

  public function setEigenVectorPlusCriteria()
  {
    $sumEigenVectorPlusCriteria = [];
    for ($i = 0; $i < count($this->sumEigenVector); $i++) {
      $sumEigenVectorPlusCriteria[$i] = $this->sumEigenVector[$i] + $this->criteriaPriority[$i];
    }

    $this->sumEigenVectorPlusCriteria = $sumEigenVectorPlusCriteria;

    return $this;
  }

  public function setLamdaSubCriteria()
  {
    $lamdaCriteria = 0;
    for ($i = 0; $i < ($this->rowLength); $i++) {
      $lamdaCriteria += $this->sumColValue[$i] * $this->criteriaPriority[$i];
    }

    $this->lamdaCriteria = $lamdaCriteria;

    return $this;
  }

  public function setConsistencyIndex()
  {
    $this->ci = ($this->lamdaCriteria - $this->rowLength) / ($this->rowLength - 1);

    return $this;
  }

  public function setConsistencyRatio()
  {
    $this->cr = $this->ci / $this->RANDOM_INDEX[$this->rowLength];

    return $this;
  }
}
