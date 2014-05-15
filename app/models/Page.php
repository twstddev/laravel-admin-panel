<?php 
/**
 * @brief Implements a Page object.
 */
class Page extends Eloquent {
	protected $fillable = array(
		'title',
		'slug',
		'template',
		'body',
		'properties'
	);
}
