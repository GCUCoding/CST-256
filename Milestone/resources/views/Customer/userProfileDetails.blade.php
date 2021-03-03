<?php
use App\User;
use App\Models\UserModel;
use App\Models\ProfileModel;
use App\Models\JobHistoryModel;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>User Profile Details</title>
</head>
<body>
    @extends('layouts.appmaster')
	@section('title', 'User Profile Details')
	@section('content')
	<?php
	//user Variables
	$userID = $user->getID();
	$username = $user->getUsername();
	//profile Model
	$userInfoEmail = $userInfo->getEmail();
	$userInfoPhone = $userInfo->getPhone();
	$userInfoGender = $userInfo->getGender();
	$userInfoNationality = $userInfo->getNationality();
	$userInfoDescription = $userInfo->getDescription();
	$userInfoSkills = $userInfo->getSkills();
	$userInfoCertifications = $userInfo->getCertifications();
	?>
	<h1>Welcome back <?php echo $username?></h1>
	<!-- Start of Container div -->
	<div class="profileContainer">
		<!-- Start of User Profile div -->
		<div class="editForm">
			<form action="editProfilePage" method="post">
            	{{ csrf_field() }}
        		<h1 style="text-decoration: underline;">My Profile Info:</h1>
        		<h2><b>Email:</b> <?php echo $userInfoEmail?></h2>
        		<h2><b>Phone Number:</b> <?php echo $userInfoPhone?></h2>
        		<h2><b>Gender:</b> <?php echo $userInfoGender?></h2>
        		<h2><b>Nationality:</b> <?php echo $userInfoNationality?></h2>
        		<h2><b>About Me:</b> <?php echo $userInfoDescription?></h2>
        		<h2><b>Skills:</b> <?php echo $userInfoSkills?></h2>
        		<h2><b>Certifications:</b> <?php echo $userInfoCertifications?></h2>
            	<input type="hidden" name="id" value="<?php echo $userID;?>"></input>
            	<input type="submit" name="submission" value="Edit Profile"></input>
    		</form>
		</div><!-- End of User Profile div -->
		<!-- Start of User Profile div -->
		<div class="editForm">
			
    		<!-- table headers set up to hold users -->
        	<table class="usersTable">
            	<tr>
            		<th>Title: </th>
            		<th>Institution: </th>
            		<th>GPA: </th>
            		<th>Start Date: </th>
            		<th>End Date: </th>
            		<th>Edit</th>
            	</tr>
            <!-- foreach loop to populate users table -->
        	@foreach($educations as $education)
        	<?php 
        	//education variables
        	$educationID = $education->getID();
        	$educationTitle = $education->getTitle();
        	$educationInstitution = $education->getInstitution();
        	$educationGPA = $education->getGPA();
        	$educationStartDate = $education->getStartDate();
        	$educationEndDate = $education->getEndDate();
        	?>
            	<tr>
            	<!-- display education data and include buttons for editing -->
            		<td><?php echo $educationTitle;?></td>
            		<td><?php echo $educationInstitution;?></td>
            		<td><?php echo $educationGPA;?></td>
            		<td><?php echo $educationStartDate;?>
            		<td><?php echo $educationEndDate?></td>
        			<td><form action="education" method="post">
        			{{ csrf_field() }}
        				<input type="hidden" name="id" value="<?php echo $educationID;?>"></input>
        				<input type="submit" name="submission" value="Edit"></input>
        			</form>	
        			</td>
            	</tr>
        	@endforeach
    		</table>
         	<form action="addEducation" method="post"> 
     		{{ csrf_field() }} 
    		<input type="submit" name="submission" value="Add Education"></input>
     		</form> 
		</div><!-- End of User Profile div -->
	    <!-- Start of Job history div -->
    	<div class="editForm">
    		<!-- table headers set up to hold users -->
        	<table class="usersTable">
            	<tr>
            		<th>Title: </th>
            		<th>Company: </th>
            		<th>Start Date: </th>
            		<th>End Date: </th>
            		<th>Description: </th>
            		<th>View Job History</th>
            		<th>Edit</th>
            	</tr>
            <!-- foreach loop to populate jobHistory table -->
        	@foreach($jobHistories as $jobHistory)
        	<?php 
        	//jobHistory variables
        	$jobHistoryID = $jobHistory->getID();
        	$jobHistoryTitle = $jobHistory->getTitle();
        	$jobHistoryCompany = $jobHistory->getCompany();
        	$jobHistoryStartDate = $jobHistory->getStartDate();
        	$jobHistoryEndDate = $jobHistory->getEndDate();
        	$jobHistoryDescription = $jobHistory->getDescription();
        	?>
            	<tr>
            	<!-- display user data and include buttons for editing -->
            		<td><?php echo $jobHistoryTitle;?></td>
            		<td><?php echo $jobHistoryCompany;?></td>
            		<td><?php echo $jobHistoryStartDate;?></td>
            		<td><?php echo $jobHistoryEndDate;?>
            		<td><?php echo substr($jobHistoryDescription, 0, 47) . "...";?></td>
        			<td><form action="viewJobHistory" method="post">
        			{{ csrf_field() }}
        				<input type="hidden" name="id" value="<?php echo $jobHistoryID;?>"></input>
        				<input type="submit" name="submission" value="View Job"></input>
        				</form>
        			</td>
        			<td><form action="editJobHistoryPage" method="post">
        			{{ csrf_field() }}
        				<input type="hidden" name="id" value="<?php echo $jobHistoryID;?>"></input>
        				<input type="submit" name="submission" value="Edit"></input>
        			</form>	
        			</td>
            	</tr>
        	@endforeach
    		</table>
			<form action="addJobHistory" method="post">
    			{{ csrf_field() }}
    			<input type="submit" name="submission" value="Add Job History"></input>
    		</form>
    	</div><!-- End of Job history div -->
	</div><!-- End of Container div -->
	@endsection
</body>
</html>