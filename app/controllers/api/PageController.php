<?php
namespace Api;

class PageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \Response::json( \Page::orderBy( 'title', 'ASC' )->get() );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = \Page::find( $id );

		if ( !$page ) {
			return \Response::make( '', 404 );
		}

		return \Response::json( $page );
	}


}
