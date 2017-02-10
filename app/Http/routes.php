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

// Route::get('/', function () {
//     return view('welcome');
// });


	Route::auth();

	Route::get('/blog/{slug}',['as' => 'blog.single', 'uses'=> 
		'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

	Route::get('/blog/{id}/{slug}',['as' => 'blog.edit', 'uses'=> 
		'BlogController@edit'])->where('slug','[\w\d\-\_]+');

	Route::put('/blog/{id}',['as' => 'blog.update', 'uses'=> 
		'BlogController@update'])->where('slug','[\w\d\-\_]+');



	Route::get('home', 'BlogController@index');
	
	// Route::put('pagination', 'PostController@pagination');


	Route::get('', 'BlogController@index');
	Route::get('about', 'PagesController@about');
	Route::get('contact', 'PagesController@contact');

	Route::resource('posts','PostController');

	Route::get('login', array('as' => 'login', 'uses' => 'Auth\AuthController@getLogin'));
	Route::get('register', array('as'=>'register', 'uses' => 'Auth\AuthController@getRegister'));


	Route::resource('catogories','CategoryController');
	Route::resource('tags','TagController');
	Route::resource('comments','CommentController');

	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');