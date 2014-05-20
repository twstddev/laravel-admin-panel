@section( 'content' )
@include( 'admin.menu_items.form', array( 'route' => array( 'admin.menu_items.update', $menu_item->id ), 'method' => 'PUT', 'submit' => 'Update'  ) )
@stop
