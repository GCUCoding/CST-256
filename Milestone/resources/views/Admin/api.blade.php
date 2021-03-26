<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>API's</title>
</head>
    <body>
	   <!-- use layouts -->
    	@extends('layouts.appmaster')
		@section('title', 'Login Page')
		@section('content')
		
		<h2>This is the API page that will output JSON based on your selection</h2>
		
		<div class="editForm">
    		<table class="alignedFormTable">
    			<tr>
        			<form action="usersrest" method="get">
    				<th><label>All Users:</label></th>
    				<td>
    					<input type="submit" name="submitted" value="Go"></input>
    				</td>
    				</form>
    			</tr>
    			<tr>
        			<form action="jobsrest" method="get">
    				<th><label>All Jobs:</label></th>
    				<td>
    					<input type="submit" name="submitted" value="Go"></input>
    				</td>
    				</form>
    			</tr>
    			<tr>
    				<form id="searchUser" method="get">
    				<th><label>One User:</label></th>
    				<td>
    					<input type="text" name="profileID" id="profileID" placeholder="Profile ID #"></input>
    				</td>
    				<td>
    					<input type="submit" name="submitted" value="Go" onclick="onUserSubmit()"></input>
    				</td>
    				</form>
    			</tr>
    			<tr>
    				<form id="searchJob" method="get">
    				<th><label>One Job:</label></th>
    				<td>
    					<input type="text" name="jobID" id="jobID" placeholder="Job ID #"></input>
    				</td>
    				<td>
    					<input type="submit" name="submitted" value="Go" onclick="onJobSubmit()"></input>
    				</td>
    				</form>
    			</tr>
    		</table>
        </div>
		@endsection
    </body>
    <script type="text/javascript">
    function onUserSubmit()
    	{
    		$('#searchUser').prop('action', "usersrest/"+$('#profileID').val());
    		return true;
    	}
    	function onJobSubmit()
    	{
    		$('#searchJob').prop('action', "jobsrest/"+$('#jobID').val());
    		return true;
    	}
    </script>
</html>