<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/category/{id}', 'HomeController@index');

Route::get('/home', 'HomeController@home')->middleware('auth');

Route::get('/editprofile', 'UserController@editProfile')->middleware('auth');
Route::post('/editprofile', 'UserController@storeProfile')->middleware('auth');

Route::get('/addphoto', 'PhotoController@addPhoto')->middleware('auth');
Route::post('/addphoto', 'PhotoController@uploadPhoto')->name('Photo.upload')->middleware('auth');
Route::get('/editphoto/{id}', 'PhotoController@editPhoto')->middleware('auth');
Route::post('/storephoto', 'PhotoController@storePhoto')->middleware('auth');
Route::post('/addcomment', 'PhotoController@addComment')->middleware('auth');
Route::get('/editcomment/{id}', 'PhotoController@editComment')->middleware('auth');
Route::post('/editcomment', 'PhotoController@updateComment')->middleware('auth');
Route::get('/deletecomment/{id}', 'PhotoController@deleteComment')->middleware('auth');
        
        //->middleware('auth');
//Route::post('/deletecomment/{$id}', 'PhotoController@deleteComment')->middleware('auth');


Route::get('/photo/{id}', 'PhotoController@showPhoto')->middleware('auth');
Route::get('/users', 'UserController@users');
Route::get('user/{id}', 'UserController@userPhotos');
Route::get('user/{id}/{cat_id}', 'UserController@userPhotos');

