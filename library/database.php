<?php 

/**
 * 
 */
class database
{
	protected $_host = "localhost";
    protected $_username = "root";
    protected $_password = "";
    protected $_database = "mvc";
    protected $_conn;
    protected $_result;

    public function connect(){
    	$this->_conn = mysqli_connect($this->_host, $this->_username, $this->_password, $this->_database);

    }

    public function disconnect(){
    	if($this->_conn){
    		mysqli_close($this->_conn);
    	}
    }

    public function query($sql){
    	if($this->_conn){
    		$this->free_query();
    		$this->_result = mysqli_query($this->_conn, $sql);
    	}
    }

    public function free_query(){
    	if($this->_result){
    		mysqli_free_result($this->_result);
    	}
    }

    public function num_row(){
    	if($this->_result){
    		$row = mysqli_num_rows($this->_result);
    		return $row;
    	}
    }

    public function fetch(){
    	if($this->_conn){
    		$row = mysqli_fetch_array($this->_result);
    		return $row;
    	}
    }

}
?>