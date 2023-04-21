<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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
Log::emergency('page de routes.');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web')->group(function () {
    
    Route::get('/mypage', [PostController::class, 'showpostUser'])->middleware(['auth', 'verified'])->name('mypage');
    Route::get('/mypage/{id?}', [PostController::class, 'showAnotherPage'])->middleware(['auth', 'verified'])->name('mypage.another');
    Route::post('/mypage',[PostController::class, 'store'])->middleware(['auth', 'verified'])->name('mypage.store');
    /*delete a post*/
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(['auth', 'verified'])->name('posts.destroy');
    /*like management*/
    Route::post('/like-post/{id}',[PostController::class,'likePost'])->middleware(['auth', 'verified'])->name('like.post');
    Route::post('/unlike-post/{id}',[PostController::class,'unlikePost'])->middleware(['auth', 'verified'])->name('unlike.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::resource('posts', PostController::class);

require __DIR__.'/auth.php';
