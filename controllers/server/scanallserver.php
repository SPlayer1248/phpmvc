<?php 

// if (isset($_GET['ip']) && !empty($_GET['ip'])) {
// 	$ip = $_GET['ip'];
// 	$filename = $ip.'.out';
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
// }
	
?>