<?php 

if (isset($_SESSION['level'])) {
	$report = new report();
	if($_SESSION['level'] == 0){
		$report->set_owner($_SESSION['name']);	
	} 
	
	$result = $report->list_all_report();
	include('views/report/list_report.php');
	
}
else{
	header('location: index.php');
	exit();
}
?>