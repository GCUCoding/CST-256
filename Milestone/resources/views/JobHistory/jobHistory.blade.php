<!-- The purpose of this page is to display users in an easy-to-understand format and allow admins to select and edit users/user information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Jobs</title>
</head>
    <body>
    <!-- use layouts -->
    	@extends('layouts.appmaster')
		@section('title', 'Login Page')
		@section('content')
		<?php $role = session('role');?>
		<form action="addJobHistory" method="post">
		{{ csrf_field() }}
			<input type="submit" name="submission" value="Add Job History"></input>
		</form>
		<!-- table headers set up to hold users -->
    	<table class="usersTable">
        	<tr>
        		<th>Title: </th>
        		<th>Company: </th>
        		<th>Start Date: </th>
        		<th>End Date: </th>
        		<th>Description: </th>
        		<th>View Job History</th>
        		<th>Edit</th>
        	</tr>
        <!-- foreach loop to populate users table -->
    	@foreach($jobHistories as $jobHistory)
    	<?php 
    	//declare variables for each user to be used in the table
    	$id = $jobHistory->getID();
    	$title = $jobHistory->getTitle();
    	$startDate = $jobHistory->getStartDate();
    	$endDate = $jobHistory->getEndDate();
    	$description = $jobHistory->getDescription();
    	$company = $jobHistory->getCompany();
    	?>
        	<tr>
        	<!-- display user data and include buttons for editing and deleting users -->
        		<td><?php echo $title;?></td>
        		<td><?php echo $company;?></td>
        		<td><?php echo $startDate;?></td>
        		<td><?php echo $endDate;?>
        		<td><?php echo substr($description, 0, 47) . "...";?></td>
    			<td><form action="viewJobHistory" method="post">
    			{{ csrf_field() }}
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" value="View Job"></input>
    				</form>
    			</td>
    			<td><form action="editJobHistoryPage" method="post">
    			{{ csrf_field() }}
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" value="Edit"></input>
    			</form>	
    			</td>
        	</tr>
    	@endforeach
		</table>
    	@endsection
    </body>
</html>