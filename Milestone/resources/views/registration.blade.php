<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Register</title>
</head>
    <body>
    @extends('layouts.appmaster')
	@section('title', 'Registration Page')
	@section('content')
	<form action="registered" method="post">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    <p>
    	<label for="username">Username</label>
    	<input type="text" name="username" id="username"></input>
    	<?php echo $errors->first('username')?>
    </p>
    <p>
    	<label for="password">Password</label>
    	<input type="password" name="password" id="password"></input>
    	<?php echo $errors->first('password')?>
    </p>
    <p>
    	<input type="submit" name="submitted" value="Submit"></input>
    </p>
    </form>
    @endsection
    </body>
</html>