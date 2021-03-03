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
    <form action="newJobHistory" method="post">
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
			<!-- input box to hold user's skills -->
    		<label for="company">Company: </label>
    		<input type='text' name='company' id='company' value = ""></input>
			<br><br>
			<!-- User ID and id used to determine which user's info is being edited -->
			<input type="hidden" name="profileID" value="<?php echo $profileID;?>"></input>
    	<input type="submit" name="submission" value="Add Job"></input>
    </form>
    </div>
    @endsection
    </body>
</html>