<?php 
use \LaravelBook\Ardent\Ardent;

/**
 * @brief Implements a Page object.
 */
class Page extends Ardent {
	/**
	 * @brief Constructor that adds custom validation
	 * to make sure that given template is allowed.
	 */
	public function __construct( $attributes = array() ) {
		parent::__construct( $attributes );
	}

	/**
	 * @brief Returns a list of allowed templates.
	 */
	public static function templates() {
		return array(
			'home' => 'Home'
		);
	}

	public function getMetaAttribute( $meta ) {
		return json_decode( $this->properties, true );
	}

	public function setMetaAttribute( $meta ) {
		$this->properties = json_encode( $meta );
	}

	public static $sluggable = array(
		'build_from' => 'title',
		'save_to' => 'slug'
	);

	public static $rules = array(
		'title' => 'required',
		'slug' => 'required|unique:pages',
		'template' => 'template'
	);

	protected $fillable = array(
		'title',
		'slug',
		'template',
		'body',
		'meta'
	);
}
