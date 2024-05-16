<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccruedDaysCalculatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculator', [AccruedDaysCalculatorController::class, 'showForm']);
Route::post('/calculator', [AccruedDaysCalculatorController::class, 'calculate']);

