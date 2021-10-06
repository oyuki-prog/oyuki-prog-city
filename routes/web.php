<?php

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [ArticleController::class, 'index'])->name('root');

Auth::routes();


Route::get('/articles/create', [ArticleController::class, 'create'])->middleware('auth')->name('articles.create');

Route::resource('articles', ArticleController::class)->except('create');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/category/{id}', [ArticleController::class, 'category'])->name('category');

Route::get('/area/{prefecture_id}/{city_name}', [ArticleController::class, 'area'])->name('area');
