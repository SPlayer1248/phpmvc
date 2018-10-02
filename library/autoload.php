<?php 

	function __autoload($file_name){
		require("models/$file_name/$file_name.php");
	}
?>