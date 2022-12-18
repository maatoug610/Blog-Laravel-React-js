<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController\ArticleController;
use App\Http\Controllers\apiController\ProductController;
use App\Http\Controllers\apiController\ApplicationController;
use App\Http\Controllers\apiController\AuthController;
use App\Http\Controllers\apiController\RoleController;
use App\Http\Controllers\apiController\UserController;
use App\Http\Controllers\apiController\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/* shoud add /api in the url: localhost:8000/api/name_route  */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

//     return $request->user();
// });

/* Route Register */

Route::post("/register",[AuthController::class,'Register'])->name('register');
Route::post("/login",[AuthController::class,'Login'])->name('login');




// dd(app()->make('generate'));

/* Routes Article */

Route::get('article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('article/store', [ArticleController::class, 'store'])->name('article.store');
Route::get('article/{id}', [ArticleController::class, 'show'])->name('article.show')->where('id', '[0-9]+');
Route::get('article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit')->where('id','[0-9]+');
Route::put('article/{article}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy')->where('id','[0-9]+');
Route::get('article/recycle', [ArticleController::class, 'recycle'])->name('article.recycle');
Route::delete('article/forceDelete/{id}', [ArticleController::class, 'forceDelete'])->name('article.forceDelete')->where('id','[0-9]+');
Route::get('article/restore/{id}', [ArticleController::class, 'restore'])->name('article.restore')->where('id','[0-9]+');
Route::delete('article/deleteAll',[ArticleController::class,'DeleteAllTrashed'])->name('article.DeleteAllTrashed');

/* Routes Product */

Route::get('product/index',[ProductController::class,'index'])->name('product.index');
Route::get('product/create',[ProductController::class,'create'])->name('product.create');
Route::post('product/store',[ProductController::class,'store'])->name('product.store');
Route::get('product/{id}',[ProductController::class,'show'])->name('product.show')->where('id','[0-9]+');
Route::get('product/{id}/edit',[ProductController::class,'edit'])->name('product.edit')->where('id','[0-9]+');
Route::put('product/{product}',[ProductController::class,'update'])->name('product.update');
Route::delete('product/{id}',[ProductController::class,'destroy'])->name('product.destroy')->where('id','[0-9]+');
Route::get('product/recycleList',[ProductController::class,'recycleList'])->name('product.recycle');
Route::delete('product/{id}/forceDelete',[ProductController::class,'forceDelete'])->name('product.forceDelete')->where('id','[0-9]+');
Route::get('product/{id}/restore',[ProductController::class,'restore'])->name('product.restore')->where('id','[0-9]+');
Route::delete('product/deleteAll',[ProductController::class,'DeleteAllTrashed'])->name('product.DeleteAllTrashed');

/* Routes Application */

Route::get('application/index',[ApplicationController::class,'index'])->name('application.index');
Route::get('application/create',[ApplicationController::class,'create'])->name('application.create');
Route::post('application/store',[ApplicationController::class,'store'])->name('application.store');
Route::get('application/{id}',[ApplicationController::class,'show'])->name('application.show')->where('id','[0-9]+');
Route::get('application/{id}/edit',[ApplicationController::class,'edit'])->name('application.edit')->where('id','[0-9]+');
Route::put('application/{application}',[ApplicationController::class,'update'])->name('application.update');
Route::delete('application/{id}',[ApplicationController::class,'destroy'])->name('application.destroy')->where('id','[0-9]+');
Route::get('application/recycleList',[ApplicationController::class,'recycleList'])->name('application.recycle');
Route::delete('application/{id}/forceDelete',[ApplicationController::class,'forceDelete'])->name('application.forceDelete')->where('id','[0-9]+');
Route::get('application/{id}/restore',[ApplicationController::class,'restore'])->name('application.restore')->where('id','[0-9]+');
Route::delete('application/deleteAll',[ApplicationController::class,'DeleteAllTrashed'])->name('application.DeleteAllTrashed');

/* Routes Role */

Route::get('role/index',[RoleController::class,'index'])->name('role.index');
Route::get('role/create',[RoleController::class,'create'])->name('role.create');
Route::post('role/store',[RoleController::class,'store'])->name('role.store');
Route::get('role/{id}',[RoleController::class,'show'])->name('role.show')->where('id','[0-9]+');
Route::get('role/{id}/edit',[RoleController::class,'edit'])->name('role.edit')->where('id','[0-9]+');
Route::put('role/{role}',[RoleController::class,'update'])->name('role.update');
Route::delete('role/{id}',[RoleController::class,'destroy'])->name('role.destroy')->where('id','[0-9]+');
Route::get('role/recycleList',[RoleController::class,'recycleList'])->name('role.recycle');
Route::delete('role/{id}/forceDelete',[RoleController::class,'fDelete'])->name('role.forceDelete')->where('id','[0-9]+');
Route::get('role/{id}/restore',[RoleController::class,'rest'])->name('role.restore')->where('id','[0-9]+');
Route::delete('role/deleteAll',[RoleController::class,'DeleteAllTrashed'])->name('role.DeleteAllTrashed');

/* Routes User */

Route::get('user/index',[UserController::class,'index'])->name('user.index');
Route::get('user/create',[UserController::class,'create'])->name('user.create');
Route::post('user/store',[UserController::class,'store'])->name('user.store');
Route::get('user/{id}',[UserController::class,'show'])->name('user.show')->where('id','[0-9]+');
Route::get('user/{id}/edit',[UserController::class,'edit'])->name('user.edit')->where('id','[0-9]+');
Route::put('user/{user}',[UserController::class,'update'])->name('user.update');
Route::delete('user/{id}',[UserController::class,'destroy'])->name('user.destroy')->where('id','[0-9]+');
Route::get('user/recycleList',[UserController::class,'recycleList'])->name('user.recycle');
Route::delete('user/{id}/forceDelete',[UserController::class,'fDelete'])->name('user.forceDelete')->where('id','[0-9]+');
Route::get('user/{id}/restore',[UserController::class,'rest'])->name('user.restore')->where('id','[0-9]+');
Route::delete('user/deleteAll',[UserController::class,'DeleteAllTrashed'])->name('user.DeleteAllTrashed');
