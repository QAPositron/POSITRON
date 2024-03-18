<?php

/*
|--------------------------------------------------------------------------
| Web Routes para el rol de lider de dosimetria
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\LiderdosimrolController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/liderdosim', [LiderdosimrolController::class, 'index'])->name('liderdosim.home'); 

Auth::routes();