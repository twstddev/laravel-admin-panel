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
	}

	/**
	 * @brief Logs out current user.
	 */
	public function logOut() {
	}
}
