
<?php
	session_start();
	require'config.php';
	// defining max input length 
	define("MAX_STRING_LENGTH", 80);
	define("MIN_STRING_LENGTH", 1);
	// check input is between min and max length
	function check_input($string) {
		$length = strlen($string);
		if($length < MAX_STRING_LENGTH && $length > MIN_STRING_LENGTH) {
			return true;
		} else {
			return false;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
			<title>CodePlus</title>
			<!-- linking style sheet and correct font -->
			<link rel ="stylesheet" type ="text/css" href="login_style/style.css"/>
			<link href="https://fonts.googleapis.com/css?family=Nixie+One" rel="stylesheet"/>

		<head/>

		<body>

			<h1>Create Account</h1>
			
			<form action="register.php" method="POST">
				<!-- information for the user to be filled out and then stored in database when account is created -->
				<div class="container">
					<input type="email" placeholder="Enter Email" name="email" required >
					<input type="text" placeholder="Enter Full Name" name="name" required >
					<input type="text" placeholder="Enter Job Title" name="job_title" required >
					<input type="text" placeholder="Enter School" name="school" required >
					<input type="text" placeholder="Enter Postcode (e.g. D4)" name="postcode" required >
					<input type="password" placeholder="Enter Password" name="password" required >
					<input type="password" placeholder="Confrim Password" name="confirm_password"required>
					<button name="create_button" type ="bt" >Create Account</button>
				</div>
			</form>

			<form>
				<input class="my_button" onclick="window.location.href='index.php'" type = "button" value = "Back"/>
			</form>



			<?php
			// make sure the user has not already made an account with these details
			if(isset($_POST['create_button'])) {
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
					&& strlen($_POST['password']) > 7
					&& strlen($_POST['password']) < 21
					&& check_input($_POST["name"])
					&& check_input($_POST["job_title"])
					&& check_input($_POST["school"])
					&& check_input($_POST["postcode"])) {
					$password = $_POST['password'];
					$cpassword = $_POST['confirm_password'];
					// only continues if the password and confirm password match.
					if($password === $cpassword) {
						$exists_check = $conn->prepare("SELECT email FROM codep_mentors WHERE email=?");
						$exists_check->bind_param("s", $_POST['email']);
						$exists_check->execute();
						//check email is not already in use, if not then input new user to database
						if($exists_check->fetch()) {
							$exists_check->close();
							echo '<script type="text/javascript">alert("Registration failed")</script>';
						}else {
							$exists_check->close();
							$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
							$stmt = $conn->prepare("INSERT INTO codep_mentors (email, password_hash, name, job_title, school, home_address) VALUES (?, ?, ?, ?, ?, ?)");
							$stmt->bind_param("ssssss", $_POST['email'], $hashed_password, $_POST["name"], $_POST["job_title"], $_POST["school"], $_POST["postcode"]);
							if($stmt->execute()) {
								//Account creation successfull
								$stmt->close();
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['email'] = $_POST['password'];
								//Send the user somewhere
							} else {
								//system error
								$stmt->close();
								echo '<p class="bg-danger msg-block">Registration failed, please contact your systems administrator</p>';
							}
						}
					} else {
						// prompts user that the password was entered incorrectly
						echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
					}
				} else {
					// prompt user as to the correct passowrd length.
					echo '<script type="text/javascript">alert("Passwords must be between 8 and 20 characters in length")</script>';
				}
			}
			?>
		</body>
</html>
