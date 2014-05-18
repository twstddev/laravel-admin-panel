<?php 
class PageControllerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->m_page = Page::create( array(
			'title' => 'Home'
		) );
	}

	public function testIndex() {
		$this->call( 'GET', 'admin/pages' );

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
			'title' => 'About'
		) );

		$this->assertResponseOk();
		$this->assertEquals( 2, Post::all()->count() );
	}

	public function testShow() {
		$this->call( 'GET', 'admin/pages/' + $this->m_page->id );

		$this->assertResponseOk();
		$this->assertViewHas( 'page', $this->m_page );
	}

	public function testEdit() {
		$this->call( 'GET' ,'admin/pages' + $this->m_page->id + '/edit' );

		$this->assertResponseOk();
		$this->assertViewHas( 'page', $this->m_page );
	}

	public function testUpdate() {
		$this->call( 'PUT', 'admin/pages/' + $this->m_page->id, array( 
			'title' => 'Home',
			'slug' => 'about'
	   	) );

		$this->assertResponseOk();
		$this->assertEquals( 1, Page::whereSlug( 'about' )->count() );
	}

	public function testDestroy() {
		$this->call( 'DELETE', 'admin/pages/' + $this-m_page->id );

		$this->assertResponseOk();
		$this->assertEquals( 0, Page::all()->count() );
	}


	private $m_page = null;
}
