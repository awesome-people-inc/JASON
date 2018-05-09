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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/profile/{id}', 'ProfileController@show')->name('profile');

    Route::get('/send/request/{user}', 'FriendshipController@sendRequest')->name('sendRequest');
    Route::get('/remove/friend/{user}', 'FriendshipController@unfriend')->name('removeConnection');
    Route::get('/accept/request/{user}', 'FriendshipController@acceptFriendRequest')->name('acceptRequest');
    Route::get('/deny/request/{user}', 'FriendshipController@denyRequest')->name('denyRequest');
    Route::get('/unblock/{user}', 'FriendshipController@unblock')->name('unblock');
    Route::get('/block/{user}', 'FriendshipController@block')->name('block');

    Route::put('/post/put', 'PostController@put');
});