<!-- The purpose of this page is to display users in an easy-to-understand format and allow admins to select and edit users/user information -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>All Users</title>
</head>
    <body>
    <!-- use layours -->
    	@extends('layouts.appmaster')
		@section('title', 'Login Page')
		@section('content')
		<!-- table headers set up to hold users -->
    	<table class="usersTable">
        	<tr>
        		<th>ID: </th>
        		<th>Username: </th>
        		<th>Password: </th>
        		<th>Role: </th>
        		<th>Edit: </th>
    			<th>Delete: </th>
        	</tr>
        <!-- foreach loop to populate users table -->
    	@foreach($users as $user)
    	<?php 
    	//declare variables for each user to be used in the table
    	$id = $user->getID();
    	$username = $user->getUsername();
    	$password = $user->getPassword();
    	$role = $user->getRole();
    	?>
        	<tr>
        	<!-- display user data and include buttons for editing and deleting users -->
        		<td><?php echo $id;?></td>
        		<td><?php echo $username;?></td>
        		<td><?php echo $password;?></td>
        		<td><?php echo $role;?></td>
    			<td><form action="editUser" method="post">
        			<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        			<input type="submit" name="submitted" value="Edit"></input>
        			<input type='hidden' name='id' value = "<?php echo $id ?>"></input></form>
        		</td>
        		<td><form action="deleteUser" method="post">
        			<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        			<input type="submit" name="submitted" value="Delete"></input>
        			<input type='hidden' name='id' value = "<?php echo $id ?>"></input></form>
        		</td>
        	</tr>
    	@endforeach
		</table>
    	@endsection
    </body>
</html>