<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LapController;
use App\Http\Controllers\Api\V1\FallbackController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('laps', [LapController::class, 'index']);

    Route::fallback(FallbackController::class);

});
