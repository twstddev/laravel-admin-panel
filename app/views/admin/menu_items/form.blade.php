@if ( $errors->count() )
	@foreach ( $errors->all() as $error )
	<p class="alert alert-danger alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ $error }}
	</p>
	@endforeach
@endif
{{ Form::model( $menu_item, array( 'class' => 'admin-model-form', 'route' => $route, 'method' => $method ) ) }}
	<section class="container-fluid">
		<div class="row">
			<div class="col-lg-9">
				<div class="form-group">
					{{ Form::label( 'title', 'Title:' ) }}
					{{ Form::text( 'title', null, array( 'class' => 'form-control input-lg', 'placeholder' => 'Enter title..' ) ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'url', 'Url:' ) }}
					{{ Form::text( 'url', null, array( 'class' => 'form-control' ) ) }}
				</div>
			</div>
			<aside class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Actions
					</div>
					<div class="panel-body">
						{{ Form::button( '<i class="glyphicon glyphicon-floppy-save"></i> ' . $submit, array( 'type' => 'submit', 'class' => 'btn btn-block btn-success' ) ) }}
						<a href="{{ route( 'admin.menu_items.index' ) }}" class="btn btn-warning btn-block" type="submit">
							<i class="glyphicon glyphicon-remove"></i>
							Cancel
						</a>
					</div>
				</div>
			</aside>
		</div>
	</section>
{{ Form::close() }}
