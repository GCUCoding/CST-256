<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Job Details</title>
</head>
<body>
    @extends('layouts.appmaster')
	@section('title', 'Job Details')
	@section('content')
	<?php
	$id = $jobListing->getId();
    $title = $jobListing->getTitle();
    $company = $jobListing->getCompany();
    $position = $jobListing->getPosition();
    $startDate = $jobListing->getStartDate();
    $description = $jobListing->getDescription();
	?>
	
	<div class="editForm">
	<form action="editJobPage" method="post">
		<h1 style="text-decoration: underline;">Job Listing <?php echo $id?>:</h1>
		<h2><b>Title: </b><?php echo $title?></h2>
		<h2><b>Company: </b><?php echo $company?></h2>
		<h2><b>Position: </b><?php echo $position?></h2>
		<h2><b>Start Date: </b><?php echo $startDate?></h2>
		<h2><b>Description: </b><?php echo $description?></h2>
		@if(session('role') == 1 || session('role') == 2)
    		{{ csrf_field() }}
    		<input type="hidden" name="id" value="<?php echo $id;?>"></input>
    		<input type="submit" name="submission" value="Edit"></input>
    	@endif
	</form>
	</div>
	
	@endsection
</body>
</html>