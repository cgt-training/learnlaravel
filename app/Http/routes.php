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

/*========= Admin Panel===========*/

// login and register admin 

	Route::get('/admin','Adminauth\AuthController@showLoginForm');
	Route::post('/loginadmin','Adminauth\AuthController@login');

	Route::get('/registeradmin','Admin\UserController@getRegister');
	Route::post('registerstore', array('as'=>'registerstore', 'uses' => 'Admin\UserController@user_Store'));

	Route::get('adminhome', array('as'=>'adminhome', 'uses' => 'Admin\AdminController@dashboard'));

// add user and delete user through admin
	Route::get('/allusers','Admin\UserController@index');
	Route::delete('userdestroy{id}', array('as'=>'userdestroy', 'uses' => 'Admin\UserController@destroy'));

// CRUD Permission
	Route::get('/permission','Admin\PermissionController@index');
	Route::resource('permissions','Admin\PermissionController');

// CRUD Role
	Route::get('/role','Admin\RoleController@index');
	Route::resource('roles','Admin\RoleController');

// Add Permissions To Perticular Role
	Route::get('/assign','Admin\RoleController@assignindex');
	Route::get('fetchassigndata/{id}','Admin\RoleController@fetchassigndata');
	Route::put('permissionupdate/{id}','Admin\RoleController@permissionupdate');

// add Role to Perticular User
	Route::get('/assignrole','Admin\RoleController@assignroleindex');
	Route::get('fetchassignrole/{id}','Admin\RoleController@fetchassignrole');
	Route::put('roleupdate/{id}','Admin\RoleController@roleupdate');

// middle ware for admin authentication
	Route::group(['middleware' => ['admin']], function(){
		Route::get('/dashboard','Admin\AdminController@dashboard');
		Route::get('/logoutadmin','Adminauth\AuthController@logout');

		Route::get('/postindexadmin','Admin\PostController@index');
		Route::get('/createpostadmin','Admin\PostController@create');
		Route::post('/adminpoststore','Admin\PostController@store');
		Route::resource('postadmin','Admin\PostController');
	});

//***FRONT END*****//

//frontend authentication
	Route::auth();

// for blog comment edit add and delete
	Route::get('/blog/{slug}',['as' => 'blog.single', 'uses'=> 
		'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

	Route::get('/blog/{id}/{slug}',['as' => 'blog.edit', 'uses'=> 
		'BlogController@edit'])->where('slug','[\w\d\-\_]+');

	Route::put('/blog/{id}',['as' => 'blog.update', 'uses'=> 
		'BlogController@update'])->where('slug','[\w\d\-\_]+');



// frontend menu
	Route::get('home', 'BlogController@index');
	Route::get('', 'BlogController@index');
	Route::get('about', 'PagesController@about');
	Route::get('contact', 'PagesController@contact');

// Post Controller for frontend
	Route::resource('posts','PostController');

//login and register controller for frontend
	Route::get('login', array('as' => 'login', 'uses' => 'Auth\AuthController@getLogin'));
	Route::get('register', array('as'=>'register', 'uses' => 'Auth\AuthController@getRegister'));

// category, tag and comment resource controller
	Route::resource('catogories','CategoryController');
	Route::resource('tags','TagController');
	Route::resource('comments','CommentController');

//password reset
	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');


	
