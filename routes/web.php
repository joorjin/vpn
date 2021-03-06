<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;

// Route::get('/', function () {
//     return "endpoint";
// });
Route::view("/",'index');

Route::group(["prefix" => "admin"], function () {
    Auth::routes();
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/update', [AdminController::class, 'updateServer'])->name('update_server');
    Route::post('/update/switch', [AdminController::class, 'switch'])->name('switch_status');
    Route::post('/add', [AdminController::class, 'addServer'])->name('add_server');
    Route::post('/delete', [AdminController::class, 'deleteServer'])->name('delete_server');
});

Route::any("test",[TestController::class,"test"]);

Route::get('ver', function () {
    return '111';
});
