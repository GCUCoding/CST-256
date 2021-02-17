<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Login</title>
</head>
    <body>
    @extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
	<div class="editForm">
	<h2>Login to your account:</h2>
	<form action="logged" method="post">
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
    </form>
    </div>
    @endsection
    </body>
</html>