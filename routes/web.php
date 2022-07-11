<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\CriteriaPairController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailGuruController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\StudyCaseController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('authenticate', 'authenticate')->name('authenticate');
    Route::get('logout', 'logout')->name('logout');
    Route::get('register', 'registration')->name('register');
    Route::post('register', 'storeRegistration')->name('storeRegistration');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');


    Route::controller(UserController::class)
        ->name('user.')
        ->group(function () {
            Route::get('/data-guru', 'index')->name('dataguru')->middleware('isAdminICT');
        });

    Route::controller(ProfileController::class)
        ->name('detail_guru.')
        ->middleware('isTeacher')
        ->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/update', 'update')->name('update');
        });

    Route::controller(StudyCaseController::class)
        ->name('studycase.')
        ->middleware('isAdminICT')
        ->group(function () {
            Route::get('/studycase', 'index')->name('show');
            Route::post('/studycase', 'store')->name('store');
        });

    Route::controller(CriteriaController::class)
        ->name('criteria.')
        ->middleware('isAdminICT')
        ->group(function () {
            Route::get('/detail/{id}', 'index')->name('show');
            Route::post('/detail', 'store')->name('store');
            Route::get('/detail/{id}/{idStudyCase}/delete', 'destroy')->name('destroy');
        });

    Route::controller(SekolahController::class)
        ->name('sekolah.')
        ->middleware('isAdminICT')
        ->group(function () {
            Route::get('/sekolah', 'index')->name('show');
            Route::get('/sekolah/{id}/edit', 'edit')->name('edit');
            Route::post('/sekolah', 'store')->name('store');
            Route::put('/sekolah', 'update')->name('update');
            Route::get('/sekolah/{id}/delete', 'delete')->name('delete');
        });

    Route::controller(SubCriteriaController::class)
        ->name('subcriteria.')
        ->middleware('isAdminICT')
        ->group(function () {
            Route::put('/subcriteria', 'update')->name('update');
        });

    Route::controller(CriteriaPairController::class)
        ->name('criteriapair.')
        ->middleware('isAdminICT')
        ->group(function () {
            Route::post('/criteriapair', 'show')->name('show');
        });
});









Route::get('/tes', function () {

    $RANDOM_INDEX = [
        "1" => 0,
        "2" => 0,
        "3" => 0.58,
        "4" => 0.90,
        "5" => 1.12,
        "6" => 1.24,
    ];


    $alternatif = ['budi', 'joko', 'eko', 'bambang'];
    $kriteria = ['jumlahKartuProgram', 'asetBergerak', 'asetTidakBergerak', 'jenisTernak', 'jumlahPenghasilan'];


    $matriks = [
        [1, 4, 3, 5, 7],
        [0.25, 1, 3, 2, 7],
        [0.333333, 0.333333, 1, 2, 5],
        [0.2, 0.5, 0.5, 1, 3],
        [0.142857143, 0.142857143, 0.2, 0.333333, 1],
    ];
    $jumlahKolom = sizeof($matriks[0]);
    $jumlahBaris = sizeof($matriks);



    //penjumlahan kolom

    $jumlah = [];
    /**
     * STEP 1
     * Penjumlahan setiap kolom, dari atas kebawah. Menghasilkan array baru bernama $jumlah
     */
    for ($j = 0; $j < $jumlahKolom; $j++) {
        $jumlah[$j] = 0;  // membuat kolom baru
        for ($i = 0; $i <= $jumlahBaris - 1; $i++) {
            $jumlah[$j] = $jumlah[$j] + $matriks[$i][$j];  //menambahkan hasil penjumlahan ke kolom yang baru dibuat
        }
    }


    /**
     * STEP 2
     * Membagi semua baris, dari kiri ke kanan, sesuai dengan jumlah pada tiap kolom. 
     * Misalnya baris 1 kolom 1, dibagi dengan jumlah pada kolom 1
     * baris 1 kolom 2 dibagi dengan jumlah pada kolom 2
     * dan seterusnya
     */
    $matriksBaru = $matriks;
    for ($i = 0; $i < $jumlahBaris; $i++) {
        for ($j = 0; $j < $jumlahKolom; $j++) {
            $matriksBaru[$i][$j] /= $jumlah[$j];
        }
    }


    /**
     * STEP 3
     * Jumlahkan semua baris, untuk kemudian dibagi dengan total kriteria.
     * Semua baris dari kir ke kanan, kemudian data tersebut disimpan dalam array baru bernama $nilaiPrioritas
     */
    $nilaiPrioritas  = [];
    for ($i = 0; $i < $jumlahBaris; $i++) {
        $sumCurrentRow = 0;
        for ($j = 0; $j < $jumlahKolom; $j++) {
            $sumCurrentRow += $matriksBaru[$i][$j];
        }
        array_push($nilaiPrioritas, $sumCurrentRow / $jumlahBaris);
    }


    //!sampai table b
    /**
     * STEP 4
     * Membuat eigen vector dengan cara menghitung nilai setiap baris pada tabel matriks dengan perbandingan berpasangan
     * nilai skala * nilai prioritas
     */
    $eigenVector = [];
    for ($i = 0; $i < $jumlahBaris; $i++) {
        $eigenVector[$i] = [];
        for ($j = 0; $j < $jumlahKolom; $j++) {
            $eigenVector[$i][$j] = $matriks[$i][$j] * $nilaiPrioritas[$j];
        }
    }




    $jumlahEigenVector = [];
    for ($i = 0; $i < $jumlahBaris; $i++) {
        $sumCurrentRow = 0;
        for ($j = 0; $j < $jumlahKolom; $j++) {
            $sumCurrentRow += $eigenVector[$i][$j];
        }
        array_push($jumlahEigenVector, $sumCurrentRow);
    }

    $jumlahEigenPlusPrioritas = [];
    for ($i = 0; $i < count($jumlahEigenVector); $i++) {
        $jumlahEigenPlusPrioritas[$i] = $jumlahEigenVector[$i] + $nilaiPrioritas[$i];
    }


    $lamdaKriteria = 0;
    for ($i = 0; $i < ($jumlahBaris); $i++) {
        $lamdaKriteria += $jumlah[$i] * $nilaiPrioritas[$i];
    }

    $CI = ($lamdaKriteria - $jumlahBaris) / ($jumlahBaris - 1);

    $CONSISTENCY_RATIO = $CI / 1.12;



    dd($CONSISTENCY_RATIO); //SUDAH DIBAWAH 0.1


    /**------------------SUB KRITERIA---------------------------*/
    $subKriteria = ['sangat baik', 'baik', 'cukup', 'kurang'];
    $matriksSubKriteria = [
        [1, 3, 3, 7],
        [0.333333, 1, 3, 5],
        [0.333333, 0.333333, 1, 3],
        [0.142857143, 0.2, 0.333333, 1]
    ];
    $jumlahKolomSubKriteria = sizeof($subKriteria);
    $jumlahBarisSubKriteria = sizeof($subKriteria);

    $jumlahSubKriteria = [];

    /**
     * STEP 1
     * Penjumlahan setiap kolom, dari atas kebawah. Menghasilkan array baru bernama $jumlah
     */
    for ($j = 0; $j < $jumlahKolomSubKriteria; $j++) {
        $jumlahSubKriteria[$j] = 0;  // membuat kolom baru
        for ($i = 0; $i <= $jumlahBarisSubKriteria - 1; $i++) {
            $jumlahSubKriteria[$j] = $jumlahSubKriteria[$j] + $matriksSubKriteria[$i][$j];  //menambahkan hasil penjumlahan ke kolom yang baru dibuat
        }
    }



    /**
     * STEP 2
     * Membagi semua baris, dari kiri ke kanan, sesuai dengan jumlah pada tiap kolom. 
     * Misalnya baris 1 kolom 1, dibagi dengan jumlah pada kolom 1
     * baris 1 kolom 2 dibagi dengan jumlah pada kolom 2
     * dan seterusnya
     */
    $matriksBaruSubKriteria = $matriksSubKriteria;
    for ($i = 0; $i < $jumlahBarisSubKriteria; $i++) {
        for ($j = 0; $j < $jumlahKolomSubKriteria; $j++) {
            $matriksBaruSubKriteria[$i][$j] /= $jumlahSubKriteria[$j];
        }
    }




    /**
     * STEP 3
     * Jumlahkan semua baris, untuk kemudian dibagi dengan total kriteria.
     * Semua baris dari kir ke kanan, kemudian data tersebut disimpan dalam array baru bernama $nilaiPrioritasSubKriteria
     */

    $nilaiPrioritasSubKriteria  = [];
    for ($i = 0; $i < $jumlahBarisSubKriteria; $i++) {
        $sumCurrentRow = 0;
        for ($j = 0; $j < $jumlahKolomSubKriteria; $j++) {
            $sumCurrentRow += $matriksBaruSubKriteria[$i][$j];
        }
        array_push($nilaiPrioritasSubKriteria, $sumCurrentRow / $jumlahBarisSubKriteria);
    }








    /**
     * STEP 4
     * Membuat eigen vector dengan cara menghitung nilai setiap baris pada tabel matriks dengan perbandingan berpasangan
     * nilai skala * nilai prioritas
     */
    $eigenVectorSubKriteria = [];
    for ($i = 0; $i < $jumlahBarisSubKriteria; $i++) {
        $eigenVectorSubKriteria[$i] = [];
        for ($j = 0; $j < $jumlahKolomSubKriteria; $j++) {
            $eigenVectorSubKriteria[$i][$j] = $matriksSubKriteria[$i][$j] * $nilaiPrioritasSubKriteria[$j];
        }
    }





    $jumlahEigenVectorSubKriteria = [];
    for ($i = 0; $i < $jumlahBarisSubKriteria; $i++) {
        $sumCurrentRow = 0;
        for ($j = 0; $j < $jumlahKolomSubKriteria; $j++) {
            $sumCurrentRow += $eigenVectorSubKriteria[$i][$j];
        }
        array_push($jumlahEigenVectorSubKriteria, $sumCurrentRow);
    }




    $lamdaSubKriteria = 0;
    for ($i = 0; $i < sizeof($jumlahSubKriteria); $i++) {
        $lamdaSubKriteria += $jumlahSubKriteria[$i] * $nilaiPrioritasSubKriteria[$i];
    }


    $CI = ($lamdaSubKriteria - $jumlahBarisSubKriteria) / ($jumlahBarisSubKriteria - 1);


    $CONSISTENCY_RATIO = $CI / 0.90;

    echo "<pre>";
    echo "nilai prioritas kriteria";
    echo "<br>";
    var_dump($nilaiPrioritasSubKriteria);
    echo "</pre>";

    $nilaiSubPrioritasSubKriteria = [];
    for ($i = 0; $i < sizeof($nilaiPrioritasSubKriteria); $i++) {
        array_push($nilaiSubPrioritasSubKriteria, $nilaiPrioritasSubKriteria[$i] / max($nilaiPrioritasSubKriteria));
    }

    // echo "<pre>";
    // echo "nilai prioritas sub kriteria";
    // echo "<br>";
    // var_dump($nilaiPrioritasSubKriteria);
    // echo "</pre>";
    // echo "<pre>";
    // echo "nilai eigen vector sub kri";
    // echo "<br>";
    // var_dump($eigenVectorSubKriteria);
    // echo "</pre>";
    // echo "<pre>";
    // echo "jumlah eigen vector sub kri";
    // echo "<br>";
    // var_dump($jumlahEigenVectorSubKriteria);
    // echo "</pre>";

    $total = $nilaiPrioritas[0] * $nilaiSubPrioritasSubKriteria[2];

    $total += $nilaiPrioritas[1] * $nilaiSubPrioritasSubKriteria[0];
    $total += $nilaiPrioritas[2] * $nilaiSubPrioritasSubKriteria[0];
    $total += $nilaiPrioritas[3] * $nilaiSubPrioritasSubKriteria[0];
    $total += $nilaiPrioritas[3] * $nilaiSubPrioritasSubKriteria[1];
    echo $total;
});
