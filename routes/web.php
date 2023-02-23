<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Home;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::get('debug/like/{image_id}/{user_id}', [LikeController::class, 'debug_like']);
Route::get('debug/dislike/{image_id}/{user_id}', [LikeController::class, 'debug_dislike']);

Route::middleware('auth')->group(function () {
    Route::get('subir_image', [ImageController::class, 'index'])->name('subir.image');
    Route::get('img_detail/{id}', [ImageController::class, 'detail']);
    Route::post('save_image', [ImageController::class, 'save'])->name('save.image');
    Route::post('delete_image', [ImageController::class, 'delete'])->name('delete.image');

    Route::post('save_comment', [CommentController::class, 'save'])->name('save.comment');
    Route::post('delete_comment', [CommentController::class, 'delete'])->name('delete.comment');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('like/{id}', [LikeController::class, 'like']);
    Route::get('dislike/{id}', [LikeController::class, 'dislike']);

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('user/{id}', [UserController::class, 'profile'])->name('users.profile');
    Route::get('search', [UserController::class, 'search'])->name('users.search');

    Route::group([
        'prefix' => 'friendship'
    ], function () {
        Route::post('cancel', [UserController::class, 'cancel'])->name('friendship.cancel');
        Route::post('accept', [UserController::class, 'accept'])->name('friendship.accept');
        Route::post('deny', [UserController::class, 'deny'])->name('friendship.deny');
        Route::post('send', [UserController::class, 'send'])->name('friendship.send');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [Home::class, 'index']
    )->name('dashboard');
});

require_once 'fortify.php';
