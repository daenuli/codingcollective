<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/auth', [AuthController::class, 'auth']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('candidates/data', [CandidateController::class, 'data'])->name('candidates.data');
    Route::resource('candidates', CandidateController::class);
    
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});