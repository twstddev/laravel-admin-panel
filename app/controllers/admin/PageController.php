<?php
namespace Admin;

class PageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = \Page::orderBy( 'title', 'ASC' )->get();
		return \View::make( 'admin.pages.index' )
			->with( 'pages', $pages );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$page = new \Page();

		return \View::make( 'admin.pages.create' )
			->with( 'page', $page );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$page = new \Page( \Input::all() );

		if ( $page->save() ) {
			\Session::flash( 'success', 'A page has been created' );
			return \Redirect::route( 'admin.pages.edit', array( 'page' => $page->id ) );
		}
		else {
			return \Redirect::route( 'admin.pages.create' )
				->withErrors( $page )
				->withInput();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		return \Redirect::route( 'admin.pages.edit', array( $id ) );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = \Page::find( $id );
		return \View::make( 'admin.pages.edit' )
			->with( 'page', $page );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = \Page::find( $id );

		if ( $page->update( \Input::all() ) ) {
			\Session::flash( 'success', 'A page has been updated.' );
			return \Redirect::route( 'admin.pages.edit', array( $id ) );
		}
		else {
			return \Redirect::route( 'admin.pages.edit' )
				->withErrors( $page )
				->withInput();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$page = \Page::find( $id );
		$page->delete();

		\Session::flash( 'success', 'A page has been deleted.' );
		return \Redirect::route( 'admin.pages.index' );
	}


}
