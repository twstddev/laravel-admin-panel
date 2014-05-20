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

		<form action="#" class="search-form input-group pull-right">
			<input type="text" class="search-input form-control" placeholder="Search..." />
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit">
					<i class="glyphicon glyphicon-search"></i>
				</button>
			</span>
		</form>
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
<ul class="pagination">
		<li class="disabled">
			<a href="#">
				&laquo;
			</a>
		</li>
		<li class="active">
			<a href="#">
				1
				<span class="sr-only">(current)</span>
			</a>
		</li>
		<li>
			<a href="#">
				2
			</a>
		</li>
		<li>
			<a href="#">
				3
			</a>
		</li>
		<li>
			<a href="#">
				&raquo;
			</a>
		</li>
	</ul>
@stop
