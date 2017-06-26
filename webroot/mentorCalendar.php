

		

<?php
		include '/requestForm.php';
		include '/sendRequest.php';
		 include ($_SERVER['DOCUMENT_ROOT'].'/calendar.php');
		
		$thisId=$_GET["id"];
		if(!$_GET['month']){
					$month =date("n");
					$year =date("Y");
				echo drawTable($month, $year, $thisId);			
			}	
			else if(isset($_GET['month'])){
		
				$thisMonth= $_GET["month"];
				$thisYear= $_GET["year"];
				
				drawTable($thisMonth,$thisYear,$thisId);			
			}
?>