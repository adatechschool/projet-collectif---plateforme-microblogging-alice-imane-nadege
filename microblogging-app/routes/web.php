<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

/*Route::get('/mypage', [PostController::class, 'showpostUser'])->middleware(['auth', 'verified'])->name('mypage');*/

Route::middleware('web')->group(function () {
    Route::get('/mypage', [PostController::class, 'showpostUser'])->middleware(['auth', 'verified'])->name('mypage');
    Route::post('/mypage',[PostController::class, 'store'])->middleware(['auth', 'verified'])->name('mypage.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);

require __DIR__.'/auth.php';
