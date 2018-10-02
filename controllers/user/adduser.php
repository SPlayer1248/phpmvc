<?php 
	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$level = $_POST['level'];

		if($username && $password){
			$user = new user();
			$user->set_name($username);
			$user->set_pass($password);
			$user->set_level($level);
			if ($user->add_user() == "Fail") {
				$err = "<span>The username already exists</span>";
			} else {
				header('location: index.php?c=user&a=list');
				exit();
			}
		}
	}

	include('views/user/adduser.php');
?>