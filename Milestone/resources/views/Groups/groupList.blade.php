<!-- The purpose of this page is to display users in an easy-to-understand format and allow admins to select and edit users/user information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Groups</title>
</head>
    <body>
    <!-- use layouts -->
    	@extends('layouts.appmaster')
		@section('title', 'Login Page')
		@section('content')
		<?php $userID = session('userID');?>
		<form action="addGroup" method="post">
		{{ csrf_field() }}
			<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
			<input type="submit" name="submission" value="Create a new group"></input>
		</form>		
		<!-- table headers set up to hold users -->
    	<table class="usersTable">
        	<tr>
        		<th>Title: </th>
        		<th>Description: </th>
        		<th>Members: </th>
        		<th>Group Details: </th>
        	</tr>
        <!-- foreach loop to populate users table -->
        <?php $i = 0;?>
    	@foreach($groups as $group)
    	<?php 
    	//declare variables for each user to be used in the table
    	$id = $group->getID();
    	$title = $group->getTitle();
    	$description = $group->getDescription();
    	$groupMemberNum = $groupMemberNums[$i];
    	?>
        	<tr>
        	<!-- display user data and include buttons for editing and deleting users -->
        		<td><?php echo $title;?></td>
        		<td><?php if(strlen($description) > 47){echo substr($description, 0, 47) . "...";}else{echo $description;}?></td>
        		<td><?php echo $groupMemberNum;?></td>
    			<td><form action="viewGroup" method="post">
    			{{ csrf_field() }}
    				<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" value="View Group"></input>
    				</form>
    			</td>
        	</tr>
        	<?php $i++;?>
    	@endforeach
		</table>
    	@endsection
    </body>
</html>