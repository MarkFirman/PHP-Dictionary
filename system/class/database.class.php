<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2018
 *
 */
class Database{
	
	/* Database login credentials go here */
	protected $host = "YOUR HOSTNAME";
	protected $user = "USERNAME";
	protected $pass = "PASSWORD";
	protected $dbname = "DATABASE NAME";
	
	/* Database handles */
	private $dbh;
	private $error;
	private $stmt;
	
	/* Initiate connecction when class is called */
	function __construct(){
		
		// Set DSN  
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname; 
		// Set options  
		$options = array(  
					PDO::ATTR_PERSISTENT => true,  
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  
					);
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}  
	}	
	
	/* Send SQL query to the database */
	public function query($query){  
		$this->stmt = $this->dbh->prepare($query);
	} 
	
	/* Bind parameters to SQL query 
	 * query() needs to be set before attempting binding
	 */
	public function bind($param, $value, $type = null){
		if (is_null($type)) {  
			switch (true) {  
				case is_int($value):  
				$type = PDO::PARAM_INT;  
				break;  
				case is_bool($value):  
				$type = PDO::PARAM_BOOL;  
				break;  
				case is_null($value):  
				$type = PDO::PARAM_NULL;  
				break;  
				default:  
				$type = PDO::PARAM_STR;  
			}  
		}
	
	$this->stmt->bindValue($param, $value, $type); 
	}  
	
	/* Execute the SQL command */
	public function execute(){  
		return $this->stmt->execute();  
	} 

	/* Executes the SQL command and returns the result set */
	/* Used when more than 1 result is to be returned */
	public function resultset(){  
		$this->execute();  
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);  
	}  
	
	/* Executes the SQL command and returns a single result */
	public function single(){  
		$this->execute();  
		return $this->stmt->fetch(PDO::FETCH_ASSOC);  
	}  
	
	/* Returns a count of the number of rows returned from the database */
	public function rowCount(){  
		return $this->stmt->rowCount();  
	} 
	
	/* Returns a word from the database */
	public function getWord(){
		$date = date('d')."/".date('m');
		$this->query('SELECT word FROM dictionary WHERE date = :date ORDER BY id ASC LIMIT 1');
		$this->bind(":date", $date);
		return $this->single();
	}
	
}
?>