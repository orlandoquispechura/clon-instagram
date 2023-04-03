<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
// ->group(function () {
//     Route::resource('/home/dash', function () {
//         return view('home.dash');
//     })->name('home.dash');
// });

Route::resource('home', HomeController::class)->names('home.dash');

Route::get('publication/{id}', [UserController::class, 'publicacion'])->name('admin.user.publicacion');
Route::get('personas/{search?}', [UserController::class, 'index'])->name('admin.user.index');

Route::get('image/create', [ImageController::class, 'create'])->name('admin.image.create');
Route::post('image/store', [ImageController::class, 'store'])->name('admin.image.store');
Route::get('image/file/{img}', [ImageController::class, 'getImagen'])->name('admin.image.file');
Route::get('image/show/{id}', [ImageController::class, 'show'])->name('admin.image.show');
Route::get('image/delete/{id}', [ImageController::class, 'delete'])->name('admin.image.delete');
Route::get('image/edit/{id}', [ImageController::class, 'edit'])->name('admin.image.edit');
Route::post('image/update', [ImageController::class, 'update'])->name('admin.image.update');


Route::post('comment/store', [CommentController::class, 'store'])->name('admin.comment.store');
Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('admin.comment.delete');


Route::get('like/{id}', [LikeController::class, 'like'])->name('admin.like.like');
Route::get('dislike/{id}', [LikeController::class, 'dislike'])->name('admin.like.dislike');


Route::get('likes', [LikeController::class, 'index'])->name('admin.like.index');
