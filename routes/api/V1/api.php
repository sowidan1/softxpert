<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

route::post('/login', [AuthController::class, 'login']);
