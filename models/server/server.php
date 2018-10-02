<?php 

	class server extends Database
	{
		protected $server_ip;
		protected $server_owner;

		function __construct()
		{
			$this->connect();
		}

		public function set_ip($ip){
			$this->server_ip = $ip;
		}

		public function get_ip(){
			return $this->server_ip;
		}

		public function set_owner($owner){
			$this->server_owner = $owner;
		}

		public function get_owner(){
			return $this->server_owner;
		}


		public function list_server(){
			if($this->server_owner){
				$sql = "SELECT * FROM servers WHERE owner='$this->server_owner'";
			} else {
				$sql = "SELECT * FROM servers";
			}
			
			$this->query($sql);
			$result = array();
			$i=0;
			while($row=$this->fetch()){
				$result[$i] = array("ip" => $row['ip'], "owner" => $row['owner']);
				$i++;
			}

			return $result;
		}

		public function add_server(){
			$sql = "SELECT * from servers where ip='$this->server_ip'";
			$this->query($sql);
			if($this->num_row() == 0){
				$sql = "INSERT INTO `servers`(`ip`, `owner`) VALUES ('$this->server_ip','$this->server_owner')";
				$this->query($sql);
			} else {
				return "Fail";
			}
		}

		public function edit_server($old_ip){
			$sql = "UPDATE `servers` SET `ip`='$this->server_ip',`owner`='$this->server_owner' WHERE ip='$old_ip'";
			if($this->query($sql)){
				return "Fail";
			}
		}

		public function del_server(){
			$sql = "SELECT * FROM servers WHERE ip='$this->server_ip'";
	
			$this->query($sql);
			if($this->num_row() == 0){
				return "Fail";
			} else {
				$sql = "DELETE FROM servers WHERE ip='$this->server_ip'";
			
				$this->query($sql);
			}
		}

		public function select_server(){
			$sql = "SELECT * FROM servers WHERE ip='$this->server_ip'";
			$this->query($sql);
			if($this->num_row() == 0){
				return "Fail";
			} else{
				$row=$this->fetch();
				return $row;
		
			}
			}
}	
?>