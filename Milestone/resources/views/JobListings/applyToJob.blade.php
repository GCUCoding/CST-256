
<!-- This page allows a user to apply to a job listing whule autofilling their existing information -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Apply To Job</title>
</head>
<body>
@extends('layouts.appmaster')
@section('title', 'Apply To Job')
@section('content')
<?php 
        //declares and initializes variables needed to autofill form later
        $id = $userInfo->getID();
        $email = $userInfo->getEmail();
        $phone = $userInfo->getPhone();
        $gender = $userInfo->getGender();
        $nationality = $userInfo->getNationality();
        $skills = $userInfo->getSkills();
        $certifications = $userInfo->getCertifications();
        $userID = $userInfo->getUserID();
    ?>
    <div class="editForm">
    <!-- Form used to represent the data held in the database in an editable manner so it can be updated -->
    <form action="applyToJobSubmit" method="post">
        <!-- necessary input for laravel forms -->
        {{ csrf_field() }}
    		<!-- input box to hold user's firstName -->
    		<label for="firstName">First Name: </label>
    		<input type='text' name='firstName' id='firstName' placeholder="Enter your First Name..."></input>
    		<br/>
			<!-- input box to hold user's firstName -->
    		<label for="lastName">Last Name: </label>
    		<input type='text' name='lastName' id='lastName' placeholder="Enter your Last Name..."></input>
			<br>
    		<!-- input box to hold user's email -->
    		<label for="email">Email: </label>
    		<input type='text' name='email' id='email' value="<?php echo $email;?>"></input>
			<br>
			<!-- input box to hold user's phone -->
    		<label for="phone">Phone: </label>
    		<input type='text' name='phone' id='phone' value="<?php echo $phone;?>"></input>
			<br>
			<!-- input box to hold user's gender -->
    		<label for="gender">Gender: </label>
    		<input type='text' name='gender' id='gender' value="<?php echo $gender;?>"></input>
    		<br>
    		<!-- input box to hold user's gender -->
    		<label for="nationality">Nationality: </label>
    		<input type='text' name='nationality' id='nationality' value = "<?php echo $nationality;?>"></input>
			<br>
			<!-- input box to hold user's skills -->
    		<label for="skills">Skills: </label>
    		<input type='text' name='skills' id='skills' value = "<?php echo $skills;?>"></input>
			<br>
			<!-- input box to hold user's certifications -->
    		<label for="certifications">Certifications: </label>
    		<input type='text' name='certifications' id='certifications' value = "<?php echo $certifications;?>"></input>
			<br><br>
			<!-- User ID and id used to determine which user's info is being edited -->
    	<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    	<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
    	<input type="submit" name="submission" value="Apply" onclick="applySuccess()"></input>
    </form>
    </div>
    @endsection
    </body>
</html>