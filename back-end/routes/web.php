<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;

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
// Route::resource('article', ArticleController::class);
Route::get('article/recycle',[ArticleController::class,'recycle'])->name('article.recycle');
Route::delete('article/{id}/forceDestroy',[ArticleController::class,'fDelete'])->name('article.forceDelete')->where('id','[0-9]+');
Route::get('article/restore/{id}', [ArticleController::class, 'restore'])->name('article.restore')->where('id','[0-9]+');
Route::get('article',[ArticleController::class,'index'])->name('article.index');
Route::post('article',[ArticleController::class,'store'])->name('article.store');
Route::get('article/create',[ArticleController::class,'create'])->name('article.create');
Route::get('article/{id}',[ArticleController::class,'show'])->name('article.show')->where('id','[0-9]+');
Route::put('article/{article}',[ArticleController::class,'update'])->name('article.update');
Route::delete('article/{id}',[ArticleController::class,'destroy'])->name('article.destroy')->where('id','[0-9]+');
Route::get('article/{id}/edit',[ArticleController::class,'edit'])->name('article.edit')->where('id','[0-9]+');
Route::delete('article/deleteAll',[ArticleController::class,'DeleteAllTrashed'])->name('article.DeleteAllTrashed');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
