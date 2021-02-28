<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
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
        //declares and initializes variables needed to autofill form later
        $id = $userInfo->getID();
        $email = $userInfo->getEmail();
        $phone = $userInfo->getPhone();
        $gender = $userInfo->getGender();
        $nationality = $userInfo->getNationality();
        $description = $userInfo->getDescription();
        $skills = $userInfo->getSkills();
        $certifications = $userInfo->getCertifications();
        $userID = $userInfo->getUserID();
    ?>
    <div class="editForm">
    <!-- Form used to represent the data held in the database in an editable manner so it can be updated -->
    <form action="editedUserProfile" method="post">
    
    <!-- necessary input for laravel forms -->
    {{ csrf_field() }}
    		<!-- input box to hold user's email -->
    		<label for="email">Email: </label><br>
    		<input type='text' name='email' id='email' value="<?php echo $email;?>"></input>
			<br>
			<!-- input box to hold user's phone -->
    		<label for="phone">Phone: </label><br>
    		<input type='text' name='phone' id='phone' value="<?php echo $phone;?>"></input>
			<br>
			<!-- input box to hold user's gender -->
    		<label for="gender">Gender: </label><br>
    		<input type='text' name='gender' id='gender' value="<?php echo $gender;?>"></input>
    		<br>
    		<!-- input box to hold user's gender -->
    		<label for="nationality">Nationality: </label><br>
    		<input type='text' name='nationality' id='nationality' value = "<?php echo $nationality;?>"></input>
			<br>
			<!-- input box to hold user's description -->
    		<label for="description">Description: </label><br>
    		<input type='text' name='description' id='description' value = "<?php echo $description;?>"></input>
			<br>
			<!-- input box to hold user's skills -->
    		<label for="skills">Skills: </label><br>
    		<input type='text' name='skills' id='skills' value = "<?php echo $skills;?>"></input>
			<br>
			<!-- input box to hold user's certifications -->
    		<label for="certifications">Certifications: </label><br>
    		<input type='text' name='certifications' id='certifications' value = "<?php echo $certifications;?>"></input>
			<br>
			<!-- User ID and id used to determine which user's info is being edited -->
    	<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    	<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
    	<input type="submit" name="submission" value="Edit User Profile"></input>
    </form>
    </div>
    @endsection
    </body>
</html>