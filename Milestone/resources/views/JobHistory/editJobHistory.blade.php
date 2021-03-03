<!-- This page allows an admin to view and edit a user's profile information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Edit Job History</title>
</head>
<body>
@extends('layouts.appmaster')
@section('title', 'Edit Job History')
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
    		<label for="title">Job Title: </label>
    		<input type='text' name='title' id='title' value="<?php echo $title;?>"></input>
			<br>
			<!-- input box to hold user's phone -->
    		<label for="startDate">Start Date: </label>
    		<input type='date' name='startDate' id='startDate' value="<?php echo $startDate;?>"></input>
			<br>
			<!-- input box to hold user's gender -->
    		<label for="endDate">End Date: </label>
    		<input type='date' name='endDate' id='endDate' value="<?php echo $endDate;?>"></input>
    		<br>
    		<!-- input box to hold user's gender -->
    		<label for="description">Description: </label>
    		<input type='text' name='description' id='description' value = "<?php echo $description;?>"></input>
			<br>
			<!-- input box to hold user's skills -->
    		<label for="company">Company: </label>
    		<input type='text' name='company' id='company' value = "<?php echo $company;?>"></input>
			<br><br>
			<!-- User ID and id used to determine which user's info is being edited -->
			<input type="hidden" name="id" value="<?php echo $id;?>"></input>
			<input type="hidden" name="profileID" value="<?php echo $profileID?>"></input>
    	<input type="submit" name="submission" value="Save Changes"></input>
    </form>
    <form action="deleteJobHistory" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="userInfoID" value="<?php echo $profileID?>"></input>
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" style="background-color: red; color: white;" value="Delete Job"></input>
    				<h4><b style="color: red; font-weight: 700;">Warning: This is a permanent change.</b></h4>
	</form>
    </div>
    @endsection
    </body>
</html>