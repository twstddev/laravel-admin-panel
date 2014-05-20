<?php
namespace Admin;

class UserController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = \User::all();

		$this->layout->content = \View::make( 'admin.users.index' )
			->with( 'users', $users );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new \User();

		$this->layout->content = \View::make( 'admin.users.create' )
			->with( 'user', $user )
			->with( 'roles', $this->getRolesList() );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new \User( \Input::all() );

		if ( $user->save() ) {
			\Session::flash( 'success', 'A new user has been created.' );
			return \Redirect::route( 'admin.users.index' );
		}
		else {
			return \Redirect::route( 'admin.users.create' )
				->withErrors( $user->errors() )
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
		return \Redirect::route( 'admin.users.edit', array( $id ) );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = \User::find( $id );

		$this->layout->content = \View::make( 'admin.users.edit' )
			->with( 'user', $user )
			->with( 'roles', $this->getRolesList() );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = \User::find( $id );
		$user->fill( \Input::all() );

		if ( $user->updateUniques() ) {
			\Session::flash( 'success', 'User has been updated.' );
			return \Redirect::route( 'admin.users.index' );
		}
		else {
			return \Redirect::route( 'admin.users.edit', array( $id ) )
				->withErrors( $user->errors() )
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
		$user = \User::find( $id );
		$user->delete();

		\Session::flash( 'success', 'User has been deleted.' );
		return \Redirect::route( 'admin.users.index' );
	}


	/**
	 * @brief Prepares a list of roles
	 * that match the default drop down markdown.
	 */
	private function getRolesList() {
		$roles = \Role::all();

		$roles_list = array();

		foreach ( $roles as $role ) {
			$roles_list[ $role->id ] = $role->name;
		}

		return $roles_list;
	}

}
