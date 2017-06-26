<?php
//This should not be in the webroot
//It's there now for easier development
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "codeplus";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed");
}
?>
