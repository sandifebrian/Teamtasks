<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('organization')->group(function () {
    Route::get('/', [OrganizationController::class, 'index']);
    Route::post('/', [OrganizationController::class, 'store']);
    Route::put('/{id}', [OrganizationController::class, 'update']);
    Route::delete('/{id}', [OrganizationController::class, 'delete']);
});
