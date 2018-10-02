<?php 


class UserController
{
	
	function __construct()
	{
		if (isset($_GET['a'])) {
			switch ($_GET['a']) {
				case 'login':
					$this->login();
					break;
				case 'list':
					$this->list();
					break;
				case 'add':
					$this->add();
					break;
				case 'edit':
					$this->edit();
					break;
				case 'delete':
					$this->delete();
					break;
				case 'logout':
					$this->logout();
					break;
				default:
					# code...
					break;
			}
		}
	}

	public function login(){
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
		include('views/user/login.php');
	}

	public function list(){
		if (isset($_SESSION['level'])) {
			$user = new user();
			$result = $user->list_user();
			include('views/user/listuser.php');
		}
		else{
			header('location: index.php');
			exit();
		}
	}

	public function add() {
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
	}

	public function edit() {
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
	}

	public function delete() {
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
	}

	public function logout() {
		if(isset($_SESSION['name'])){
			session_destroy();
			header('location: index.php');
			exit();
		} else {
			die("Bad request");
		}
	}
}
?>