@section( 'content' )
@include( 'admin.pages.form', array( 'route' => array( 'admin.pages.update', $page->id ), 'method' => 'PUT', 'submit' => 'Update'  ) )
@stop
