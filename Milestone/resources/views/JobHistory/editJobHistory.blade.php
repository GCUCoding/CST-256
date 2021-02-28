<!-- This page allows an admin to view and edit a user's profile information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Edit User Profile</title>
</head>
<body>
@extends('layouts.appmaster')
@section('title', 'Edit User Profile')
@section('content')
<?php 
    $id = $jobHistory->getID();
    $title = $jobHistory->getTitle();
    $startDate = $jobHistory->getStartDate();
    $endDate = $jobHistory->getEndDate();
    $description = $jobHistory->getDescription();
    $company = $jobHistory->getCompany();
    $profileID = $jobHistory->getProfileID();
?>
    <div class="editForm">
    <!-- Form used to represent the data held in the database in an editable manner so it can be updated -->
    <form action="editJobHistory" method="post">
    
    <!-- necessary input for laravel forms -->
    {{ csrf_field() }}
    		<!-- input box to hold user's email -->
    		<label for="title">Job Title: </label><br>
    		<input type='text' name='title' id='title' value="<?php echo $title;?>"></input>
			<br>
			<!-- input box to hold user's phone -->
    		<label for="startDate">Start Date: </label><br>
    		<input type='date' name='startDate' id='startDate' value="<?php echo $startDate;?>"></input>
			<br>
			<!-- input box to hold user's gender -->
    		<label for="endDate">End Date: </label><br>
    		<input type='date' name='endDate' id='endDate' value="<?php echo $endDate;?>"></input>
    		<br>
    		<!-- input box to hold user's gender -->
    		<label for="description">Description: </label><br>
    		<input type='text' name='description' id='description' value = "<?php echo $description;?>"></input>
			<br>
			<!-- input box to hold user's skills -->
    		<label for="company">Company: </label><br>
    		<input type='text' name='company' id='company' value = "<?php echo $company;?>"></input>
			<br>
			<!-- User ID and id used to determine which user's info is being edited -->
			<input type="hidden" name="id" value="<?php echo $id;?>"></input>
			<input type="hidden" name="profileID" value="<?php echo $profileID?>"></input>
    	<input type="submit" name="submission" value="Save Changes"></input>
    </form>
    </div>
    @endsection
    </body>
</html>