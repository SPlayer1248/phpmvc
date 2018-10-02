<?php 

if (isset($_SESSION['level'])) {
	$user = new user();
	$result = $user->list_user();
	include('views/user/listuser.php');
}
else{
	header('location: index.php');
	exit();
}
?>