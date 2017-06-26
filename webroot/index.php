<?php
	session_start();
	require 'config.php';
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>CodePlus</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- Custom styles for this template -->
		<link href="static/jumbotron-narrow.css" rel="stylesheet">
		<style>
			.jumbotron { text-align:left; }
		</style>
	</head>
	<body>
		<div class="container">
				<nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation" class="active"><a href="login.php">Mentor Login</a></li>
					</ul>
				</nav>
			<div class="header clearfix">
				<h3 class="text-muted">CodePlus</h3>
			</div>

			<div class="jumbotron">
				<div class="panel-group">
					<div class="panel panel-default">
<?php
	$stmt = $conn->prepare("SELECT user_id, name, job_title, image_path, school, description, home_address FROM codep_mentors");
	$stmt->execute();
	$stmt->bind_result($user_id, $name, $job_title, $image_path, $school, $description, $home_address);
	while($stmt->fetch()) {
		//This is really messy and should be fixed before launch
		echo "<div class=\"panel-heading\">\n";
		echo "<h4 class=\"panel-title\">\n";
		echo "<a data-toggle=\"collapse\" href=\"#collapse${user_id}\">".htmlspecialchars($name)."</a>\n";
		echo "</h4>\n";
		echo "</div>\n";

		echo "<div id=\"collapse${user_id}\" class=\"panel-collapse collapse\">\n";
		echo "<div class=\"panel-body\">".htmlspecialchars($job_title)."<br>".htmlspecialchars($school)."<br>".htmlspecialchars($description);
		echo "</div>";
		echo "<div class=\"panel-footer\"><a href='mentorCalendar.php?id=".${user_id}."'>See Calendar</a></div>\n";
		
		
		echo "</div>\n";
	}
	echo "</div>";
	$stmt->close();
	if(isset($_SESSION['email'])){
		$user=$_SESSION['email'];
		echo "<ul class='nav nav-pills pull-right'>
						<li role='presentation' class='active'><a href='/mentorEditPage'>Mentor Edit</a></li>
					</ul>";
	}
?>



		</div>
	</body>
</html>
