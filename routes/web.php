<?php

use App\Http\Controllers\Api\TaskController as ApiTaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('tasks', TaskController::class);

Route::apiResource('api/tasks', ApiTaskController::class);
