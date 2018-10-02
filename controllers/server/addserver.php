<?php 

	function getIPFromFile($file){
		$fileContent = file_get_contents($file);
		
		$IPList = explode("\r\n", $fileContent);

		return $IPList;

	}

	if (isset($_POST['add'])) {
		
		if(isset($_POST['ip']) && !empty($_POST['ip'])){
			if (!isset($_POST['owner']) && !empty($_POST['owner']) && $_SESSION['level'] != 1) {
				$owner = $_SESSION['name'];
			} else {
				$owner = $_POST['owner'];
			}
			$ip = $_POST['ip'];
			$server = new server();
			$server->set_ip($ip);
			$server->set_owner($owner);
			if($server->add_server() == "Fail"){
				$err = "<span>The server already exists</span>";
			} else {
				header('location: index.php?c=server&a=list');
				exit();
			}
		}
	} elseif (isset($_POST['submit']) && isset($_FILES['fileIP']['tmp_name'])) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		    $mime = finfo_file($finfo, $_FILES['fileIP']['tmp_name']);
		   

		    if ($mime == 'text/plain') {
		    	$owner = $_SESSION['name'];
		        $IPList = getIPFromFile($_FILES['fileIP']['tmp_name']);
		        $server = new server();		
		        foreach ($IPList as $ip) {
		        	$server->set_ip($ip);
					$server->set_owner($owner);

		        	if($server->add_server() == "Fail"){
		        		echo 'Server: '.$ip.' failed to add';
		        	}
		        }
		        finfo_close($finfo);
		       	header('location: index.php?c=server&a=list');
				exit();
    		} else {
    			$err = "<span>Only accept text file</span>";
    		}
	}

	include('views/server/addserver.php');
?>