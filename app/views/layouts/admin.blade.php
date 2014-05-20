@extends( 'layouts.default' )

@section( 'main' )
<header>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
					<a class="navbar-brand" href="#">Laravel Admin</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown username-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="http://placehold.it/40x40" alt="Username" class="username-image" />
							{{ Auth::user()->username }} <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route( 'admin.users.edit', Auth::user()->id ) }}"><i class="glyphicon glyphicon-user"></i> My Profile</a>
							</li>
							<li class="divider"></li>
							<li>
								{{ Form::open( array( 'route' => 'logout', 'method' => 'delete' ) ) }}
								{{ Form::button( '<i class="glyphicon glyphicon-off"></i> Log Out', array( 'type' => 'submit', 'class' => 'btn btn-danger btn-block' ) ) }}
								{{ Form::close() }}
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<aside class="admin-sidebar">
	<ul class="list-group">
		<li>
			<a class="list-group-item {{ Admin\is_active_controller( 'pages' ) }}" href="{{ route( 'admin.pages.index' ) }}">
				<i class="glyphicon glyphicon-folder-close"></i>
				Pages
			</a>
		</li>
		<li>
			<a class="list-group-item {{ Admin\is_active_controller( 'menu_items' ) }}" href="{{ route( 'admin.menu_items.index' ) }}">
				<i class="glyphicon glyphicon-tasks"></i>
				Menu
			</a>
		</li>
		<li>
			<a class="list-group-item {{ Admin\is_active_controller( 'users' ) }}" href="{{ route( 'admin.users.index' ) }}">
				<i class="glyphicon glyphicon-user"></i>
				Users
			</a>
		</li>
	</ul>
</aside>
<section class="main-admin-page">
	@yield( 'content' )
</section>
@stop
