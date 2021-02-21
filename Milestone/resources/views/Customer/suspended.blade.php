<!-- page that only shows up for suspended users -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Suspended</title>
</head>
	<body>
	<!-- include layouts -->
	@extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
	<!-- show suspension message -->
	<h1>This account is suspended. Please try again with a different account.</h1>
	@endsection
	</body>
</html>