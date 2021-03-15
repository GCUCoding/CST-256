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
		{{ csrf_field() }}
			<table class="alignedFormTable">
    			<tr>
                	<th><label for="username">Username:</label></th>
                	<td>
                		<input type="text" name="username" id="username"></input>
                		<?php echo $errors->first('username')?>
                	</td>
            	</tr>
            	<tr>
                	<th><label for="password">Password:</label></th>
                	<td>
                		<input type="password" name="password" id="password"></input>
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