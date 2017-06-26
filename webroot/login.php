<?php
	session_start();
	require 'config.php';
?>


<!DOCTYPE html>
<html>
	<head>
		<!-- linking style sheets and font -->
		<title>CodePlus</title>
		<link rel ="stylesheet" type ="text/css" href="login_style/style.css"/>
		<link href="https://fonts.googleapis.com/css?family=Nixie+One" rel="stylesheet"/>
	<head/>
	<body>
		<h1>Code-Plus</h1>
		<div class="container">
			<!-- user input -->
			<form action="login.php" method="POST">
				<input type="text" placeholder="Enter Email" name="email"/>
				<input type="password" placeholder="Enter Password" name="password"/>
				<button type="bt" class="my_button" name="login">Login</button>
			</form>
			<form>
				<input class="my_button" onclick="window.location.href='register.php'" type = "button" value = "Create Account"/>
			</form>
		</div>

		<?php
		// check if email is within the database , checks password is between min and max length before searching database to save time.
		if(isset($_POST['login'])) {
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && strlen($_POST['password']) > 7 && strlen($_POST['password']) < 21) {
				$stmt = $conn->prepare("SELECT password_hash, user_id, admin FROM codep_mentors WHERE email = ?");
				$stmt->bind_param("s", $_POST['email']);
				$stmt->execute();
				$stmt->bind_result($hash, $user_id, $admin);
				$stmt->fetch();
				$stmt->close();
				// if the details match , check admin flag. If true then direct to admin page , if the flag is not set then
				// directed to the mentor page.
				if (password_verify($_POST['password'], $hash)) {
					$_SESSION["email"] = $_POST['email'];
					$_SESSION["user_id"] = $user_id;
					$_SESSION["csrf_token"] = bin2hex(openssl_random_pseudo_bytes(16));
					if($admin == 1) {
						$_SESSION["admin"] = 1;
						header("Location:admin.php");
					}
					header("Location:mentor.php");
				// if details do not match , prompt user to try again.
				} else {
					echo '<script type="text/javascript">alert("Login Failed! Please try again.")</script>';
				}
				$conn->close();
			//failed input validation
			} else {
				echo '<script type="text/javascript">alert("Login Failed!")</script>';
			}
		}
		?>
	</body>
</html>
