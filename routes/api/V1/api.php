<?php

use App\Enums\PermissionEnum;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Support\Facades\Route;

route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(permissions(PermissionEnum::viewPermissions()))->group(function () {
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::get('/tasks/{task}', [TaskController::class, 'show']);
    });

    Route::post('/tasks', [TaskController::class, 'store'])
        ->middleware(permissions(PermissionEnum::createPermissions()));

    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->middleware(permissions(PermissionEnum::updatePermissions()));
});
