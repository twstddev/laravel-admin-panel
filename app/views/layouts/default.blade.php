<!DOCTYPE html>
<html>
<head>
  <title>Custom CMS</title>
  {{ HTML::style( 'css/bootstrap.min.css' ) }}
  {{ HTML::style( 'css/main.css' ) }}
  {{ HTML::style( 'js/bootstrap.min.js' ) }}
  <meta name="csrf-token" content="{{  csrf_token() }}" />
</head>
<body>

@yield( 'main' )

</body>
</html>
