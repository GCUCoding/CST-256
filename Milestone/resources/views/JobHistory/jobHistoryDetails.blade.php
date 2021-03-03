<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Job History Details</title>
</head>
<body>
	@extends('layouts.appmaster')
	@section('title', 'Job History Details')
	@section('content')
	
	<?php
	$jobID = $jobHistory->getID();
	$jobTitle = $jobHistory->getTitle();
	$jobCompany = $jobHistory->getCompany();
	$jobStartDate = $jobHistory->getStartDate();
	$jobEndDate = $jobHistory->getEndDate();
    $jobDescription = $jobHistory->getDescription();
	?>
	
	<div class="editForm">
	<form action="editJobHistoryPage" method="post">
		<h1 style="text-decoration: underline;">Job History Entry <?php echo $jobID?>:</h1>
		<h2><b>Title: </b><?php echo $jobTitle?></h2>
		<h2><b>Company: </b><?php echo $jobCompany?></h2>
		<h2><b>Start Date: </b><?php echo $jobStartDate?></h2>
		<h2><b>End Date: </b><?php echo $jobEndDate?></h2>
		<h2><b>Description: </b><?php echo $jobDescription?></h2>
    		{{ csrf_field() }}
    		<input type="hidden" name="id" value="<?php echo $jobID;?>"></input>
    		<input type="submit" name="submission" value="Edit"></input>
	</form>
	</div>
	
	
	@endsection
</body>
</html>