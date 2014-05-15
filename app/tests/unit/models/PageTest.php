<?php 
class PageTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->page = new Page( array(
			'title' => 'Home',
			'slug' => '/',
			'template' => 'home'
		) );
	}

	public function testRequiresTitle() {
		$this->page->title = '';

		$this->assertFalse( $this->page->save() );

		$errors = $this->page->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testGeneratesDefaultSlug() {
		$this->page->slug = '';
		$this->page->save();

		$this->assertEquals( 'home', $this->page->slug );
	}

	public function testAllowsCustomSlug() {
		$custom_slug = 'my-custom';

		$this->page->slug = $custom_slug;
		$this->page->save();

		$this->assertNotEquals( Page::whereSlug( $custom_slug )->first(), false );
	}

	public function testUniqueSlug() {
		$this->page->slug = 'home';
		$this->page->save();

		$another_page = new Page( array(
			'title' => 'Another page',
			'slug' => 'home'
		) );

		$this->assertFalse( $another_page->save() );

		$errors = $another_page->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testAllowedTemplate() {
		$this->page->template = 'about';

		$this->assertFalse( $this->page->save() );

		$errors = $this->page->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testSavedProperties() {
		$this->page->meta = $this->properties;
		$this->page->save();

		$current_page = Page::whereSlug( '/' )->first();
		$this->assertEquals( $current_page->meta, $this->properties );
	}

	protected $page = null;
	protected $properties = array(
		'meta_field' => 'value'
	);
}
