<?php 

if (isset($_SESSION['level'])) {
	$server = new server();
	if($_SESSION['level'] == 0){
		$server->set_owner($_SESSION['name']);	
	} 
	$result = $server->list_server();
	include('views/server/listserver.php');
	
}
else{
	header('location: index.php');
	exit();
}
?>