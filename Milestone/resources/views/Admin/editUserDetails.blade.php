<!-- This page provides admins with the ability to view and edit a user's personal information(username/password) -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Edit User Details</title>
</head>
    <body>
    <!-- includes layouts -->
    @extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
    <?php 
        //declares and initializes variables needed to autofill form later
        $id = $user->getID();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $role = $user->getRole();
    ?>
    <div class="editForm">
    <!-- Form used to edit a user's personal information -->
    <form action="editedUser" method="post">
    <!-- necessary laravel input -->
    	{{ csrf_field() }}
    		
    	<!-- ID's should be unchangeable except directly through the database, so ID is uneditable -->
    		<h3>ID: <?php echo $id;?></h3>
    		<input type='hidden' name='id' value="<?php echo $id;?>"></input>
    		
   		<p>
   		<!-- Shows the user's username in an input box -->
    		<label for="username">Username: </label>
    		<input type='text' name='username' id='username' value = "<?php echo $username?>"></input>
    		<?php echo $errors->first('username');?>
    	</p>
    	
    	<p>
    	<!-- Shows the user's password in an input box -->
    		<label for="password">Password: </label>
    		<input type='text' name='password' id='password' value="<?php echo $password?>"></input>
    		<?php echo $errors->first('password');?>
    	</p>
    	
    	<p>
    	<!-- Shows the user's role in an input box -->
    		<label for="roles">Role: </label>
    		<input type='text' name='roles' id='roles' value="<?php echo $role?>"></input>
    		<br>
    		(-1 for suspension)
    	</p>
    	
    	<!-- Submit button -->
    	<input type="submit" name="submission" value="Edit User"></input>
    </form>
    
    <!-- Form that sends the admin to a page that can edit the user's profile information -->
    <form action="editUserProfile" method="post">
    {{ csrf_field() }}
    
    	<p>
    	<!-- Sends the user's ID to the next page in order to acquire the user's information -->
    		<input type='hidden' name='id' value="<?php echo $id;?>"></input>
    		<input type="submit" name="submitted" value="View/Edit Profile"></input>
    	</p>
    </form>
	</div>
    @endsection
    </body>
</html>