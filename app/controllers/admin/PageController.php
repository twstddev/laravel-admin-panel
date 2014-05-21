<?php
namespace Admin;

class PageController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = null;

		if ( \Input::has( 's' ) && !empty( \Input::get( 's' ) ) ) {
			$search = \Input::get( 's' );

			$pages = \Page::where( 'title', 'LIKE', "%{$search}%" )->orderBy( 'title', 'ASC' );
		}
		else {
			$pages = \Page::orderBy( 'title', 'asc' );
		}

		$pages = $pages->paginate( 10 );

		$this->layout->content = \View::make( 'admin.pages.index' )
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

		$this->layout->content =  \View::make( 'admin.pages.create' )
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
				->withErrors( $page->errors() )
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

		$view_data = array(
			'page' => $page
		);

		$this->layout->content =  \View::make( 'admin.pages.edit' )
			->with( $view_data );
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

		$input_data = \Input::all();

		$page->fill( $input_data );

		if ( isset( $input_data[ 'meta' ] ) ) {
			$page->meta = $input_data[ 'meta' ];
		}
		else {
			$page->meta = "";
		}

		if ( $page->updateUniques() ) {
			\Session::flash( 'success', 'A page has been updated.' );
			return \Redirect::route( 'admin.pages.edit', array( $id ) );
		}
		else {
			return \Redirect::route( 'admin.pages.edit', array( $id ) )
				->withErrors( $page->errors() )
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
