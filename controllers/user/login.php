<?php 
	
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		if($username && $password){
			$user = new User();
			$user->set_name($username);
			$user->set_pass($password);
			if($user->login() === 'ok'){
				if($_SESSION['level'] == 1){
					header('location: index.php?c=user&a=list');
					exit();
				} else {
					header('location: index.php?c=server&a=list');
					exit();
				}
			} else {
				$err = "Invalid username or password";
			}
		}
	}
	include('views/user/login.php')
?>