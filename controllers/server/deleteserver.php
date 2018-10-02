<?php 

if(isset($_SESSION['level'])==1){
	if (isset($_GET['s'])) {
	$s = $_GET['s'];
	$server = new server();
	$server->set_ip($s);

	if ($server->select_server() == "Fail") {
		header('location: index.php?c=server&a=list');
		exit();
	} else {
		$server->del_server();
		header('location: index.php?c=server&a=list');
		exit();
	}
	
}
} else{
	header('location: index.php?c=user&a=login');
}
?>