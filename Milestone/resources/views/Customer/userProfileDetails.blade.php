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
	$username =;
    $email =;
    $phone =;
    $gender =;
    $nationality =;
    $description =;
    $skills =;
    $certifications =;
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