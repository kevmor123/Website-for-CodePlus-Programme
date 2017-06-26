<?php
require 'config.php';


	// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
			
				
				
				$date = new DateTime();
$result = $date->format('Y-m-d H:i:s');
				$teacherName2=$_POST['teacherName1']; // Fetching Values from URL
				$schoolName2=$_POST['schoolName1'];
				$schoolEmail2=$_POST['schoolEmail1'];
				$schoolAddress2=$_POST['schoolAddress1'];
				$numberStudents2=$_POST['numberStudents1'];
				$requestDate=$_POST['date1'];
				$user_id=$_POST['requestid1'];
				$message=$_POST['message1'];
				
				$validEmail;
				//check if email is okay
				if (!filter_var($schoolEmail2, FILTER_VALIDATE_EMAIL) === false) {
					$validEmail=1;
					}
					else{
						$validEmail=0;
					}
				//check if number students is a real number
				if((is_numeric($numberStudents2))&&$validEmail==1)
				{
						//lodge request in database
						$stmt = $conn->prepare("INSERT INTO codep_requests ( user_id,teacher_name, school, email, address, number_students, requested_date, message, created) VALUES (?,?,?,?,?,?,?,?,?)");
				$stmt->bind_param("issssisss", $user_id, $teacherName2,$schoolName2,$schoolEmail2,$schoolAddress2,$numberStudents2,$requestDate,$message, $result);
						
					
					if( $stmt->execute()){
						$stmt->close();
					}
					 else {
							echo 'error updating fields';			
						}
					//dont know how mail will work on your system
					$to      = 'noreply@codeplus.com';
					$subject = 'Request from school "'.$schoolEmail2.'" ';
					$headers = 'From: "'.$schoolEmail2.'" ' . "\r\n" .
						'Reply-To: "'.$schoolEmail2.'"' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
				}
				else{
						if($validEmail==0){
							echo"Error, email is not vaild";
						}
						else{
							echo"Error, number of students is not a valid number";
						}
				}
				

?>