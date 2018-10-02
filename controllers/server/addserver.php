<?php 

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
		        $fileContent = file_get_contents($_FILES['fileIP']['tmp_name']);
				$lines = explode("\r\n", $fileContent);
		        $server = new server();		

		        foreach ($lines as $line) {
		        	if(explode(" - ", $line)[1]){
		        		$ip = explode(" - ", $line)[0];
		        		$owner = explode(" - ", $line)[1];
		        	} else {
		        		$ip = $line;
		        	}
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