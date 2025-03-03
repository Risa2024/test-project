<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('posts', [PostController::class, 'store'])->name('posts.store');//投稿データ保存用ルート
Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('posts/create', [PostController::class, 'create'])->middleware('admin')->name('posts.create');
Route::get('posts', [PostController::class, 'index']);

require __DIR__.'/auth.php';
