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
    <div class="editForm">
    <!-- Form used to represent the data held in the database in an editable manner so it can be updated -->
    <form action="newJob" method="post">
    
    <!-- necessary input for laravel forms -->
    {{ csrf_field() }}
    		<!-- input box to hold user's email -->
    		<label for="title">Job Title: </label>
    		<input type='text' name='title' id='title' value=""></input>
			<br>
			<!-- input box to hold user's phone -->
    		<label for="startDate">Start Date: </label>
    		<input type='date' name='startDate' id='startDate' value=""></input>
			<br>
			<!-- input box to hold user's gender -->
    		<label for="endDate">End Date: </label>
    		<input type='date' name='endDate' id='endDate' value=""></input>
    		<br>
    		<!-- input box to hold user's gender -->
    		<label for="description">Description: </label>
    		<input type='text' name='description' id='description' value = ""></input>
			<br>
			<!-- input box to hold user's description -->
    		<label for="qualifications">Qualifications: </label>
    		<input type='text' name='qualifications' id='qualifications' value = ""></input>
			<br>
			<!-- input box to hold user's skills -->
    		<label for="company">Company: </label>
    		<input type='text' name='company' id='company' value = ""></input>
			<br>
			<!-- input box to hold user's certifications -->
    		<label for="position">Position: </label>
    		<input type='text' name='position' id='position' value = ""></input>
			<br>
			<!-- input box to hold user's certifications -->
    		<label for="schedule">Schedule: </label>
    		<select id='schedule' name='schedule'>
    			<option value="Full-Time">Full-Time</option>
    			<option value="Part-Time">Part-Time</option>
    			<option value="Intern">Intern</option>
    			<option value="Seasonal">Seasonal</option>
    		</select>
			<br>
			<!-- input box to hold user's certifications -->
    		<label for="pay">Pay: </label>
    		<input type='text' name='pay' id='pay' value = ""></input>
			<br><br>
			<!-- User ID and id used to determine which user's info is being edited -->
    	<input type="submit" name="submission" value="Add Job"></input>
    </form>
    </div>
    @endsection
    </body>
</html>