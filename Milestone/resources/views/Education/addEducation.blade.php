<!-- This page allows an admin to view and edit a user's profile information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Add new Education</title>
</head>
<body>
@extends('layouts.appmaster')
@section('title', 'Add new Education')
@section('content')
<?php $userID = session('userID');?>
    <div class="editForm">
    <!-- Form used to represent the data held in the database in an editable manner so it can be updated -->
    <form action="newEducation" method="post">
    
    <!-- necessary input for laravel forms -->
    {{ csrf_field() }}
    		<!-- input box to hold user's email -->
    		<label for="startDate">Start Date: </label></br>
    		<input type="date" name="startDate" id="date1" onchange="dateCheck()"></input>
    		</br>
    		<label for="endDate">Graduation Date: </label></br>
    		<input type="date" name="endDate" id="date2" onchange="dateCheck()"></input>
    		</br>
    		<label for="title">Degree: </label><br>
    		<input type='text' name='title' id='title' value=""></input>
    		<br>
    		<!-- input box to hold user's gender -->
    		<label for="institution">Institution: </label><br>
    		<input type='text' name='institution' id='institution' value = ""></input>
			<br>
			<label for="gpa">GPA: </label></br>
			<input type="text" name="gpa" value=""></input>
			<br>
			<!-- User ID and id used to determine which user's info is being edited -->
			<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
			<input type="submit" name="submission" value="Add Education"></input>
			</form>
			</div>
			@endsection
			</body>
</html>