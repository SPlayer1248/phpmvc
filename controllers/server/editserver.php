<?php 
if(isset($_SESSION['level'])==1){
if (isset($_GET['s'])) {
	$s = $_GET['s'];
	$server = new server();
	$server->set_ip($s);
	$result = $server->select_server();
}

if(isset($_POST['submit'])){
	$ip = $_POST['ip'];
	if (!isset($_POST['owner']) && empty($_POST['owner']) && $_SESSION['level'] != 1) {
				$owner = $_SESSION['name'];
			} else {
				$owner = $_POST['owner'];
			}

	if($ip && $owner){
			$server = new server();
			$server->set_ip($ip);
			$server->set_owner($owner);
			if ($server->edit_server($s) == "Fail") {
				$err = "<span>The server ip already exists</span>";
			} else {
				header('location: index.php?c=server&a=list');
				exit();
			}
		}
}
include('views/server/editserver.php');
} else {
	header('location: index.php');
	exit();

}
?>