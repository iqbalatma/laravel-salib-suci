<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CriteriaPairController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\SchoolController;
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
    Route::get('logout', 'logout')->name('logout');
    Route::get('register', 'registration')->name('register');
    Route::post('authenticate', 'authenticate')->name('authenticate');
    Route::post('register', 'storeRegistration')->name('storeRegistration');
});


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard')->middleware('isChief');


    Route::controller(ProfileController::class)
        ->name('teacherDetail.')
        ->middleware('isTeacher')
        ->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/update', 'update')->name('update');
        });

    Route::middleware('isAdminICT')->group(function () {
        Route::get('/teachers', [UserController::class, 'index'])->name('user.teachers');

        Route::controller(StudyCaseController::class)
            ->name('studycase.')
            ->group(function () {
                Route::get('/studycase', 'index')->name('show');
                Route::post('/studycase', 'store')->name('store');
                Route::delete('/studycase', 'destroy')->name('destroy');
            });

        Route::controller(CriteriaController::class)
            ->name('criteria.')
            ->group(function () {
                Route::get('/detail/{id}', 'index')->name('show');
                Route::post('/detail', 'store')->name('store');
                Route::get('/detail/{id}/{idStudyCase}/delete', 'destroy')->name('destroy');
            });

        Route::controller(SchoolController::class)
            ->name('school.')
            ->group(function () {
                Route::get('/schools', 'index')->name('index');
                Route::get('/schools/{id}/edit', 'edit')->name('edit');
                Route::post('/schools', 'store')->name('store');
                Route::put('/schools', 'update')->name('update');
                Route::get('/schools/{id}/delete', 'delete')->name('delete');
            });



        Route::put('/subcriteria', [SubCriteriaController::class, 'update'])
            ->name('subcriteria.update');

        Route::post('/criteriapair', [CriteriaPairController::class, 'index'])
            ->name('criteriapair.index');
    });
});

Route::controller(RankController::class)
    ->name('ranks.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/rank', 'index')->name('index');
        Route::get('/rank-detail/{id}', 'detail')->name('detail');
    });
