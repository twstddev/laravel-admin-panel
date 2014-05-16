<?php 
class MenuItemTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->m_home_item = new MenuItem( array(
			'title' => 'Home',
			'url' => 'home'
		) );

		$this->m_gallery_item = new MenutItem( array(
			'title' => 'Gallery',
			'url' => 'gallery'
		) );
	}

	public function testRequiresTitle() {
		$this->m_home_item->title = '';

		$this->assertFalse( $this->m_home_item->save() );

		$errors = $this->m_home_item->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testRequriesUrl() {
		$this->m_home_item->url = '';

		$this->assertFalse( $this->m_home_item->save );

		$errors = $this->m_home_item->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testAllowsParent() {
		$this->m_home_item->save();
		$this->m_home_item->children()->save( $this->m_gallery_item );

		$this->assertequals( $this->m_gallery_item->parent->id, $this->m_home_item->id );
	}

	public function testContainsChildrend() {
		$this->m_home_item->save();
		$this->m_gallery_item->parent()->associate( $this->m_home_item );

		$this->assertequals( $this->m_home_item->children()->first()->id, $this->m_gallery_item->id );
	}

	protected $m_home_item = null;
	protected $m_gallery_item = null;
}
