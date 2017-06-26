<html>
	
	<head>
		<style>
		.button {
		  color:black;
		  display: block;
		  margin: 15px;
		  padding: 3px 17px;
		  font: 150 75% langdon;
		  background-color:#FFFFFF ;
		  border: no;
		  cursor: pointer;
			border-radius:10px;
		} 
		.opengreenbutton {
		  color:black;
		  display: block;
		  margin: 15px;
		  padding: 3px 17px;
		  font: 150 75% langdon;
		  background-color:#228B22 ;
		  border: no;
		  cursor: pointer;
			border-radius:10px;
		} 
		.busyorangebutton {
		  color:black;
		  display: block;
		  margin: 15px;
		  padding: 3px 17px;
		  font: 150 75% langdon;
		  background-color:#FF8C00 ;
		  border: no;
		  cursor: pointer;
			border-radius:10px;
		} 
		.closedredbutton {
		  color:black;
		  display: block;
		  margin: 15px;
		  padding: 3px 17px;
		  font: 150 75% langdon;
		  background-color:#ff0000 ;
		  border: no;
		  cursor: pointer;
			border-radius:10px;
		} 
		</style>
		<script>
				
		function goLastMonth (month, year, userID){
			if(month ==1){
				--year;
				month=13;
			}
			--month;
			var monthstring=""+month+"";
			var monthlength=monthstring.length;
			if(monthlength<=1){
				monthstring="0"+monthstring;
			}
			document.location.href = "<?php $_SERVER['PHP_SELF'];?>?id="+userID+"&month="+monthstring+"&year="+year;
		}
		function colourChange(user_id, datePassed) {
			 
				//wonky way to get the passed day, was getting weird errors when passing three variables in
				var parts =datePassed.split('-');
				var p=parts[2];
				var dS=datePassed.split(' ');
				var time=dS[1];
				var clock=time.split(':');
				var x=p.split(' ');
				var hour=clock[0];
				var day=x[0];
				var id=day*2;
				if(hour==9){
					id=id-1;
				}
				//document.write(hour);
			var y = document.getElementById(id).className;
			var thisClass;
			if(y=='button'){
				document.getElementById(id).className = "opengreenbutton";
				thisClass="g";
			}
			if(y=='opengreenbutton'){
				document.getElementById(id).className = "busyorangebutton";
				thisClass="o";
			}
			if(y=='busyorangebutton'){
				document.getElementById(id).className = "closedredbutton";
				thisClass="r";
			}
			if(y=='closedredbutton'){
				document.getElementById(id).className = "button";
				thisClass="s";
			}
		//sending data to be lodged in database
		$.post("sendBData.php", {
		date1: datePassed,
		class1: thisClass,
		user1: user_id,
		}, function(data) {
			
		});
		}
		function goNextMonth(month, year, userID){
			if(month ==12){
				++year
				month=0;
			}
			++month
			var monthstring=""+month+"";
			var monthlength=monthstring.length;
			if(monthlength<=1){
				monthstring="0"+monthstring;
			}
				document.location.href = "<?php $_SERVER['PHP_SELF'];?>?id="+userID+"&month="+monthstring+"&year="+year;
		}
		</script>
	</head>
	<body>
		
	<?php
		function drawTable($passedMonth, $passedYear, $usersId){
			$con=mysqli_connect ("localhost", "root", "root") or die ('I cannot connect to the database because: ' . mysql_error());
			mysqli_select_db ($con,'codeplus');
			
			//A bit of a workaround for the time being , checks the url as well as the $_Session to see what version of the calendar to display
			//If a logged in mentor was to click on the calendar link on the homescreen, then by check the session alone then the edit calendar would be show, 
			//something that I dont believe is wanted
			$varr=$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$varr = str_replace('/', '', $directory_self);
			$day =date(1);
			$month =date($passedMonth);
			$year =date($passedYear);
			
			$currentTimeStamp= strtotime("$year-$month-$day");
			$monthName= date ("F", $currentTimeStamp);
			$numDays=date ("t", $currentTimeStamp);
			//id for for loop
			$counter=0;
			//id for button
			$thisId=1;
			echo"
				<table border='4'>
					<tr>
						<td align ='center'>
							<input style ='width:80px;' type='button' value='<' name ='nextButton'     onclick='goLastMonth(".$month.", ".$year.", ".$usersId.")'></td>
						</td>
						<td align ='center' colspan='5'>
							< $monthName  $year >
						</td>
						<td align ='center'>
							<input style ='width:80px;' type='button' value='>' name ='nextButton'     onclick='goNextMonth(".$month.", ".$year.", ".$usersId.")'></td>	
					</tr>
					<tr>
						<td style='width: 80px; text-align:center;' >Sun</td>
						<td style='width: 80px;  text-align:center;'>Mon</td>
						<td style='width: 80px;  text-align:center;'>Tue</td>
						<td style='width: 80px;  text-align:center;'>Wed</td>
						<td style='width: 80px;  text-align:center;'>Thu</td>
						<td style='width: 80px;  text-align:center;'>Fri</td>
						<td style='width: 80px;  text-align:center;'>Sat</td>
					</tr>
			<tr>";
			
			//creating calendar
			for($i=1;$i<=$numDays;$i++, $counter++){
				$timeStamp=strtotime("$year-$month-$i");
				if($i==1){
					$firstDay=date("w", $timeStamp);
					for($j=0;$j<$firstDay;$j++,$counter++){
						echo"<td />";
					}
				}
				if($counter%7==0) {
					echo "</tr><tr>";
				}
				$monthstring=$month;
				$monthlength=strlen($monthstring);
				$daystring=$i;
				$daylength=strlen($daystring);
				if($monthlength<=1){
					$monthstring="0".$monthstring;
				}
				if($daylength<=1){
					$daystring="0".$daystring;
				}
			
				$morningHour=9;
				$morningMinute=0;
				$morningSecond=0;
				$eveningHour=13;
				$eveningMinute=0;
				$eveningSecond=0;
		
				$dateMorningString = $year."-".$month."-".$i." ".$morningHour.":".$morningMinute.":".$morningSecond;
				$dateMorning = strtotime($dateMorningString);
				$resultMorning=date('Y-m-d H:i:s', $dateMorning);
				$dateEveningString = $year."-".$month."-".$i." ".$eveningHour.":".$eveningMinute.":".$eveningSecond;
				$dateEvening = strtotime($dateEveningString);
				$resultEvening=date('Y-m-d H:i:s', $dateEvening);
				$dateToCompare=$resultMorning;
				echo "<td  valign='middle'>".$i."";
				//calendar for mentor edit
				if(isset($_SESSION['email'])&&$varr!='webroot') {
						
					echo " <button type='button' ";
					$sqlCount="select * from codep_calendar where day='".$dateToCompare."' and user_id='".$usersId."' ";
					$noOfEvent=mysqli_num_rows(mysqli_query($con, $sqlCount));
					if($noOfEvent>=1){
						$result = mysqli_query($con, $sqlCount);
						$row = mysqli_fetch_assoc($result);
						$scale=$row["busy_scale"];
						if($scale==0){
							echo" class='opengreenbutton'";
						}
						else if($scale==1){
							echo" class='busyorangebutton'";
						}
						else if ($scale==2){
							echo" class='closedredbutton'";
						}
							
					}
					else{
						echo " class='button' ";
					}	
					echo " onclick='colourChange(".$usersId.",\"".$resultMorning."\")'  id=$thisId>9.00-12.00</button>";
					$thisId=$thisId+1;
					$dateToCompare=$resultEvening;
					
					echo "<button type='button' ";
			
					$sqlCount="select * from codep_calendar where day='".$dateToCompare."' and user_id='".$usersId."'";
					$noOfEvent=mysqli_num_rows(mysqli_query($con, $sqlCount));
				
					if($noOfEvent>=1){
							$result = mysqli_query($con, $sqlCount);
							$row = mysqli_fetch_assoc($result);
							$scale=$row["busy_scale"];
							if($scale==0){
								echo" class='opengreenbutton'";
							}
							else if($scale==1){
								echo" class='busyorangebutton'";
							}
							else if ($scale==2){
								echo" class='closedredbutton'";
							}
							
					}
					else{
						echo " class='button' ";
					}									
					echo " onclick='colourChange(".$usersId.",\"".$resultEvening."\")'  id=$thisId>13.00-16.00</button>";								
					$thisId=$thisId+1;
				}
				//calendar for schools to see
				else{
					echo "  <form id='Upload' action='sendRequest.php'  method='get'>
					<input type='hidden' value='".$dateToCompare."' name='dateMorning'>
					<input type='hidden' value='".$usersId."' name='idMorning'>
					<input id='morning'  type='submit'  value='".$dateToCompare."' name='morning'";
				
					$sqlCount="select * from codep_calendar where day='".$dateToCompare."' and user_id='".$usersId."' ";
					$noOfEvent=mysqli_num_rows(mysqli_query($con, $sqlCount));
				
					if($noOfEvent>=1){
			
						$result = mysqli_query($con, $sqlCount);
						$row = mysqli_fetch_assoc($result);
						$scale=$row["busy_scale"];
						if($scale==0){
							echo" class='opengreenbutton'";
						}
						else if($scale==1){
							echo" class='busyorangebutton'";
						}
						else if ($scale==2){
							echo" class='closedredbutton'";
						}
						
					}
					else{
						echo " class='button' disabled";
					}	
					echo "></form>";
					$thisId=$thisId+1;
					$thisId=$thisId+1;
					$dateToCompare=$resultEvening;
					echo " <form id='Upload' action='sendRequest.php'  method='get'>
						<input type='hidden' value='".$dateToCompare."' name='dateEvening'>
						<input type='hidden' value='".$usersId."' name='idEvening'>
						<input id='evening'  type='submit' value='".$dateToCompare."' name='evening'";
			
					$sqlCount="select * from codep_calendar where day='".$dateToCompare."' and user_id='".$usersId."' ";
					$noOfEvent=mysqli_num_rows(mysqli_query($con, $sqlCount));
				
					if($noOfEvent>=1){
			
						$result = mysqli_query($con, $sqlCount);
						$row = mysqli_fetch_assoc($result);
						$scale=$row["busy_scale"];
						if($scale==0){
							echo" class='opengreenbutton'";
						}
						else if($scale==1){
							echo" class='busyorangebutton'";
						}
						else if ($scale==2){
							echo" class='closedredbutton'";
						}
						
					}
					else{
						echo " class='button' disabled";
					}									
					echo "></form>";								
					$thisId=$thisId+1;
						
				}
			}
				
			echo "</tr>
			</table>";
		}
	?>
	</body>
</html>