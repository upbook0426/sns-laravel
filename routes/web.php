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
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
    });
Route::prefix('register')->name('register.')->group(function () {
        Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
        Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
    });
Route::get("/", "ArticleController@index")->name("articles.index");
Route::resource("/articles", "ArticleController")
    ->except(["index", "show"])
    ->middleware("auth");
Route::resource("/articles", "ArticleController")->only(["show"]);
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});