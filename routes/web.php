<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [PostController::class, 'index'])
        ->name('dashboard');

    Route::post('/upload', [PostController::class, 'store'])
        ->name('upload');

    Route::post('/like/{post}', [PostController::class, 'like'])
        ->name('like');

    Route::post('/comment/{post}', [PostController::class, 'comment'])
        ->name('comment');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';
