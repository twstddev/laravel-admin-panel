<fieldset class="well inputs has-many-fields">
	<div class="form-group">
		{{ Form::label( 'title', 'Title:' ) }}
		{{ Form::text( $namespace . '[title]', $values[ 'title' ], array( 'class' => 'form-control' ) ) }}
	</div>
	<div class="form-group">
		{{ Form::label( 'summary', 'Summary:' ) }}
		{{ Form::textarea( $namespace . '[summary]', $values[ 'summary' ], array( 'class' => 'form-control rich-editor' ) ) }}
	</div>
	{{ link_to( '#', 'Remove slide', array( 'class' => 'btn btn-danger has-many-remove' ) ) }}
</fieldset>
