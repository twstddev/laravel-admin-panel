@if ( Session::has( 'success' ) )
<p class="alert alert-success alert-dismissable">
	<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{ Session::get( 'success' ) }}
</p>
@endif
@if ( $errors->count() )
	@foreach ( $errors->all() as $error )
	<p class="alert alert-danger alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ $error }}
	</p>
	@endforeach
@endif
{{ Form::model( $user, array( 'class' => 'admin-model-form', 'route' => $route, 'method' => $method ) ) }}
	<section class="container-fluid">
		<div class="row">
			<div class="col-lg-9">
				<div class="form-group">
					{{ Form::label( 'username' ) }}
					{{ Form::text( 'username', null, array( 'class' => 'form-control input-lg', 'placeholder' => 'Enter username...' )  ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'email', 'Email:' ) }}
					{{ Form::text( 'email', null, array( 'class' => 'form-control', 'placeholder' => 'Enter email...' ) ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'password', 'Password:' ) }}
					{{ Form::password( 'password', array( 'class' => 'form-control', 'placeholder' => 'Enter password...' ) ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'password_confirmation', 'Confirm password:' ) }}
					{{ Form::password( 'password_confirmation', array( 'class' => 'form-control', 'placeholder' => 'Confirm password...' ) ) }}
				</div>
				<h3>Profile</h3>
				<div class="form-group">
					{{ Form::label( 'first_name', 'First name:' ) }}
					{{ Form::text( 'first_name', null, array( 'class' => 'form-control', 'placeholder' => 'Enter first name...' )  ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'last_name', 'Last name:' ) }}
					{{ Form::text( 'last_name', null, array( 'class' => 'form-control', 'placeholder' => 'Enter last name...' ) ) }}
				</div>
			</div>
			<aside class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Additional
					</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::label( 'group', 'Group:' ) }}
							{{ Form::select( 'role', $roles, null, array( 'class' => 'form-control' ) ) }}
						</div>
						{{ Form::button( '<i class="glyphicon glyphicon-floppy-save"></i> ' . $submit, array( 'type' => 'submit', 'class' => 'btn btn-block btn-success' ) ) }}
						<a href="{{ route( 'admin.users.index' ) }}" class="btn btn-warning btn-block" type="submit">
							<i class="glyphicon glyphicon-remove"></i>
							Cancel
						</a>
					</div>
				</div>
			</aside>
		</div>
	</section>
{{ Form::close() }}
