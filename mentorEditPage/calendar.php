

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
				
				function goLastMonth (month, year){
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
					document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
				}


				function colourChange(i, datePassed) {
					 var property = document.getElementById(i);

					var y = document.getElementById(i).className;
					var thisClass;
					if(y=='button'){
						document.getElementById(i).className = "opengreenbutton";
						thisClass="g";
					}
					if(y=='opengreenbutton'){
						document.getElementById(i).className = "busyorangebutton";
						thisClass="o";
					}
					if(y=='busyorangebutton'){
						document.getElementById(i).className = "closedredbutton";
						thisClass="r";
					}
					if(y=='closedredbutton'){
						document.getElementById(i).className = "button";
						thisClass="s";
					}
				$.post("sendData.php", {
				date1: datePassed,
				class1: thisClass,
				}, function(data) {
				});
				}

				function goNextMonth(month, year){
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
					document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
				}
						</script>
					</head>
					<body>

						<?php
			function drawTable($passedMonth, $passedYear){
				$con=mysqli_connect ("localhost", "root", "root") or die ('I cannot connect to the database because: ' . mysql_error());
	mysqli_select_db ($con,'codeplus');
				$day =date(1);
				$month =date($passedMonth);
				$year =date($passedYear);
			$currentTimeStamp= strtotime("$year-$month-$day");
			$monthName= date ("F", $currentTimeStamp);
			$numDays=date ("t", $currentTimeStamp);
			$counter=0;
			echo"
			<table border='4'>
				<tr>
					<td align ='center'>
<input style ='width:80px;' type='button' value='<' name ='previousButton' onclick='goLastMonth(".$month.",\"".$year."\")'>
</td>
					<td align ='center' colspan='5'>
< $monthName  $year >
</td>
					<td align ='center'>
<input style ='width:80px;' type='button' value='>' name ='nextButton'     onclick='goNextMonth(".$month.",\"".$year."\")'></td>
					
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
				
						$thisId=1;
						for($i=1;$i<=$numDays;$i++, $counter++){
							$timeStamp=strtotime("$year-$month-$i");
							if($i==1){
								$firstDay=date("w", $timeStamp);
								for($j=0;$j<$firstDay;$j++,$counter++){
									
									echo"<td />";
								
								}
							
							}
							if($counter%7==0) {
								echo "</tr>
<tr>";
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
									echo "<button type='button' ";
								
									$sqlCount="select * from calendar where date='".$i."'";
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
									
										
									echo " onclick='colourChange(".$thisId.",\"".$resultMorning."\")'  id=$thisId>9.00-12.00</button>";
									$thisId=$thisId+1;
									$thisId=$thisId+1;
									$dateToCompare=$resultEvening;
									
									echo "<button type='button' ";
							
									$sqlCount="select * from calendar where date='".$dateToCompare."'";
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
									echo " onclick='colourChange(".$thisId.",\"".$resultEvening."\")'  id=$thisId>13.00-16.00</button>";								
									$thisId=$thisId+1;
						}
					
					echo "</tr>
</table>";
				
			}
				?>
					</body>
				</html>