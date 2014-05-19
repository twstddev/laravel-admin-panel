<?php 
class MenuItemControllerTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->m_first_item = MenuItem::create( array(
			'title' => 'Home',
			'url' => '/'
		) );

		$this->m_second_item = MenuItem::create( array(
			'title' => 'Gallery',
			'url' => 'gallery'
		) );

		$this->m_third_item = MenuItem::create( array(
			'title' => 'Contact',
			'url' => 'contact'
		) );
	}

	public function testIndex() {
		$this->action( 'GET', 'admin.menu_items.index' );

		$this->assertResponseOk();
		$this->assertViewHas( 'menu_items', MenuItem::all() );
	}

	public function testCreate() {
		$this->action( 'GET', 'admin.menu_items.create'  );

		$this->assertResponseOk();
		$this->assertViewHas( 'menu_item' );
	}

	public function testStore() {
		$this->action( 'POST', 'admin.menu_items.store', array(), array(
			'title' => 'About',
			'url' => 'about'
		) );

		$this->assertSessionHas( 'success' );
		$this->assertEquals( 1, MenuItem::whereTitle( 'About' )->count() );
		$this->assertRedirectedToRoute( 'admin.menu_items.index' );
	}

	public function testShow() {
		$this->action( 'GET', 'admin.menu_items.show', array( $this->m_first_item->id ) );

		$this->assertRedirectedToAction( 'admin.menu_items.edit', array( $this->m_first_item->id ) );
	}

	public function testEdit() {
		$this->action( 'GET', 'admin.menu_items.edit', array( $this->m_first_item->id ) );

		$this->assertResponseOk();
		$this->assertViewHas( 'menu_item', MenuItem::find( $this->m_first_item->id ) );
	}

	public function testUpdate() {
		$this->action( 'PUT', 'admin.menu_items.update', array( $this->m_first_item->id ), array(
			'title' => 'Another',
			'url' => 'another'
		) );

		$this->assertSessionHas( 'success' );
		$this->assertEquals( 1, MenuItem::whereTitle( 'Another' )->count() );
		$this->assertRedirectedToAction( 'admin.menu_items.index' );
	}

	public function testDestroy() {
		$this->action( 'DELETE', 'admin.menu_items.destroy', array( $this->m_first_item->id ) );

		$this->assertNull( MenuItem::find( $this->m_first_item->id ) );
		$this->assertSessionHas( 'success' );
		$this->assertRedirectedToAction( 'admin.menu_items.index' );
	}

	public function testSort() {
		$this->action( 'POST', 'admin.menu_items.sort', array(), array(
			'items' => array(
				array(
					'id' => $this->m_first_item->id,
					'children' => array(
						'0' => array(
							'id' => $this->m_second_item->id
						),
						'1' => array( 
							'id' => $this->m_third_item->id
						)
					)
				)
			)
		) );

		$this->assertEquals( $this->m_first_item->id, MenuItem::find( $this->m_second_item->id )->parent->id );
	}

	private $m_first_item = null;
	private $m_second_item = null;
	private $m_third_item = null;
}
