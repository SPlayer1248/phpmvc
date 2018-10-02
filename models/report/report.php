<?php 

	class report extends Database
	{
		protected $ip;
		protected $owner;
		protected $hostname;
		protected $os;
		protected $open_ports;
		protected $filtered_ports;

		function __construct()
		{
			$this->connect();
		}

		public function set_ip($ip){
			$this->ip = $ip;
		}

		public function get_ip(){
			return $this->ip;
		}

		public function set_host($host){
			$this->hostname = $host;
		}

		public function get_host(){
			return $this->hostname;
		}

		public function set_os($os){
			$this->os = $os;
		}

		public function get_os(){
			return $this->os;
		}

		public function set_open_ports($ports){
			$this->open_ports = $ports;
		}

		public function get_open_ports($ports){
			return $this->open_ports;
		}

		public function set_filtered_ports($ports){
			$this->filtered_ports = $ports;
		}

		public function get_filtered_ports($ports){
			return $this->filtered_ports;
		}


		public function list_all_report(){
			if($this->owner){
				$sql = "SELECT * FROM reports WHERE owner='$this->owner'";
			} else {
				$sql = "SELECT * FROM reports";
			}
			
			$this->query($sql);
			$result = array();
			$i=0;
			while($row=$this->fetch()){
				$result[$i] = array("ip" => $row['ip'], "owner" => $row['owner'], "hostname" => $row['os'], "open_ports" => $row['open_ports'], "filtered_ports" => $row['filtered_ports']);
				$i++;
			}

			return $result;
		}


		public function list_report(){
			if($this->owner){
				$sql = "SELECT * FROM reports WHERE ip='$this->ip' AND owner='$this->owner'";
			} else {
				$sql = "SELECT * FROM reports WHERE ip='$this->ip'";
			}
			
			$this->query($sql);
			$result = array();
			$i=0;
			while($row=$this->fetch()){
				$result[$i] = array("ip" => $row['ip'], "owner" => $row['owner'], "hostname" => $row['os'], "open_ports" => $row['open_ports'], "filtered_ports" => $row['filtered_ports']);
				$i++;
			}

			return $result;
		}


		public function add_report(){
			$sql = "INSERT INTO `reports`(`ip`, `owner`, `hostname`, `osname`, `open_ports`, `filtered_ports`) VALUES ('$this->ip','$this->owner','$this->hostname','$this->osname','$this->open_ports','$this->filtered_ports')";
			$this->query($sql);
		}

}	
?>