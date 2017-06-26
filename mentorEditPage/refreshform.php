<?php
				require 'config.php';
				$stmt = $con->prepare("UPDATE codep_mentors SET name=?, email=?, job_title=?, school=?, description=?, home_address=?  WHERE user_id=?");
				$name2=$_POST['name1']; 
				$email2=$_POST['email1'];
				$job2=$_POST['job1'];
				$school2=$_POST['school1'];
				$description2=$_POST['description1'];
				$homeAddress2=$_POST['homeAddress1'];
				$user_id=$_POST['user_id1'];
				$stmt->bind_param('ssssssi', $name2,$email2,$job2,$school2,$description2,$homeAddress2, $user_id);
				if( $stmt->execute()){
					$stmt->close();
				}
				else {
					echo 'error updating fields';
				}
?>