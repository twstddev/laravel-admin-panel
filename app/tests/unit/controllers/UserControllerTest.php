<?php 
class UserControllerTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->m_user = User::create( array(
			'username' => 'admin',
			'email' => 'admin@admin.com',
			'password' => '123456',
			'password_confirmation' => '123456'
		) );
	}

	public function testIndex() {
		$this->action( 'GET', 'admin.users.index' );

		$this->assertResponseOk();
		$this->assertViewHas( 'users', User::all() );
	}

	public function testCreate() {
		$this->action( 'GET', 'admin.users.create' );

		$this->assertResponseOk();
		$this->assertViewHas( 'user' );
	}

	public function testStore() {
		$this->action( 'POST', 'admin.users.store', array(), array(
			'username' => 'user',
			'email' => 'user@admin.com',
			'password' => '123456',
			'password_confirmation' => '123456'
		) );

		$this->assertSessionHas( 'success' );
		$this->assertEquals( 1, User::whereUsername( 'user' )->count() );
		$this->assertRedirectedToRoute( 'admin.users.index' );
	}

	public function testShow() {
		$this->action( 'GET', 'admin.users.show', array( $this->m_user->id ) );

		$this->assertRedirectedToAction( 'admin.users.edit', array( $this->m_user->id ) );
	}

	public function testEdit() {
		$this->action( 'GET', 'admin.users.edit', array( $this->m_user->id ) );

		$this->assertResponseOk();
		$this->assertViewHas( 'user', User::find( $this->m_user->id ) );
	}

	public function testUpdate() {
		$this->action( 'PUT', 'admin.users.update', array( $this->m_user->id ), array(
			'username' => 'test',
			'email' => 'user@admin.com',
			'password' => '123456',
			'password_confirmation' => '123456'
		) );

		$this->assertSessionHas( 'success' );
		$this->assertEquals( 1, User::whereUsername( 'test' )->count() );
		$this->assertRedirectedToAction( 'admin.users.index' );
	}

	public function testDestroy() {
		$this->action( 'DELETE', 'admin.users.destroy', array( $this->m_user->id ) );

		$this->assertEquals( 0, User::all()->count() );
		$this->assertSessionHas( 'success' );
		$this->assertRedirectedToAction( 'admin.users.index' );
	}

	private $m_user;
}
