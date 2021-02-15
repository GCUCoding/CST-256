<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>All Users</title>
</head>
    <body>
    	<h3>Admin Page Test</h3>
    	@extends('layouts.appmaster')
		@section('title', 'Login Page')
		@section('content')
    	@foreach($users as $user)
    	<?php 
    	$id = $user->getID();
    	$username = $user->getUsername();
    	$password = $user->getPassword();
    	$role = $user->getRole();
    	?>
    	<p>
    	<h5>ID: <?php echo $id;?></h5>
    	</p>
    	<p>
    	<h5>Username: <?php echo $username;?></h5>
    	</p>
    	<p>
    	<h5>Password: <?php echo $password;?></h5>
    	</p>
    	<p>
    	<h5>Role: <?php echo $role;?></h5>
    	</p>
    	<p>
    	<form action="editUser" method="post">
    	<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    		<input type="submit" name="submitted" value="Edit"></input>
    		<input type='hidden' name='id' value = "<?php echo $id ?>"></input>
    	</form>
    	</p>
    	<p>
    	<form action="deleteUser" method="post">
    	<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    		<input type="submit" name="submitted" value="Delete"></input>
    		<input type='hidden' name='id' value = "<?php echo $id ?>"></input>
    	</form>
    	</p>
    	<hr>
    	@endforeach
    	@endsection
    </body>
</html>