<?php 
$slide_form = View::make( 'admin.pages.templates.form.slide', array(
	'namespace' => 'meta[slider][NEW_SLIDER]',
	'values' => array( 
		'title' => '',
		'summary' => ''
   	)
) );

$last_index = isset( $page->meta[ 'slider' ] ) ? count( $page->meta[ 'slider' ] ) : 0;

$current_index = 0;
?>
<div class="nested-meta-fields" data-index="{{ $last_index }}">
	@if ( $last_index )
		@foreach ( $page->meta[ 'slider' ] as $index => $slide )
			@include( 'admin.pages.templates.form.slide', array( 'namespace' => 'meta[slider][' . $current_index . ']', 'values' => $slide ) )
			<?php $current_index++; ?>
		@endforeach
	@endif
</div>
<a href="#" class="btn btn-primary has-many-meta" data-placeholder="NEW_SLIDER" data-html="{{{ $slide_form }}}">
	Add slide
</a>

