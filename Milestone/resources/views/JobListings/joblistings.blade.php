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
		@if(session('role') == 1 || session('role') == 2)
		<?php $role = session('role');?>
		<form action="addJob" method="post">
		{{ csrf_field() }}
			<input type="hidden" name="role" value="<?php echo $role;?>"></input>
			<input type="submit" name="submission" value="Create a new job listing"></input>
		</form>		
		@endif
		<form action="searchJob" method="post">
			<input type="text" id="searchString" placeholder="Search..."></input><input type="submit" name="submission" value="Search"></input>
		</form>
		<!-- table headers set up to hold users -->
    	<table class="usersTable">
        	<tr>
        		<th>Title: </th>
        		<th>Company: </th>
        		<th>Position: </th>
        		<th>Start Date: </th>
        		<th>Description: </th>
        		<th>View Job</th>
        		@if(session('role') == 1 || session('role') == 2)
        		<th>Edit</th>
        		@endif
        	</tr>
        <!-- foreach loop to populate users table -->
    	@foreach($jobListings as $jobListing)
    	<?php 
    	//declare variables for each user to be used in the table
    	$id = $jobListing->getID();
    	$title = $jobListing->getTitle();
    	$startDate = $jobListing->getStartDate();
    	$endDate = $jobListing->getEndDate();
    	$description = $jobListing->getDescription();
    	$qualifications = $jobListing->getQualifications();
    	$company = $jobListing->getCompany();
    	$position = $jobListing->getPosition();
    	$schedule = $jobListing->getSchedule();
    	$pay = $jobListing->getPay();
    	?>
        	<tr>
        	<!-- display user data and include buttons for editing and deleting users -->
        		<td><?php echo $title;?></td>
        		<td><?php echo $company;?></td>
        		<td><?php echo $position;?></td>
        		<td><?php echo $startDate;?></td>
        		<td><?php echo substr($description, 0, 47) . "...";?></td>
    			<td><form action="viewJob" method="post">
    			{{ csrf_field() }}
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" value="View Job"></input>
    				</form>
    			</td>
    			@if(session('role') == 1 || session('role') == 2)
    			<td><form action="editJobPage" method="post">
    			{{ csrf_field() }}
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" value="Edit"></input>
    			</form>	
    			</td>
    			@endif
        	</tr>
    	@endforeach
		</table>
    	@endsection
    </body>
</html>