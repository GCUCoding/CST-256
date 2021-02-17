<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Edit User Details</title>
</head>
    <body>
    @extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
    <?php 
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
    <h3>Customise your Profile:</h3>
    <form action="editedUserInfo" method="post">
    {{ csrf_field() }}

    		<label for="email">Email: </label><br>
    		<input type='text' name='email' id='email' value="<?php echo $email;?>"></input>
			<br>
    		<label for="phone">Phone: </label><br>
    		<input type='text' name='phone' id='phone' value="<?php echo $phone;?>"></input>
			<br>
    		<label for="gender">Gender: </label><br>
    		<input type='text' name='gender' id='gender' value="<?php echo $gender;?>"></input>
    		<br>
    		<label for="nationality">Nationality: </label><br>
    		<input type='text' name='nationality' id='nationality' value = "<?php echo $nationality;?>"></input>
			<br>
    		<label for="description">Description: </label><br>
    		<input type='text' name='description' id='description' value = "<?php echo $description;?>"></input>
    		<br>
    		<label for="skills">Skills: </label><br>
    		<input type='text' name='skills' id='skills' value = "<?php echo $skills;?>"></input>
    		<br>
    		<label for="certifications">Certifications: </label><br>
    		<input type='text' name='certifications' id='certifications' value = "<?php echo $certifications;?>"></input>
    	<br>
    	<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    	<input type="hidden" name="userID" value="<?php echo $userID;?>"></input>
    	<input type="submit" name="submission" value="Edit User"></input>
    </form>
    </div>
    @endsection
    </body>
</html>