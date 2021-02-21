<!-- page to allow the user to register -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Register</title>
</head>
    <body>
    <!-- applies layouts -->
    @extends('layouts.appmaster')
	@section('title', 'Registration Page')
	@section('content')
	<div class = "editForm">
	<!-- form that allows the user to register themselves -->
	<h2>Register for an account:</h2>
	<form action="registered" method="post">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    	<label for="username">Username</label>
    	<input type="text" name="username" id="username"></input>
    	<?php echo $errors->first('username')?>
		<br>
    	<label for="password">Password</label>
    	<input type="password" name="password" id="password"></input>
    	<?php echo $errors->first('password')?>
		<br>
    	<input type="submit" name="submitted" value="Submit"></input>
    </p>
    </form>
    </div>
    @endsection
    </body>
</html>