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

	Route::get('/blog/{slug}',['as' => 'blog.single', 'uses'=> 
		'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

	Route::get('home', 'BlogController@index');
	// Route::put('pagination', 'PostController@pagination');


	Route::get('', 'PagesController@index');
	Route::get('about', 'PagesController@about');
	Route::get('contact', 'PagesController@contact');

	Route::resource('posts','PostController');
