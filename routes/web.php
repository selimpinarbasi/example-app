<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::resource('/users', 'UsersController');
    /*Route::delete('news/{id}', function (){
        dd('ROUTE');
    })->name('news.destroy');*/
    Route::resource('/news', 'NewsController');
    Route::resource('/category', 'CategoryController');

    Route::get('/my-news',[NewsController::class, 'myNews'])->name('my-news');
    Route::get('/categoryNews/{id}',[CategoryController::class, 'categoryNews'])->name('cate-news');
    //Route::delete('/news/{news}','NewsController@destroy')->name('article.destroy');
    Route::get('/news/edit',[NewsController::class, 'show'])->name('article.edit');
    Route::post('/news/update/{id}','NewsController@update')->name('article.update');

    Route::get('/category/edit/',[CategoryController::class, 'show'])->name('categoryy.edit');
    Route::get('/category/destroy','CategoryController@destroy')->name('categoryy.destroy');
    Route::post('/category/update/{id}','CategoryController@update')->name('categoryy.update');

    Route::get('/users/edit','UsersController@edit')->name('user.edit');
    Route::get('/users/destroy','UsersController@destroy')->name('user.destroy');
    Route::post('/users/update/{id}','UsersController@update')->name('user.update');
});

