<?php 
class PageTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->m_page = new Page( array(
			'title' => 'Home',
			'slug' => '/',
			'template' => 'home'
		) );
	}

	public function testRequiresTitle() {
		$this->m_page->title = '';

		$this->assertFalse( $this->m_page->save() );

		$errors = $this->m_page->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testGeneratesDefaultSlug() {
		$this->m_page->slug = '';
		$this->m_page->save();
		Sluggable::make( $this->m_page, true );

		$this->assertEquals( 'home', $this->m_page->slug );
	}

	public function testAllowsCustomSlug() {
		$custom_slug = 'my-custom';

		$this->m_page->slug = $custom_slug;
		$this->m_page->save();

		$this->assertNotEquals( Page::whereSlug( $custom_slug )->first(), false );
	}

	public function testUniqueSlug() {
		$this->m_page->slug = 'home';
		$this->m_page->save();

		$another_page = new Page( array(
			'title' => 'Another page',
			'slug' => 'home'
		) );

		$this->assertFalse( $another_page->save() );

		$errors = $another_page->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testAllowedTemplate() {
		$this->m_page->template = 'about';

		$this->assertFalse( $this->m_page->save() );

		$errors = $this->m_page->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testSavedProperties() {
		$this->m_page->meta = $this->m_properties;
		$this->m_page->save();

		$current_page = Page::whereSlug( '/' )->first();
		$this->assertEquals( $current_page->meta, $this->m_properties );
	}

	protected $m_page = null;
	protected $m_properties = array(
		'meta_field' => 'value'
	);
}
