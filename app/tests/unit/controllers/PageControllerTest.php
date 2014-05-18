<?php 
class PageControllerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->m_page = Page::create( array(
			'title' => 'Home',
			'slug' => ''
		) );
	}

	public function testIndex() {
		$this->action( 'GET', 'admin.pages.index' );

		$this->assertResponseOk();
		$this->assertViewHas( 'pages' );
		$this->assertViewHas( 'pages', Page::all() );
	}

	public function testCreate() {
		$this->call( 'GET', 'admin/pages/create' );

		$this->assertResponseOk();
		$this->assertViewHas( 'page' );
	}

	public function testStore() {
		$this->call( 'POST', 'admin/pages', array(
			'title' => 'About',
			'slug' => ''
		) );

		$this->assertSessionHas( 'success' );
		$this->assertEquals( 1, Page::whereSlug( 'about' )->count() );
	}

	public function testShow() {
		$this->action( 'GET', 'admin.pages.show', array( $this->m_page->id ) );

		$this->assertRedirectedToAction( 'admin.pages.edit', array( $this->m_page->id ) );
	}

	public function testEdit() {
		$this->action( 'GET', 'admin.pages.edit', array( $this->m_page->id ) );

		$this->assertResponseOk();
		$this->assertViewHas( 'page', Page::find( $this->m_page->id ) );
	}

	public function testUpdate() {
		$this->action( 'PUT', 'admin.pages.update', array( $this->m_page->id ), array( 
			'title' => 'Home',
			'slug' => 'about'
	   	) );

		$this->assertSessionHas( 'success' );
		$this->assertEquals( 1, Page::whereSlug( 'about' )->count() );
	}

	public function testDestroy() {
		$this->action( 'DELETE', 'admin.pages.destroy', array( $this->m_page->id ) );

		$this->assertEquals( 0, Page::all()->count() );
		$this->assertSessionHas( 'success' );
		$this->assertRedirectedToRoute( 'admin.pages.index' );
	}


	private $m_page = null;
}
