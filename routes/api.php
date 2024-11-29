<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Tasks\TaskController;
use App\Http\Controllers\Tasks\TaskUtilsController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('projects', ProjectController::class);
    Route::post('validate-token', [AuthController::class, 'validateToken']);
    Route::get('users/me', [AuthController::class, 'me']);
    Route::get('projects/{project}/tasks', [TaskUtilsController::class, 'getProjectTasks']);
    Route::get('users', [AuthController::class, 'users']);

    Route::middleware(['permission:view tasks'])->group(function () {
        Route::get('tasks', [TaskController::class, 'index']);
        Route::get('tasks/{task}', [TaskController::class, 'show']);
        Route::get('tasks/{user}', [TaskUtilsController::class, 'getUserTasks']);
    });

    Route::middleware(['permission:manage tasks'])->group(function () {
        Route::post('tasks', [TaskController::class, 'store']);
        Route::put('tasks/{task}', [TaskController::class, 'update']);
        Route::delete('tasks/{task}', [TaskController::class, 'destroy']);
    });
});
