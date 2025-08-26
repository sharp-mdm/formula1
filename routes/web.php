<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\LapController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/laps', [LapController::class, 'index']);
});
