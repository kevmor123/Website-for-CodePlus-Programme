
<?php	
	require'config.php';
	$db_name = "codep_requests"; // databse name where requests are stored
?>

<!DOCTYPE html>
<html>
  <head>
	<!-- linking to bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- linking to google's chart api-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
	<script type="text/javascript">  
		
		
		<!-- START OF PIECHART -->
        google.charts.load('current', {'packages':['corechart']});  
        google.charts.setOnLoadCallback(drawChart);  
	function drawChart()  
	{  
			<!-- pulling info from database and putting into the piechart -->
			var data = google.visualization.arrayToDataTable([  
					['School', 'Number'],  
					<?php  
					// search through database and counts how many times a school has booked a mentor , accounts if the school name is capitalised or not
					$q = "SELECT school, count(*) as number FROM test GROUP BY school";
					$r = mysqli_query($conn, $q);
					while($row = mysqli_fetch_array($r))  
					{  
						echo "['".$row["school"]."', ".$row["number"]."],";  
					}  
					?>  
				]);  
			var options = 
			{  
				title: 'Percentage of bookings made by Schools :',    
				pieHole: 0.2 
			};  
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
			chart.draw(data, options);
	   }  
	   </script>  
	   <!-- END OF PIECHART -->
   
	<title>Database Search</title>
	<style type = "text/css">
	</style>
  </head>

  <body>
		<!-- piechart dimesnions -->
        <div style="width:900px;">  
        <div id="piechart" style="width: 900px; height: 500px;"></div>  
        </div> 

		<!-- START OF SEARCH -->
		<form method ="post" action = "search.php">
		<input type = "hidden" name = "submitted" value = "true" />
		
		<label> Search Category :
		<select name ="category">
			<!-- to add more options add "<option value = "desired option">"label"</option> " -->
			<option value = "school">School</option>
			<option value = "email">Email</option>
			<option value = "status">Status</option> 
			<option value = "teacher_Name">Teacher's Name</option>
		</select>
		</label>
		
		<label> Search Criteria : <input type ="text" name = "criteria" /></label>
		<input type = "submit"/>
		
		</form>
		
		<?php 
			if(isset($_POST['submitted'])){
				$category = $_POST['category']; // = the selected option
				$criteria = $_POST['criteria'];	// = typed input from user 
				
				// checks to see if the input matches any info from database , accounts for capitalisation 
				$queryget = mysqli_query($conn, "SELECT * FROM $db_name WHERE $category LIKE '%".$criteria."%' ") or die('error');
				$num_rows = mysqli_num_rows($queryget);
				
				echo "$num_rows results found";
				// change the "class =" to alter the bootstrap theme 
				echo "<table class = 'table table-bordered'>";
				// Headers for the table
				echo "<tr> <th>School</th> <th>Teacher's Name</th> <th>Address</th> <th>Date</th> <th>Status</th> </tr>";
				
				// because this access the database it has to be in php so the table has to be echo'd out.
				while($row = mysqli_fetch_assoc($queryget)){
					// cells of the table
					echo "<tr><td>";
					echo $row['school'];
					echo "</td><td>";
					echo $row['teacher_name'];
					echo "</td><td>";
					echo $row['address'];
					echo "</td><td>";
					echo $row['requested_date'];
					echo "</td><td>";
					echo $row['status'];
					echo "</td></tr>";
				}	
				echo "</table>";
			}
			?>
	<!-- END OF SEARCH -->
	</body>
</html>			
