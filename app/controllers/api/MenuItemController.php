<?php
namespace Api;

class MenuItemController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \Response::json( \MenuItem::orderBy( 'position', 'ASC' )->get() );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$menu_item = \MenuItem::find( $id );

		if ( !$menu_item ) {
			return \Response::make( '', 404 );
		}

		return \Response::json( $menu_item );
	}
}
