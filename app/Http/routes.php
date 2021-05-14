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
Route::get('/comments', 'PhotoController@commentsList');
Route::get('/rules', function() { return view('rules');});
Route::get('/privacy', function() { return view('privacy');});
Route::get('/guide', function() { return view('guide');});
Route::get('/books', function() { return view('books');});
Route::get('/software', function() { return view('software');});
Route::get('/contacts', function() { return view('contacts');});
Route::get('/donate', function() { return view('donate');});
Route::get('/neformat', 'XMLController@neformat');


Route::get('/rss', 'XMLController@rssPhoto');
//Route::get('/migrate', function() { return view('migrate');});


Route::get('/home', 'HomeController@home')->middleware('auth');

Route::get('/editprofile', 'UserController@editProfile')->middleware('auth');
Route::post('/editprofile', 'UserController@storeProfile')->middleware('auth');

Route::get('/addphoto', 'PhotoController@addPhoto')->name('addphoto')->middleware('auth');
Route::post('/addphoto', 'PhotoController@uploadPhoto')->name('Photo.upload')->middleware('auth');
Route::post('/deletephoto', 'PhotoController@deletePhoto')->name('Photo.delete')->middleware('auth');
Route::get('/editphoto/{id}', 'PhotoController@editPhoto')->middleware('auth');
Route::post('/storephoto', 'PhotoController@storePhoto')->middleware('auth');
Route::post('/addcomment', 'PhotoController@addComment')->middleware('auth');
Route::get('/editcomment/{id}', 'PhotoController@editComment')->middleware('auth');
Route::post('/editcomment', 'PhotoController@updateComment')->middleware('auth');
Route::get('/deletecomment/{id}', 'PhotoController@deleteComment')->middleware('auth');

        


Route::get('/photo/{id}', 'PhotoController@showPhoto');
Route::get('/users', 'StatController@ourStat');
Route::get('user/{id}', 'UserController@userPhotos');
Route::get('user/{id}/{cat_id}', 'UserController@userPhotos');

Route::get('/camera/{model}', 'PhotoController@cameraPhoto');

Route::get('/articles/{id}', 'ArticleController@Show');
Route::get('/addarticle', 'ArticleController@Add')->middleware('auth');
Route::post('/addarticle', 'ArticleController@Store')->middleware('auth');
Route::get('/articles/{id}/edit', 'ArticleController@Edit')->middleware('auth');
Route::post('/articles/{id}/edit', 'ArticleController@Store')->middleware('auth');


Route::get('/ajax/rec', 'Ajax\RecController@rec')->middleware('auth');

Route::get('/projects', function(){return view('projects');})->name('projects');
Route::get('/project/{slug}', 'ProjectController@index');
Route::get('/add_project', function(){return view('project_add');})->name('add_project')->middleware('auth');
Route::post('/project_save', 'ProjectController@save')->middleware('auth');
Route::get('/project/edit/{id}', function($id){return view('project_edit', ['project' => \App\Project::find($id)]);})->middleware('auth');
//Route::get('/rebuild', 'PhotoController@rebuildPreviews');
//Route::get('/rebuild_exif', 'PhotoController@rebuildExif');

Route::get('/forum', function(){ return view('forum');})->name('forum');
Route::get('/forum/{id}', function($id) { return view('forum_branch', ["id" => $id]);});
Route::get('/forum/topic/{id}', 'TopicController@view');
Route::post('/add_post', 'TopicController@add_post')->name('add_post')->middleware('auth');
Route::get('/add_topic', function() {return view('forum_topic_add');})->name('forum_topic_add')->middleware('auth');
Route::get('/edit_post/{id}', function($id){return view('forum_post_edit', ['id' => $id]);})->middleware('auth');
Route::post('/save_post', 'TopicController@save_post')->name('save_post')->middleware('auth');
Route::get('/edit_topic/{id}', function($id){return view('forum_topic_edit', ['id' => $id]);})->middleware('auth');
Route::post('/save_topic', 'TopicController@save_topic')->name('save_topic')->middleware('auth');
