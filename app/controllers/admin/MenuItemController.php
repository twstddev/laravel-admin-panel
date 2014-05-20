<?php
namespace Admin;

class MenuItemController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$menu_items = \MenuItem::whereParentId( null )->orderBy( 'position', 'ASC' )->get();

		$this->layout->content =  \View::make( 'admin.menu_items.index' )
			->with( 'menu_items', $menu_items );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$menu_item = new \MenuItem();

		return \View::make( 'admin.menu_items.create' )
			->with( 'menu_item', $menu_item );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$menu_item = new \MenuItem( \Input::all() );

		if ( $menu_item->save() ) {
			\Session::flash( 'success', 'A menu item has been created.' );
			return \Redirect::route( 'admin.menu_items.index' );
		}
		else {
			return \Redirect::route( 'admin.menu_items.create' )
				->withErrors( $menu_item )
				->withInput();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return \Redirect::route( 'admin.menu_items.edit', array( $id ) );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$menu_item = \MenuItem::find( $id );

		return \View::make( 'admin.menu_items.edit' )
			->with( 'menu_item', $menu_item );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$menu_item = \MenuItem::find( $id );

		if ( $menu_item->update( \Input::all() ) ) {
			\Session::flash( 'success', 'A menu item has been updated.' );
			return \Redirect::route( 'admin.menu_items.index' );
		}
		else {
			return \Redirect::route( 'admin.menu_items.edit', array( $id ) )
				->withErrors( $menu_item )
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
		$menu_item = \MenuItem::find( $id );
		$menu_item->delete();

		\Session::flash( 'success', 'A menu item has been deleted.' );
		return \Redirect::route( 'admin.menu_items.index' );
	}

	/**
	 * @brief Accepts a hierarchy array to use
	 * for menu items sorting.
	 */
	public function sort() {
		if ( \Input::has( 'items' ) ) {
			$this->saveSortedItems( \Input::get( 'items' ) );
		}

		return \Response::make( '', 200 );
	}

	/**
	 * @brief Saves given items positioning and parent.
	 */
	private function saveSortedItems( $items, $parent = null ) {
		foreach ( $items as $index => $object ) {
			if ( isset( $object[ 'id' ] ) ) {
				$current_id = $object[ 'id' ];

				$current_menu_item = \MenuItem::find( $current_id );
				if ( $parent ) {
					$current_menu_item->parent()->associate( \MenuItem::find( $parent ) );
				}
				else {
					$current_menu_item->setAttribute( 'parent_id', null );
				}
				$current_menu_item->position = $index;

				$current_menu_item->save();

				if ( isset( $object[ 'children' ] ) ) {
					$this->saveSortedItems( $object[ 'children' ], $current_id );
				}
			}
		}
	}
}
