<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<title>Request Form</title>
		<style>
		body {
			background-color: #FFFFFF;
		}


		.tb5{
			border:2px solid #456879;
			border-radius:10px;
			height: 22px;
			width: 230px;
		}

		.image{
			display: block;
			margin: auto;
			
			
		}
		</style>
</head>

<script  src="/Scripts/jquery.min.js"></script>
<script src="/Scripts/requestForm.js"></script>





<?php
session_start();

	require 'config.php';
	$requestDate;
	$requestid;
	//seeing what time was requested
	if(isset($_GET['dateMorning'])){
		$requestDate=$_GET['dateMorning'];
		$requestid=$_GET['idMorning'];
	}

	if(isset($_GET['dateEvening'])){
		$requestDate=$_GET['dateEvening'];
		$requestid=$_GET['idEvening'];
	}
			//form for the request, sent to requestForm.php by jquery. Javascript id in requestForm.js, location specified above
			echo"
				<div id='schoolform'>
				<form id='schooldetails' method='post' enctype='multipart/form-data' action='requestForm.php' autocomplete='off'>
				<form id='schoolform' name= 'schoolform'>
				<h5>Teacher Name</h5>
				<input id= 'teacherName'  class ='tb5' type= 'text' '>
				<h5>Message</h5>
				<textarea rows='4'cols='50' name ='message' id='message'></textarea>
				<h5>School</h5>
				<input id= 'schoolName' class ='tb5'   type= 'text' '>
				<h5>email</h5>
				<input id= 'schoolEmail' class ='tb5'   type= 'text' '>
				<h5>address</h5>
				<input id= 'schoolAddress' class='tb5'   type= 'textarea' '>
				<h5>number students</h5>
				<input id= 'numberStudents'   class ='tb5'type= 'text' '>
				<input  type='hidden' id= 'requestedDate'   class ='tb5' value='".$requestDate."' '>
				<input type ='hidden'  id= 'requestedid'   class ='tb5' value='".$requestid."' '>
				<input id='submitSchool'  class ='tb5' type='button' value='Submit1'>
				</form>
				</div>";
	

		
			

?>