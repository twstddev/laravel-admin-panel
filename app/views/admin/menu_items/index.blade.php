@section( 'content' )
@if ( Session::has( 'success' ) )
<p class="alert alert-success alert-dismissable">
	<button class="close" type="button" data-dismiss="true" aria-hidden="true">&times;</button>
	{{ Session::get( 'success' ) }}
</p>
@endif
<section class="admin-panel panel panel-default">
	<div class="panel-heading">
		<h4 class="pull-left">
			Menu
		</h4>
		<a class="btn btn-success pull-left" href="{{ route( 'admin.menu_items.create' ) }}">
			<i class="glyphicon glyphicon-file"></i>
			Add new
		</a>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked admin-pills sortable" data-update-url="{{ route( 'admin.menu_items.sort' ) }}">
			@include( 'admin.menu_items.menu_items', array( 'menu_items', $menu_items ) )
		</ul>
	</div>
</section>
@stop
