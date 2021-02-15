<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Edit User Details</title>
</head>
    <body>
    @extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
    <?php 
        $id = $user->getID();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $role = $user->getRole();
    ?>
    <form action="editedUser" method="post">
    {{ csrf_field() }}
    <div>
    		<h1>ID: <?php echo $id;?></h1>
    		<input type='hidden' name='id' value="<?php echo $id;?>"></input>
	</div>
   		<p>
    		<label for="username">Username: </label>
    		<input type='text' name='username' id='username' value = "<?php echo $username?>"></input>
    		<?php echo $errors->first('username');?>
    	</p>
    	<p>
    		<label for="password">Password: </label>
    		<input type='text' name='password' id='password' value="<?php echo $password?>"></input>
    		<?php echo $errors->first('password');?>
    	</p>
    	<p>
    		<label for="roles">Role: </label>
    		<input type='text' name='roles' id='roles' value="<?php echo $role?>"></input>
    		<br>
    		-1 for suspension
    	</p>
    	<input type="submit" name="submission" value="Edit User"></input>
    </form>
    @endsection
    </body>
</html>