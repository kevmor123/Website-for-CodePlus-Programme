<head>
	<Title>Mentor Edit Screen</Title>
	<?php
		session_start();
		require 'config.php';
		include ($_SERVER['DOCUMENT_ROOT'].'/calendar.php');
		include 'sendBData.php';
		include 'uploads';
		// make a note of the current working directory relative to root.
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		// make a note of the location of the upload handler
		$parameters   = $_SERVER['QUERY_STRING'];
		if($parameter==null){
			$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';
		}
		$uploadDetails = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'uploadDetails.php';
		if(isset($_GET['month'])){
			$uploadDetails = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'uploadDetails.php/?'.$parameters;
		}
		if(isset($_GET['month'])){
			$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php/?'.$parameters;			
		}
		// set a max file size for the html upload form
		$max_file_size =3000000; // size in bytes
		$domain     = $_SERVER['HTTP_HOST'];
		//now the final part to concatenate all this together to form the URL
		$uploadSuccess =  $domain. '/calendar/?' . $parameters;	
		$user=$_SESSION['email'];
		$usersId;
		//Getting the image o use on on page				
		$sqlCount="select * from codep_mentors where email='".$user."'";
		$noOfEvent=mysqli_num_rows(mysqli_query($con, $sqlCount));
		if($noOfEvent>=1){
			
			$result = mysqli_query($con, $sqlCount);
			$row = mysqli_fetch_assoc($result);
			$source=$row["image_path"];
			if($source==null){
				$source="avatar.png";
			}	
		}
		else{
			$source="avatar.png";
		}	
?>  
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.form.js"></script>
	<script type="text/javascript" src="scripts/upload.js"></script>
	<script src="scripts/refreshForm.js"></script>
	<script src="scripts/upload.js"></script>
	<script src="scripts/requestForm.js"></script>




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
<body>
	<br />
	<!--Displaying picture here-->
	<div>
		<div style="text-align:center;">
			Profile Picture
		</div>
		<img src="<?php echo $source ?>" alt="userPic" class='image' width="180" height="200">
		<form id="Upload" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" method="post">
			<p>
				<input type="hidden" class='tb5' name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
			</p>	
			<p>
				<div style="text-align:center;">
					File To Upload
				</div>
				<input id="file"  class='image' type="file" name="file">
			</p>
			<p>
				<input id="submit" class='image' type="submit" name="submit" value="Upload me!">
			</p>
		</form>
	</div>

<?php	
	$userId=$row["user_id"];
	//Drawing the Calendar				
	if(!$_GET['month']){
			$month =date("n");
			$year =date("Y");
		echo drawTable($month, $year, $userId);			
	}	
	else if(isset($_GET['month'])){

		$thisMonth= $_GET["month"];
		$thisYear= $_GET["year"];
		
		drawTable($thisMonth,$thisYear, $userId);			
	}
	//Getting new values for the form
							
	if($noOfEvent>=1){
		$result = mysqli_query($con, $sqlCount);
		$row = mysqli_fetch_assoc($result);
		$value1=$row["name"];
		$value2=$row["email"];
		$value3=$row["job_title"];
		$value4=$row["school"];
		$value5=$row["description"];
		$value6=$row["home_address"];
	}
	//form 
	echo"
	<div id='mainform'>
	<form id='details' method='post' enctype='multipart/form-data' action='refreshform.php' autocomplete='off'>
	<form id='form' name= 'form'>
	<h5>Change Name</h5>
	<input id= 'name'  class ='tb5' type= 'text' value ='".$value1."'>
	<h5>Change Email Address</h5>
	<input id= 'email' class ='tb5'   type= 'text' value ='".$value2."'>
	<h5>Change Job Title</h5>
	<input id= 'job' class ='tb5'   type= 'text' value ='".$value3."'>
	<h5>Change Schools</h5>
	<input id= 'school' class='tb5'   type= 'textarea' value ='".$value4."'>
	<h5>Change Description</h5>
	<input id= 'description'   class ='tb5'type= 'text' value ='".$value5."'>
	<h5>Change Home Address</h5>
	<input id= 'homeAddress' class ='tb5'  type= 'text' value ='".$value6."'>
	<input  id= 'userid'   type ='hidden' class ='tb5' value='".$userId."' '>
	<input id='submit1'  class ='tb5 'type='button' value='Submit'>
	</form>
	</div>";
?>

</body>
</html>