<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('organization')->group(function () {
    Route::get('/', [OrganizationController::class, 'index']);
    Route::get('/{organization}', [OrganizationController::class, 'show']);
    Route::post('/', [OrganizationController::class, 'store']);
    Route::put('/{organization}', [OrganizationController::class, 'update']);
    Route::delete('/{organization}', [OrganizationController::class, 'destroy']);
    Route::put('/add-members/{organization}', [OrganizationController::class, 'addMembers']);
});

Route::prefix('project')->group(function () {
    Route::get('/{organization}', [ProjectController::class, 'index']);
    Route::get('/{organization}/{project}', [ProjectController::class, 'show']);
    Route::post('/{organization}', [ProjectController::class, 'store']);
    Route::put('/{organization}/{project}', [ProjectController::class, 'update']);
    Route::delete('/{organization}/{project}', [ProjectController::class, 'destroy']);
});

Route::prefix('feature')->group(function () {
    Route::get('/{project}', [FeatureController::class, 'index']);
    Route::get('/{project}/{feature}', [FeatureController::class, 'show']);
    Route::post('/{project}', [FeatureController::class, 'store']);
    Route::put('/{project}/{feature}', [FeatureController::class, 'update']);
    Route::delete('/{project}/{feature}', [FeatureController::class, 'destroy']);
});

Route::prefix('task')->group(function () {
    Route::get('/{feature}', [TaskController::class, 'index']);
    Route::get('/{feature}/{task}', [TaskController::class, 'show']);
    Route::post('/{feature}', [TaskController::class, 'store']);
    Route::put('/{feature}/{task}', [TaskController::class, 'update']);
    Route::delete('/{feature}/{task}', [TaskController::class, 'destroy']);
});

Route::prefix('comment')->group(function () {
    Route::get('/{task}', [CommentController::class, 'index']);
    Route::post('/{task}', [CommentController::class, 'store']);
    Route::delete('/{task}/{comment}', [CommentController::class, 'destroy']);
});
