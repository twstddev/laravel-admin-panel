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
{{ Form::model( $page, array( 'class' => 'admin-model-form', 'route' => $route, 'method' => $method ) ) }}
	<section class="container-fluid">
		<div class="row">
			<div class="col-lg-9">
				<div class="form-group">
					{{ Form::label( 'title', 'Title:' ) }}
					{{ Form::text( 'title', null, array( 'class' => 'form-control input-lg', 'placeholder' => 'Enter title...' ) ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'slug', 'Slug:' ) }}
					{{ Form::text( 'slug', null, array( 'class' => 'form-control', 'placeholder' => 'Enter slug...' ) ) }}
				</div>
				<div class="form-group">
					{{ Form::label( 'body', 'Body:' ) }}
					{{ Form::textarea( 'body', null, array( 'class' => 'form-control', 'rows' => 15 ) ) }}
				</div>
				<h3>Extra</h3>
			</div>
			<aside class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Additional
					</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::label( 'template', 'Template:' )}}
							{{ Form::select( 'template', Page::templates(), null, array( 'class' => 'form-control' ) ) }}
						</div>
						{{ Form::button( '<i class="glyphicon glyphicon-floppy-save"></i> ' . $submit, array( 'type' => 'submit', 'class' => 'btn btn-block btn-success' )) }}
						<a href="{{ route( 'admin.pages.index' ) }}" class="btn btn-block btn-warning" type="submit">
							<i class="glyphicon glyphicon-remove"></i>
							Cancel
						</a>
					</div>
				</div>
			</aside>
		</div>
	</section>
{{ Form::close() }}
