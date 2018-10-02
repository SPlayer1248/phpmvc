<?php 

if (isset($_GET['a'])) {
	switch ($_GET['a']) {
		case 'login':
			include('controllers/user/login.php');
			break;
		case 'list':
			include('controllers/user/listuser.php');
			break;
		case 'add':
			include('controllers/user/adduser.php');
			break;
		case 'edit':
			include('controllers/user/edituser.php');
			break;
		case 'delete':
			include('controllers/user/deleteuser.php');
			break;
		case 'logout':
			include('controllers/user/logout.php');
			break;
		default:
			# code...
			break;
	}
}
?>