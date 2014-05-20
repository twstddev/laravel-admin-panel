@section( 'content' )
	@include( 'admin.users.form', array( 'route' => array( 'admin.users.store' ), 'method' => 'post', 'submit' => 'Save'  ) )
@stop
