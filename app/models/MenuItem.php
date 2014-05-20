<?php 
use \LaravelBook\Ardent\Ardent;

/**
 * @brief Implements an object that represents
 * a single menu item.
 */
class MenuItem extends Ardent {
	/**
	 * @brief Represents relationship to another
	 * menu item as a parent.
	 */
	public function parent() {
		return $this->belongsTo( 'MenuItem', 'parent_id' );
	}

	/**
	 * @brief Holds other menu items that are
	 * direct children of the current item.
	 */
	public function children() {
		return $this->hasMany( 'MenuItem', 'parent_id' )->orderBy( 'position', 'ASC' );
	}

	public static $rules = array(
		'title' => 'required',
		'url' => 'required',
		'position' => 'numeric'
	);

	protected $fillable = array(
		'title',
		'url',
		'position'
	);
}
