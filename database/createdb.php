<?php
class CreateDb
{
	public $servername;
	public $username;
	public $dbname;
	public $password;
	public $tablename;
	public $con;
	
	//class constructor
	public function __construct(
	  $dbname = "healthybite",
	  $tablename = "menu",
	  $servername = "localhost",
	  $username = "root",
	  $password = ""
	)
	{
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;
		$this->tablename = $tablename;
		$this->servername = $servername;
		
		//create connection_aborted
		$this->con = mysqli_connect($servername,$username,$password,$dbname);
		
		//check connection
		if(!$this->con){
			die("connection failed: ".mysqli_connect_error());
		}
		else{
			//echo "connected to database";
		}
		
		
	}
	
	//get menu from the database
	public function getData(){
		$sql = "SELECT * FROM $this->tablename m JOIN farmers r where m.res_id = r.res_id limit $offset, $limit ORDER BY date ASC ";
		$result = mysqli_query($this->con,$sql);
		if(mysqli_num_rows($result)>0){
			return $result;
		}
	}
	public function getDatasearch(){
	
	$sql = "SELECT * FROM $this->tablename m JOIN farmers r where m.res_id = r.res_id ORDER BY date DESC limit 6 WHERE $choices LIKE '%$m%'";
	$result = mysqli_query($this->con,$sql);
	if(mysqli_num_rows($result)>0){
		return $result;
	}
	
	}
	public function getCategory(){
	
	$sql = "SELECT * FROM category";
	$result = mysqli_query($this->con,$sql);
	if(mysqli_num_rows($result)>0){
		return $result;
	}
	
	}





}

//create instance of class
$database = new CreateDb();


?>