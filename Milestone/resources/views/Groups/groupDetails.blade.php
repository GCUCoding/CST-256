<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Group Details</title>
</head>
<body>
    @extends('layouts.appmaster')
	@section('title', 'Group Details')
	@section('content')
	<?php
    //declare variables
	$groupId = $group->getID();
    $groupTitle = $group->getTitle();
    $groupDescription = $group->getDescription();
    $userId = $user->getID();
	?>
	
	<div class="editForm" style="text-align: none">
		<h1>Group #<?php echo $groupId ?>: <?php echo $groupTitle ?></h1>
		<h2>Description: <?php echo $groupDescription ?></h2>
	    <!-- table headers set up to hold users -->
    	<table class="usersTable">
        	<tr>
        		<th>Members: </th>
        		<th>
        		@if($isInGroup == 0 && $isAdminOrLeader == 0)
				<form action="joinGroup" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="userId" value="<?php echo $userId;?>"></input>
    				<input type="hidden" name="groupId" value="<?php echo $groupId;?>"></input>
    				<input type="submit" name="submission" style="background-color: green; color: white;" value="Join Group"></input>
				</form>
				@endif
				@if($isInGroup == 0 && $isAdminOrLeader == 1)
				<form action="joinGroup" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="userId" value="<?php echo $userId;?>"></input>
    				<input type="hidden" name="groupId" value="<?php echo $groupId;?>"></input>
    				<input type="submit" name="submission" style="background-color: green; color: white;" value="Join Group"></input>
				</form>
				@endif
				@if($isInGroup == 1)
        		<form action="leaveGroup" method="post">
        		{{ csrf_field() }}
    				<input type="hidden" name="userId" value="<?php echo $userId?>"></input>
    				<input type="hidden" name="groupId" value="<?php echo $groupId;?>"></input>
    				<input type="submit" name="submission" style="background-color: red; color: white;" value="Leave Group"></input>
        		</form>
        		@endif
        		</th>
        	</tr>
        <!-- foreach loop to populate users table -->
    	@foreach($groupMembers as $groupMember)
        	<tr>
        	<!-- display user data and include buttons for editing and deleting users -->
        		<td><?php echo $groupMember->getUserId();?></td>
				@if($isAdminOrLeader == 1 && $isInGroup == 1 && $userId == $groupMember->getUserId())
				<td><form action="editGroupMembers" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="userId" value="<?php echo $groupMember->getUserId()?>"></input>
    				<input type="hidden" name="groupId" value="<?php echo $groupId;?>"></input>
    				<input type="submit" name="submission" value="Edit Group"></input>
				</form></td>
				@endif
        	</tr>
    	@endforeach
		</table>
	</div>
	
	@endsection
</body>
</html>