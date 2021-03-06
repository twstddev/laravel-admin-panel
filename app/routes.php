<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::group( array( 
	'prefix' => 'admin',
	'before' => 'auth',
	'namespace' => 'Admin'
	), function() {
	Route::get( '/', 'PageController@index' );

	Route::resource( 'pages', 'PageController' );
	Route::resource( 'menu_items', 'MenuItemController' );
	Route::resource( 'users', 'UserController' );
	Route::post( 'menu_items/sort', array(
		'uses' => 'MenuItemController@sort',
		'as' => 'admin.menu_items.sort'
	) );
} );

Route::group( array(
	'prefix' => 'api',
	'namespace' => 'Api'
	), function() {
	Route::get( '/', 'PageController@index' );

	Route::resource( 'pages', 'PageController', array(
		'only' => array(
			'index',
			'show'
		)
	) );

	Route::resource( 'menu_items', 'MenuItemController', array(
		'only' => array(
			'index',
			'show'
		)
	) );
} );

Route::get( 'login', array(
	'uses' => 'SessionController@getLogin',
	'as' => 'login.get'
) );

Route::post( 'login', array(
	'uses' => 'SessionController@postLogin',
	'as' => 'login.post'
) );

Route::delete( 'logout', array(
	'uses' => 'SessionController@logOut',
	'as' => 'logout'
) );

Route::group( array( 'before' => 'auth' ), function() {
	Route::get( 'elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex' );
	Route::any( 'elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector' );
	Route::get( 'elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4' );
} );

Route::when( 'admin/*', 'csrf', array( 'post' ) );
