<?php 
Form::macro( 'picker', function( $name, $value = '' ) {
	return "
		<div class=\"input-group file-picker\">
			<input type=\"text\" name=\"{$name}\" value=\"{$value}\" class=\"form-control\" />
			<span class=\"input-group-btn\">
			<a href=\"#\" class=\"btn btn-success\">
				<i class=\"glyphicon glyphicon-search\"></i>
			</a>
			</span>
		</div>
	";
} );
