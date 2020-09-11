<?php

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

Auth::routes();

Route::get('/' , 'ReviewController@index')->name('reviews.index');

// Route::get('/show/{id}', 'ReviewController@show')->name('show');

// // ログインしている人だけがアクセスできるルーティンググループ
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/review', 'ReviewController@create')->name('create');
//     Route::post('/review/store', 'ReviewController@store')->name('store');

// });

// Route::resource('/reviews', 'ReviewController')->except(['index','show','store','create']);

Route::get('/', 'ReviewController@index')->name('reviews.index');
Route::resource('/reviews', 'ReviewController')->except(['index', 'show'])->middleware('auth'); //-- exceptメソッドの引数を変更
Route::resource('/reviews', 'ReviewController')->only(['show']);

Route::prefix('reviews')->name('reviews.')->group(function () {
    Route::put('/{review}/like', 'ReviewController@like')->name('like')->middleware('auth');
    Route::delete('/{review}/like', 'ReviewController@unlike')->name('unlike')->middleware('auth');
});

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');


Route::get('/home', 'HomeController@index')->name('home');
