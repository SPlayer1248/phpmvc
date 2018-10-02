<?php 


/**
 * 
 */
class ServerController
{
	
	function __construct()
	{
		if (isset($_GET['a'])) {
			switch ($_GET['a']) {
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
				case 'scan':
					$this->scan();
					break;
				case 'scanall':
					$this->scan_all();
					break;
				case 'list_all_report':
					$this->list_all_report();
					break;
				case 'list_report':
					$this->list_report();
					break;
				default:
					# code...
					break;
			}
		}
	}

	public function list() {
		if (isset($_SESSION['level'])) {
			$server = new server();
			if($_SESSION['level'] == 0){
				$server->set_owner($_SESSION['name']);	
			} 
			$result = $server->list_server();
			include('views/server/listserver.php');
			
		}
		else{
			header('location: index.php');
			exit();
		}
	}

	public function add() {
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
	}

	public function edit() {
		if(isset($_SESSION['level'])==1){
			if (isset($_GET['s'])) {
				$s = $_GET['s'];
				$server = new server();
				$server->set_ip($s);
				$result = $server->select_server();
			}

			if(isset($_POST['submit'])){
				$ip = $_POST['ip'];
				if (!isset($_POST['owner']) && empty($_POST['owner']) && $_SESSION['level'] != 1) {
							$owner = $_SESSION['name'];
						} else {
							$owner = $_POST['owner'];
						}

				if($ip && $owner){
						$server = new server();
						$server->set_ip($ip);
						$server->set_owner($owner);
						if ($server->edit_server($s) == "Fail") {
							$err = "<span>The server ip already exists</span>";
						} else {
							header('location: index.php?c=server&a=list');
							exit();
						}
					}
			}

			include('views/server/editserver.php');
		} else {
			header('location: index.php');
			exit();
		}
	}

	public function delete() {
		if(isset($_SESSION['level'])==1){
			if (isset($_GET['s'])) {
				$s = $_GET['s'];
				$server = new server();
				$server->set_ip($s);

				if ($server->select_server() == "Fail") {
					header('location: index.php?c=server&a=list');
					exit();
				} else {
					$server->del_server();
					header('location: index.php?c=server&a=list');
					exit();
				}
				
			}
		} else{
			header('location: index.php?c=user&a=login');
		}
	}

	public function scan() {
		if (isset($_GET['ip']) && !empty($_GET['ip'])) {
			$ip = $_GET['ip'];
			$filename = $ip.'.out';
			$cmd = 'nmap -v -O -oN '.$filename.' '.$ip;
			shell_exec($cmd);
			$hostname = '';
			$os = '';
			$open_ports = '';
			$filtered_ports = '';
			$handle = fopen($filename, "r");
			if ($handle) {
			    while (($line = fgets($handle)) !== false) {
			        if(strpos($line,"Nmap scan report for") !== false){
			        	$hostname =  explode(" ",$line)[4];
			        }
			        else if(strpos($line,"Aggressive OS guesses: ") !== false){
			        	$os =  explode(": ",$line)[1];
			        	$os = explode(",",$os)[0];
			        }
			        else if(strpos($line," filtered ") !== false){
			        	if($filtered_ports !== ''){
			        		$filtered_ports .= ', ';
			        	}
			        	if(explode(" ",$line)[0] !=='Warning:' && explode(" ",$line)[0] !=='Not'){
			        		$filtered_ports .=  explode(" ",$line)[0];
			        	}
			        	
			        }
			        else if(strpos($line," open ") !== false){
			        	if($open_ports !== ''){
			        		$open_ports .= ', ';
			        	}
			        	if(explode(" ",$line)[0] !=='Warning:'){
			        		$open_ports .=  explode(" ",$line)[0];
			        	}
			        }
			    }

			    fclose($handle);
			} else {
			    echo 'error opening the file.';
			} 
			unlink($filename);
			if(isset($_SESSION['level'])==1 && isset($_GET['owner'])){
				$owner = $_GET['owner'];
			} else {
				$owner = $_SESSION['name'];
			}
			$report = new report();
			$report->set_ip($ip);
			$report->set_owner($owner);
			$report->set_host($hostname);
			$report->set_os($os);
			$report->set_open_ports($open_ports);
			$report->set_filtered_ports($filtered_ports);
			$report->add_report();
			header('location: index.php?c=server&a=list_report&ip='.$ip);
			exit();
		}
	}

	public function scan_all() {
		$server = new server();
		if(isset($_SESSION['level'])==="1"){
			$server->set_owner('');
		} else {
			$owner = $_SESSION['name'];
			$server->set_owner($owner);
		}
		$result = $server->list_server();

		foreach ($result as $row) {
			$ip = $row['ip'];
			$filename = $ip.'.out';
			$owner = $row['owner'];
		$cmd = 'nmap -v -O -oN '.$filename.' '.$ip;
		shell_exec($cmd);

		$hostname = '';
		$os = '';
		$open_ports = '';
		$filtered_ports = '';
		$handle = fopen($filename, "r");
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
		        if(strpos($line,"Nmap scan report for") !== false){
		        	$hostname =  explode(" ",$line)[4];
		        }
		        else if(strpos($line,"Aggressive OS guesses: ") !== false){
		        	$os =  explode(": ",$line)[1];
		        	$os = explode(",",$os)[0];
		        }
		        else if(strpos($line," filtered ") !== false){
		        	if($filtered_ports !== ''){
		        		$filtered_ports .= ', ';
		        	}
		        	if(explode(" ",$line)[0] !=='Warning:' && explode(" ",$line)[0] !=='Not'){
		        		$filtered_ports .=  explode(" ",$line)[0];
		        	}
		        	
		        }
		        else if(strpos($line," open ") !== false){
		        	if($open_ports !== ''){
		        		$open_ports .= ', ';
		        	}
		        	if(explode(" ",$line)[0] !=='Warning:'){
		        		$open_ports .=  explode(" ",$line)[0];
		        	}
		        }
		    }

		    fclose($handle);
		} else {
		    echo 'error opening the file.';
		} 
		unlink($filename);
		$report = new report();
		$report->set_ip($ip);
		$report->set_owner($owner);
		$report->set_host($hostname);
		$report->set_os($os);
		$report->set_open_ports($open_ports);
		$report->set_filtered_ports($filtered_ports);
		$report->add_report();

	}


		header('location: index.php?c=server&a=list_all_report');
		exit();
	}

	public function list_all_report() {
		if (isset($_SESSION['level'])) {
			$report = new report();
			if($_SESSION['level'] == 0){
				$report->set_owner($_SESSION['name']);	
			} 
			
			$result = $report->list_all_report();
			include('views/report/list_report.php');
			
		} else{
			header('location: index.php');
			exit();
		}
	}

	public function list_report() {
		if (isset($_SESSION['level'])) {
			if(isset($_GET['ip'])){
				$ip = $_GET['ip'];
				$report = new report();
				if($_SESSION['level'] == 0){
					$report->set_owner($_SESSION['name']);	
				} 
				$report->set_ip($ip);
				$result = $report->list_report();
				include('views/report/list_report.php');
			}
			
			
		} else{
			header('location: index.php');
			exit();
		}
	}
}
?>