<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    die('received');
});
Route::post('/post', [TaskController::class,'create'])->name('task.create');
