<?php 
Validator::extend( 'template', function( $attribute, $value, $parameters ) {
	return empty( $value ) || array_key_exists( $value, Page::templates() );
} );
