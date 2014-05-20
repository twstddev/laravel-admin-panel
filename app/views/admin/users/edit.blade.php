@section( 'content' )
	@include( 'admin.users.form', array( 'route' => array( 'admin.users.update', $user->id ), 'method' => 'PUT', 'submit' => 'Update'  ) )
@stop
