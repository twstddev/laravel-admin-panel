<!DOCTYPE html>
<html>
<head>
	<title>Custom CMS</title>
	{{ HTML::style( 'css/bootstrap.min.css' ) }}
	{{ HTML::style( 'css/main.css' ) }}
	{{ HTML::style( 'packages/barryvdh/laravel-elfinder/css/elfinder.min.css' ) }}
	{{ HTML::style( 'packages/barryvdh/laravel-elfinder/css/theme.css' ) }}
	{{ HTML::style( 'css/jquery-ui.min.css' ) }}
	{{ HTML::script( 'js/jquery.min.js' ) }}
	{{ HTML::script( 'js/jquery-migrate.min.js' ) }}
	{{ HTML::script( 'js/jquery-ui.min.js' ) }}
	{{ HTML::script( 'js/bootstrap.min.js' ) }}
	<meta name="csrf-token" content="{{  csrf_token() }}" />
</head>
<body>

@yield( 'main' )

	{{ HTML::script( 'js/jquery.nestedsortable.js' ) }}
	{{ HTML::script( 'js/shared/custom_sortable.js' ) }}
	{{ HTML::script( 'js/tinymce/tinymce.min.js' ) }}
	{{ HTML::script( 'js/shared/has_many_meta.js' ) }}
	{{ HTML::script( 'packages/barryvdh/laravel-elfinder/js/elfinder.min.js' ) }}
	{{ HTML::script( 'js/shared/admin.js' ) }}
</body>
</html>
