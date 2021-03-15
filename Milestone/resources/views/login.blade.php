<!-- login page -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Login</title>
</head>
    <body>
    <!-- shows layout -->
    @extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
	<div class="editForm">
	<h2>Login to your account:</h2>
	<!-- form to hold and pass login info to /logged route -->
	<form action="logged" method="post">
	{{ csrf_field() }}
		<table class="alignedFormTable">
			<tr>
				<th><label for="username">Username:</label></th>
				<td>
					<input type="text" name="username" id="username"></input>
					<!-- shows errors if username errors -->
					<?php echo $errors->first('username')?>
				</td>
			</tr>
			<tr>
				<th><label for="password">Password:</label></th>
				<td>
					<input type="password" name="password" id="password"></input>
					<!-- shows errors if password errors -->
					<?php echo $errors->first('password')?>
				</td>
			</tr>
		</table>
    	<input type="submit" name="submitted" value="Submit"></input>
    </form>
    </div>
    @endsection
    </body>
</html>