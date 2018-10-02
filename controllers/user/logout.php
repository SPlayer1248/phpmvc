<?php 

if(isset($_SESSION['name'])){
	session_destroy();
	header('location: index.php');
	exit();
} else {
	die("Bad request");
}
?>