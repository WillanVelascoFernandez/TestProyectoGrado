<?php

use App\Http\Controllers\Api\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(DataController::class)->group(function () {
    Route::post('addData', 'addData');
    // Route::get('/api/slots', [SlotController::class, 'addSlot']);
    Route::post('store', 'store');

});

