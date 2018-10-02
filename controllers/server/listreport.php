<?php 

if (isset($_SESSION['level'])) {
	if(isset($_GET['ip'])){
		$ip = $_GET['ip'];
		$report = new report();
		if($_SESSION['level'] == 0){
			$report->set_owner($_SESSION['name']);	
		} 
		$report->set_ip($ip);
		$result = $report->list_report();
		include('views/report/list_report.php');
	}
	
	
}
else{
	header('location: index.php');
	exit();
}
?>