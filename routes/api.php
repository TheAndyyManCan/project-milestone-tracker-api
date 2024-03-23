<?php

use App\Http\Controllers\Api\V1\MilestoneController;
use App\Http\Controllers\Api\V1\MilestoneStatusController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::apiResource('/projects', ProjectController::class);
    Route::apiResource('/milestones', MilestoneController::class);
    Route::apiResource('/users', UserController::class);
    Route::post('/users/login', [UserController::class, 'login']);
    Route::patch('/milestones/{milestone}/status', MilestoneStatusController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
