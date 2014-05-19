@extends( 'layouts.general' )

@section( 'content' )
<section class="general-page">
	<div class="login-form panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Admin Panel</h3>
		</div>
		<div class="panel-body">
			{{ Form::open( array( 'route' => 'login.get' ) ) }}
				@if ( Session::has( 'errors' ) )
					@foreach ( Session::get( 'errors' ) as $error )
					<p class="alert alert-danger">
						{{ $error }}
					</p>
					@endforeach
				@endif
				<div class="form-group">
					{{ Form::label( 'username', 'Username:' ) }}
					<div class="input-group">
						{{ Form::text( 'username', Input::old( 'username' ), array( 'class' => 'form-control', 'placeholder' => 'Enter your username..' ) ) }}
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-user"></i>
						</span>
					</div>
				</div>
				<div class="form-group">
					{{ Form::label( 'password', 'Password:' ) }}
					<div class="input-group">
						{{ Form::password( 'password', array( 'class' => 'form-control', 'placeholder' => 'Enter your password...' ) ) }}
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-lock"></i>
						</span>
					</div>
				</div>
				<div class="checkbox">
					<label>
						{{ Form::checkbox( 'remember_me', 'yes' ) }} Remember me
					</label>
				</div>
				{{ Form::button( 'Log in', array( 'class' => 'btn btn-primary pull-right', 'type' => 'submit' ) ) }}
			{{ Form::close() }}
		</div>
	</div>
</section>
@stop
