<?php 
namespace Admin;

/**
 * @brief Checks whether passed controller name
 * is the currently navigated controller.
 *
 * @param[in] String $controll_name is the name to check
 * against
 */
function is_active_controller( $controller_name ) {
	return ( \Request::is( 'admin/' . $controller_name  ) ) ? 'active' : '';
}
