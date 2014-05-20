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
			Users
		</h4>
		<a class="btn btn-success pull-left" href="{{ route( 'admin.users.create' ) }}">
			<i class="glyphicon glyphicon-file"></i>
			Add new
		</a>
		<form class="search-form input-group pull-right" action="#">
			<input class="search-input form-control" type="text" placeholder="Search..." />
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
				<th>Usename</th>
				<th>Email</th>
				<th>Group</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $users as $user )
			<tr>
				<td>
					{{ link_to_route( 'admin.users.edit', $user->username, array( $user->id ) ) }}
				</td>
				<td>
					{{ $user->email }}
				</td>
				<td>
					{{ $user->roles()->first() }}
				</td>
				<td class="actions">
					<a class="btn btn-xs btn-warning" href="{{ route( 'admin.users.edit', array( $user->id ) ) }}">
						<i class="glyphicon glyphicon-pencil"></i>
						Edit
					</a>
					{{ Form::open( array( 'route' => array( 'admin.users.destroy', $user->id ), 'method' => 'delete' ) ) }}
						{{ Form::button( '<i class="glyphicon glyphicon-trash"></i> Delete', array( 'type' => 'submit', 'class' => 'btn btn-danger btn-xs' )) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</section>
@stop
