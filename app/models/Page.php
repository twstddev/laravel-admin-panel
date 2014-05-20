<?php 
use \LaravelBook\Ardent\Ardent;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * @brief Implements a Page object.
 */
class Page extends Ardent implements SluggableInterface {
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
			'' => '',
			'home' => 'Home'
		);
	}

	public function getMetaAttribute( $meta ) {
		return json_decode( $this->attributes[ 'properties' ], true );
	}

	public function setMetaAttribute( $meta ) {
		$this->attributes[ 'properties' ] = json_encode( $meta );
	}

	public function setSlugAttribute( $slug ) {
		if ( empty( $slug ) ) {
			$slug = Str::slug( $this->title );
		}

		$this->attributes[ 'slug' ] = $slug;
	}

	public function beforeValidate() {
		$this->sluggify();
	}

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

	protected $sluggable = array(
		'build_from' => 'title',
		'save_to' => 'slug'
	);

	protected $table = 'pages';

	use SluggableTrait;
}
