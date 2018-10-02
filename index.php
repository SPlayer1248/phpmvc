<?php 
	
	ob_start();
	session_start();
	include('library/autoload.php');
	include('library/database.php');

?>
 
<!DOCTYPE html>
<html>
<head>
	<title>User manager</title>
</head>
<body>
	<?php 
		if (isset($_SESSION['name'])) {
			echo '<p>Welcome '.$_SESSION['name'].'</p>';
			echo '<p><a href="index.php?c=user&a=logout">Logout</a></p>';
			echo '<br>';
			echo '<a href="index.php?c=server&a=list">Server Manager</a><br>';
			echo '<a href="index.php?c=user&a=list">User Manager</a>';

			// if(isset($_SESSION['level']) === 1){
			// 	echo '<a href="index.php?c=user&a=list">User Manager</a>';
			// }
		}
		if(isset($_GET['c'])){
			switch ($_GET['c']) {
				case 'user':
					// include('controllers/user/controller.php');
					require_once('controllers/user/UserController.php');
					$userController = new UserController();
					break;
				case 'server':
					require_once('controllers/server/ServerController.php');
					$serverController = new ServerController();
					break;
				
				default:
					header('location: index.php');
					exit();
					break;
			}
		}  else {
				header('location: index.php?c=user&a=login');
				exit();
			}
	 ?>
</body>
</html>