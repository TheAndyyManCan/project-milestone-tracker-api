<?php

use App\Http\Controllers\Api\V1\MilestoneController;
use App\Http\Controllers\Api\V1\MilestoneStatusController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\UserSearchController;
use App\Http\Controllers\Api\V1\ProjectPermissionController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::apiResource('/projects', ProjectController::class)->middleware(['auth:sanctum']);
    Route::apiResource('/milestones', MilestoneController::class)->middleware(['auth:sanctum']);
    Route::apiResource('/permissions', ProjectPermissionController::class)->middleware(['auth:sanctum']);
    Route::patch('/milestones/{milestone}/status', MilestoneStatusController::class)->middleware(['auth:sanctum']);

    Route::get('projects/{project}/users/search/{email?}', [UserSearchController::class, 'search'])->middleware(['auth:sanctum']);
});

Route::middleware(['auth:sanctum'])->get('/user', function () {
    return UserResource::make(Auth::user());
});
