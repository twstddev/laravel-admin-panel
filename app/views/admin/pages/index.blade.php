@section( 'content' )
@if ( Session::has( 'succes' ) )
	<p class="alert alert-success alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get( 'success' ) }}
	</p>
@endif
<section class="admin-panel panel panel-default">
	<div class="panel-heading">
		<h4 class="pull-left">
			Pages
		</h4>
		<a class="btn btn-success pull-left" href="{{ route( 'admin.pages.create' ) }}">
			<i class="glyphicon glyphicon-file"></i>
			Add new
		</a>

		{{ Form::open( array( 'route' => array( 'admin.pages.index' ), 'method' => 'get', 'class' => 'search-form input-group pull-right' ) ) }}
			{{ Form::text( 's', Input::get( 's' ), array( 'class' => 'search-input form-control', 'placeholder' => 'Search...' ) ) }}
			<span class="input-group-btn">
				{{ Form::button( '<i class="glyphicon glyphicon-search"></i>', array( 'class' => 'btn btn-primary', 'type' => 'submit' ) ) }}
			</span>
		{{ Form::close() }}
		<div class="clearfix"></div>
	</div>
	<table class="table table-striped table-hover admin-table">
		<thead>
			<tr>
				<th>Page title</th>
				<th>Page slug</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $pages as $page )
			<tr>
				<td>
					{{ link_to_route( 'admin.pages.edit', $page->title, array( $page->id ) ) }}
				</td>
				<td>
					{{ $page->slug }}
				</td>
				<td class="actions">
					<a class="btn btn-xs btn-warning" href="{{ route( 'admin.pages.edit', array( $page->id ) ) }}">
						<i class="glyphicon glyphicon-pencil"></i> 
						Edit
					</a>

					{{ Form::open( array( 'route' => array( 'admin.pages.destroy', $page->id ), 'method' => 'delete' ) ) }}
					{{ Form::button( '<i class="glyphicon glyphicon-trash"></i> Delete', array( 'type' => 'submit', 'class' => 'btn btn-danger btn-xs' )) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</section>
{{ $pages->links() }}
@stop
