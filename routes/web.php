<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'show_login_view'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('document')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('document.index');
        // Route::get('/{id}', [DocumentController::class, 'show'])->name('document.show');
        // Route::get('/{folder:slug}', [DocumentController::class, 'show'])->name('document.show');
        Route::get('/{path?}', [DocumentController::class, 'show'])
            ->where('path', '.*')
            ->name('document.show');
        });

    Route::prefix('folder')->group(function () {
        Route::post('/store', [FolderController::class, 'store'])->name('folder.store');
    });
    Route::prefix('file')->group(function () {
        Route::post('/store', [FileController::class, 'store'])->name('file.store');
    });
});
