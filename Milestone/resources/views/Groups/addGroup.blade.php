<!-- This page allows an admin to view and edit a user's profile information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Add new Group</title>
</head>
<body>
@extends('layouts.appmaster')
@section('title', 'Add new Group')
@section('content')
<?php $userID = session('userID');?>
    <div class="editForm">
    <!-- Form used to represent the data held in the database in an editable manner so it can be updated -->
    <form action="newGroup" method="post">
    
    <!-- necessary input for laravel forms -->
    {{ csrf_field() }}
    		<!-- input box to hold user's email -->
    		<label for="title">Group Topic: </label><br>
    		<input type='text' name='title' id='title' value=""></input>
			<br>
    		<!-- input box to hold user's gender -->
    		<label for="description">Description: </label><br>
    		<input type='text' name='description' id='description' value = ""></input>
			<br>
			<!-- User ID and id used to determine which user's info is being edited -->
			<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
    	<input type="submit" name="submission" value="Add Group"></input>
    </form>
    </div>
    @endsection
    </body>
</html>