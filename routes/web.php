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

Route::get('/', function () {
    return view('threads.index');
})->name('home');
Route::get('/threads', 'ThreadController@index')->name('threads.index');
Route::get('/threads/{thread}', 'ThreadController@show')->name('threads.show');
Route::get('/replies/{thread}', 'ReplyController@show')->name('replies.show');
Route::get('/locale/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return back();
})->name('locale');

Route::get('/login/{provider}', 'SocialAuthController@redirect')->name('login.social');
Route::get('/login/{provider}/callback', 'SocialAuthController@callback')->name('login.social.callback');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'ProfileController@edit')->name('profile');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/threads/{thread}/pin', 'ThreadController@pin')->name('threads.pin');
    Route::get('/threads/{thread}/close', 'ThreadController@close')->name('threads.close');
    Route::resource('threads', 'ThreadController', ['except' => ['create', 'index', 'show']]);

    Route::post('/replies/{thread}', 'ReplyController@store')->name('replies.store');
    Route::get('/replies/{reply}/highlight', 'ReplyController@highlight')->name('replies.highlight');
});

Auth::routes();
