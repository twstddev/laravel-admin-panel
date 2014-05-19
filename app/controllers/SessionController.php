<?php 
class SessionController extends BaseController {
	/**
	 * @brief Returns the log in form.
	 */
	public function getLogin() {
		return View::make( 'general.login' );
	}

	/**
	 * @brief Attempts log in.
	 */
	public function postLogin() {
		$login_validation_rules = array(
			'username' => 'required',
			'password' => 'required'
		);

		$validation = Validator::make( Input::all(), $login_validation_rules );

		if ( $validation->fails() ) {
			return Redirect::route( 'login.get' )
				->withErrors( $validation )
				->withInput();
		}

		$login_data = array(
			'username' => Input::get( 'username' ),
			'password' => Input::get( 'password' )
		);

		if ( !Auth::validate( $login_data ) ) {
			return Redirect::route( 'login.get' )
				->with( 'error', 'Invalid username or password.' )
				->withInput();
		}

		$remember_me = Input::get( 'remember_me' ) == 'yes' ? true : false;

		Auth::attempt( $login_data, $remember_me );

		return Redirect::intended( URL::route( 'admin.pages.index' ) );
	}

	/**
	 * @brief Logs out current user.
	 */
	public function logOut() {
	}

	protected $layout = 'layouts.general';
}
