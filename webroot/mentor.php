<?php
	session_start();
	require 'config.php';

	if(!isset($_SESSION['admin'])) {
		header("Location: index.php");
		exit();
	}

	function send_email($to, $from, $reply, $subject, $body) {
		$headers ="From: ${to}"."\n";
		$headers .="Reply-To: ${reply}"."\n";
		$headers .="Content-Type: text/plain; charset=\"iso-8859-1\""."\n";
		$headers .="Content-Transfer-Encoding: 8bit";
		mail($to, $subject, $body, $headers);
	}

	function validate_csrf() {
		if($_SESSION["csrf_token"] !== $_POST["csrf_token"]) {
			header("Location: csrf_fail.php");
			exit();
		}
		return;
	}


	if(isset($_POST['confirm'])) {
		validate_csrf();
		if(is_numeric($_POST["user_id"]) && is_numeric($_POST["request_id"])) {
			$stmt = $conn->prepare("SELECT message, teacher_name, number_students, school, requested_date FROM codep_requests");
			$stmt->execute();
			$stmt->bind_result($message, $teacher_name, $number_students, $school, $requested_date);
			$stmt->fetch();
		} else {
			//deal with invalid request here
		}

	} else if (isset($_POST['cancel'])) {
		validate_csrf();
		if(is_numeric($_POST["user_id"]) && is_numeric($_POST["request_id"])) {

		} else {
			//deal with invalid request here
		}
	}
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
						<li role="presentation" ><a href="requests.php">Requests</a></li>
						<li role="presentation" class="active"><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			<div class="header clearfix">
				<h3 class="text-muted">CodePlus</h3>
			</div>

			<div class="jumbotron">
				<div class="panel-group">
					<div class="panel panel-default">
<?php
	$stmt = $conn->prepare("SELECT request_id, email, requested_date, created, teacher_name, school, address, number_students, message FROM codep_requests WHERE status = 0 & user_id = ?");
	$stmt->bind_param($_SESSION["user_id"]);
	$stmt->execute();
	$stmt->bind_result($request_id, $email, $requested_date, $created, $teacher_name, $school, $address, $number_students, $message);
	while($stmt->fetch()) {
		$clean_created = strtotime($created);
		$clean_created = date("d/m/Y", $clean_created);
		$clean_requested = strtotime($requested_date);
		$clean_requested = date("d/m/Y", $clean_requested);
		?>

		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse<?php echo $request_id?>"><b><?php echo htmlspecialchars($school)?></b> - Created: <?php echo htmlspecialchars($clean_created)?></a>
			</h4>
		</div>

		<div id="collapse<?php echo $request_id?>" class="panel-collapse collapse">
			<div class="panel-body"><u>Booking for: <?php echo htmlspecialchars($clean_requested)?></u><br><?php echo htmlspecialchars($teacher_name)?><br><?php echo htmlspecialchars($email)?><br><i><?php echo htmlspecialchars($message)?></i></div>
			<div class="panel-footer">
				<form onsubmit="return confirm('Do you really want to cancel the request?');" action="admin.php" method="post">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
					<input type="hidden" name="request_id" value="<?php echo $request_id ?>">
					<input type="text" name="message">
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"] ?>">
					<input type="hidden" name="cancel" value="1">
					<button type="submit" class="btn-sm btn-danger">Decline</button>
				</form>
				<form action="admin.php" method="post">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
					<input type="hidden" name="request_id" value="<?php echo $request_id ?>">
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"] ?>">
					<input type="hidden" name="confirm" value="1">
					<button type="submit" class="btn-sm btn-success">Approve</button>
				</form>
			</div>
		</div>

	<?php } ?>
	</div>
	<?php
	$stmt->close();
	?>
		</div>
	</body>
</html>
