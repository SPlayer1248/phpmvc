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
		}
		if(isset($_GET['c'])){
			switch ($_GET['c']) {
				case 'user':
					include('controllers/user/controller.php');
					break;
				case 'server':
					include('controllers/server/controller.php');
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