<?php
use App\Models\EducationModel;
?>
<!-- displays a user's education information on a page and holds it in a form to be updated -->
<html>
<head>
<title>Edit User Education</title>
</head>
    <body>
    <!-- shows layouts -->
    @extends('layouts.appmaster')
	@section('title', 'Login Page')
	@section('content')
    <?php 
        //declares and initializes necessary variables for later use
        $id = $education->getID();
        $startDate = $education->getStartDate();
        $endDate = $education->getEndDate();
        $institution = $education->getInstitution();
        $gpa = $education->getGPA();
        $title = $education->getTitle();
        $profileID = $education->getProfileID();
    ?>
    <div class="editForm">
    <h3>Input your Education:</h3>
    <!-- form that allows the user to input information they would like held in their education -->
    <form action="editEducation" method="post">
    {{ csrf_field() }}
    		<label for="startDate">Start Date: </label><br>
    		<input type="date" name="startDate" id='startDate' value="<?php echo $startDate;?>"></input>
			<br>
    		<label for="endDate">End Date: </label><br>
    		<input type="date" name='endDate' id='endDate' value="<?php echo $endDate;?>"></input>
			<br>
    		<label for="institution">Institution: </label><br>
    		<input type='text' name='institution' id='gender' value="<?php echo $institution;?>"></input>
    		<br>
    		<label for="gpa">GPA: </label><br>
    		<input type='text' name='gpa' id='gpa' value = "<?php echo $gpa;?>"></input>
			<br>
    		<label for="title">Title: </label><br>
    		<input type='text' name='title' id='title' value = "<?php echo $title;?>"></input>
    		<br>
    	<!-- hidden forms to specify which user's education should be updated -->
    	<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    	<input type="hidden" name="profileID" value="<?php echo $profileID;?>"></input>
    	<input type="submit" name="submission" value="Save"></input>
    </form>
    <form action="deleteEducation" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="userInfoID" value="<?php echo $profileID?>"></input>
    				<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    				<input type="submit" name="submission" style="background-color: red; color: white;" value="Delete Education"></input>
    				<h4><b style="color: red; font-weight: 700;">Warning: This is a permanent change.</b></h4>
	</form>
    </div>
    @endsection
    </body>
</html>