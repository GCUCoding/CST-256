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
	$id = $jobHistory->getId();
	$title = $jobHistory->getTitle();
	$company = $jobHistory->getCompany();
	$startDate = $jobHistory->getStartDate();
	$endDate = $jobHistory->getEndDate();
    $description = $jobHistory->getDescription();
	?>
	
	<div class="editForm">
	<form action="editJobHistoryPage" method="post">
		<h1 style="text-decoration: underline;">Job History Entry <?php echo $id?>:</h1>
		<h2><b>Title: </b><?php echo $title?></h2>
		<h2><b>Company: </b><?php echo $company?></h2>
		<h2><b>Start Date: </b><?php echo $startDate?></h2>
		<h2><b>End Date: </b><?php echo $endDate?></h2>
		<h2><b>Description: </b><?php echo $description?></h2>
    		{{ csrf_field() }}
    		<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    		<input type="submit" name="submission" value="Edit"></input>
	</form>
	</div>
	
	
	@endsection
</body>
</html>