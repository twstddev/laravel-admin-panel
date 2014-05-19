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

Route::when( '*', 'csrf', array( 'post' ) );
