<?php 

if(isset($_SESSION['level'])==1){
	if (isset($_GET['u'])) {
	$u = $_GET['u'];
	$user = new user();
	$user->set_name($u);

	if ($user->select_user() == "Fail") {
		header('location: index.php?c=user&a=list');
		exit();
	} else {
		$user->del_user();
		header('location: index.php?c=user&a=list');
		exit();
	}
	
}
} else{
	header('location: index.php?c=user&a=login');
}
?>

