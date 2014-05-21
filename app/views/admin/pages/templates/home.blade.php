<?php 
$slide_form = View::make( 'admin.pages.templates.form.slide', array(
	'namespace' => 'meta[slider][NEW_SLIDER]',
	'values' => array( 
		'title' => '',
		'summary' => ''
   	)
) );
?>
<div class="nested-meta-fields" data-index="{{ count( $page->meta[ 'slider' ] ) }}">
	@foreach ( $page->meta[ 'slider' ] as $index => $slide )
		@include( 'admin.pages.templates.form.slide', array( 'namespace' => 'meta[slider][' . ( $index + 1 ) . ']', 'values' => $slide ) )
	@endforeach
</div>
<a href="#" class="btn btn-primary has-many-meta" data-placeholder="NEW_SLIDER" data-html='{{{ $slide_form }}}'>
	Add slide
</a>

