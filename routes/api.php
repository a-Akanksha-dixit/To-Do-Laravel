<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsersController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    die('received');
});
Route::controller(TaskController::class)->group(function() {
    Route::post('/post', 'create')->name('task.create');
    Route::get('/tasks','getAll')->name('task.getAll');
});

Route::controller(UsersController::class)->group(function() {
    Route::post('/user', 'create')->name('user.create');
    Route::get('/user', 'getAllUsers')->name('user.getAll');
});