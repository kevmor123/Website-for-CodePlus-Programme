
<?php
	session_start();
	require 'config.php';
	$eventdate= $_POST["date1"];
	$buttontype= $_POST["class1"];
	$usersId=$_POST["user1"];
	//if the button type is green then we need to keep exactly what we did before.
	///If the button type is orange than we need to locate the date and change busy scale to 1
	//if the button type is red than we need to change it to 2
	//else we need to delete all entries with that date.
	
	//Set appointment
	if($buttontype=='g'){
		$busyscale=0;
		$sql="insert into codep_calendar( user_id, day, busy_scale) values ('".$usersId."','".$eventdate."','".$busyscale."')";
		$resultinsert=mysqli_query($con,$sql);
		if ($resultinsert==false){
			echo"error updating appointment status";
		}
	}
	//Make semi busy
	if($buttontype=='o'){
		$sql = "UPDATE codep_calendar SET busy_scale='1' WHERE day='".$eventdate."' and user_id='".$usersId."'";
		$resultinsert=mysqli_query($con,$sql);
		if ($resultinsert==false){
			echo"error updating appointment status";
		}
	}
	//Make busy
	if($buttontype=='r'){
		$sql = "UPDATE codep_calendar SET busy_scale='2' WHERE day='".$eventdate."' and  user_id='".$usersId."'";
		$resultinsert=mysqli_query($con,$sql);
		if ($resultinsert==false){
			echo"error updating appointment status";
		}
	}
	//Delete
	if($buttontype=='s'){
		$sql = "DELETE FROM codep_calendar WHERE day='".$eventdate."' and user_id='".$usersId."'";
		$resultinsert=mysqli_query($con,$sql);
		if ($resultinsert==false){
			echo"error updating appointment status";
		}
	}
?>