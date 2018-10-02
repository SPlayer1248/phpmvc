<?php 
if(isset($_SESSION['level'])==1){
if (isset($_GET['u'])) {
	$u = $_GET['u'];
	$user = new user();
	$user->set_name($u);
	$result = $user->select_user();
}

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = $_POST['level'];

	if($username && $password){
			$user = new user();
			$user->set_name($username);
			$user->set_pass($password);
			$user->set_level($level);
			if ($user->edit_user($u) == "Fail") {
				$err = "<span>The username already exists</span>";
			} else {
				header('location: index.php?c=user&a=list');
				exit();
			}
		}
}
include('views/user/edituser.php');
} else {
	header('location: index.php');
	exit();

}
?>