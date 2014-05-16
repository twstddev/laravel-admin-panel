<?php 
class UserTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->m_user = new User( array(
			'username' => 'admin',
			'email' => 'admin@admin.com',
			'password' => '123456',
			'password_confirmation' => '123456'
		) );
	}

	public function testRequiresUsername() {
		$this->m_user->username = '';

		$this->assertFalse( $this->m_user->save() );

		$errors = $this->m_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testUsernameUniqueness() {
		$this->m_user->save();

		$clone_user = $this->m_user->replicate();
		$clone_user->email = 'user@admin.com';

		$this->assertFalse( $clone_user->save() );

		$errors = $clone_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testRequiresEmail() {
		$this->m_user->email = '';

		$this->assertFalse( $this->m_user->save() );

		$errors = $this->m_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testValidEmail() {
		$this->m_user->email = 'admin@admin';

		$this->assertFalse( $this->m_user->save() );

		$errors = $this->m_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testEmailUniqueness() {
		$this->m_user->save();

		$clone_user = $this->m_user->replicate();
		$clone_user->username = 'user';

		$this->assertFalse( $clone_user->save() );

		$errors = $clone_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testRequiresPassword() {
		$this->m_user->password = '';

		$this->assertFalse( $this->m_user->save() );

		$errors = $this->m_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	public function testConfirmsPassword() {
		$this->m_user->password_confirmation = 'anotherpass';

		$this->assertFalse( $this->m_user->save() );

		$errors = $this->m_user->errors()->all();
		$this->assertCount( 1, $errors );
	}

	protected $m_user = null;
}
