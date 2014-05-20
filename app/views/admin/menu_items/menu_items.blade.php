@foreach ( $menu_items as $menu_item )
<li class="bg-info" id="menu_item_{{ $menu_item->id }}">
	<a href="{{ route( 'admin.menu_items.edit', $menu_item->id ) }}">
		<i class="glyphicon glyphicon-move handle"></i>
		{{ $menu_item->title }}
	</a>
	{{ Form::open( array( 'route' => array( 'admin.menu_items.destroy', $menu_item->id ), 'method' => 'delete' ) ) }}
	{{ Form::button( '<i class="glyphicon glyphicon-trash"></i> Delete', array( 'class' => 'btn btn-xs btn-danger', 'type' => 'submit' ) ) }}
	{{ Form::close() }}
	@if ( $menu_item->children->count() )
	<ul class="nav nav-pills nav-stacked">
		@include( 'admin.menu_items.menu_items', array( 'menu_items' => $menu_item->children ) )
	</ul>
	@endif
</li>
@endforeach
