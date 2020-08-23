<?php
namespace App\Config;

use PDO;
use PDOException;

/**
 * Database
 * 
 * Create a database connection
 */
class Database{
	private $server;
	private $databaseName;
	private $charset;
	private $user;
	private $senha;
	private $db;

		
	/**
	 * Database
	 *
	 * Return a PDO database connection to MySQL
	 * 
	 * @return Database
	 */
	public function __construct()
	{
		$databaseConfig = json_decode(file_get_contents(__DIR__ . '/../config/config.json'));
		$this->server = $databaseConfig->server;
		$this->databaseName = $databaseConfig->databaseName;
		$this->charset = $databaseConfig->charset;
		$this->user = $databaseConfig->user;
		$this->senha = $databaseConfig->senha;

		try{
			$this->db = new PDO('mysql:host='.$this->server.';dbname='.$this->databaseName.";charset=$this->charset", 
							$this->user,
							$this->senha);
		}
		catch(PDOException $ex){
			if($databaseConfig->enviroment != "production")
			die(json_encode(array(
				'outcome' => false, 
				'message' => 'Unable to connect to database',
				'error' => "$ex"
			)));
		}
		return $this->db;
	}

	
	/**
	 * Select
	 *
	 * Select all items from a given database table and return an array of data
	 * 
	 * @param  mixed $table
	 * @return array
	 */
	public function select(string $table, string $field = null, $search = null, $operator = "=")
	{
		$query = (is_null($search)) ? "SELECT * FROM $table" : "SELECT * FROM $table where $field $operator :where";
		$prepare = $this->db->prepare($query);
		$prepare->bindValue(":where", $search);
		$prepare->execute();

		while($row = $prepare->fetch()) {
            $result[] = $row;
		}
		
		if(!isset($result)){
			return false;
		}
		if (is_null($search)) {
			return $result;
		}else {
			return $result[0];
		}
        
	}
	
	/**
	 * Insert
	 *
	 * Insert a given list of data into a given table
	 * 
	 * @param  mixed $table
	 * @param  mixed $fields
	 * @param  mixed $values
	 * @return bool
	 */
	public function insert(string $table, array $fields = [], array $values = [])
	{

		$fields = implode("`, `",  $fields);
		$values = implode("', '",  $values);
		
		$query = "INSERT INTO `$table` (`$fields`) VALUES ('$values')";
		$prepare = $this->db->prepare($query);
		$res = $prepare->execute();

		
		return $res;
	}

	public function update(string $table, array $fields = [], array $values = [], string $field, string $search, $operator = "=")
	{
		try {
			$counter = 0;
			$updateValues = "";
			foreach ($fields as $value) {
				$updateValues = "`$value` = '$values[$counter]'";
				$counter++;
			}
			var_dump($updateValues);
			// $query = "UPDATE `$table` SET (`$fields`) VALUES ('$values') WHERE $field $operator $search";
			// $prepare = $this->db->prepare($query);
			// $res = $prepare->execute();
		}catch(PDOException $error) {
			$result = 'Error: ' . $error->getMessage();
		}
		
		//return $res;
	}

	public function delete(string $table, string $field, string $search, $operator = "=")
	{
		try {
			$query = "DELETE FROM $table where $field $operator :where";
			$prepare = $this->db->prepare($query);
			$prepare->bindValue(":where", $search);
			$prepare->execute();
			
			$result = $prepare->rowCount();
		}catch(PDOException $error) {
			$result = 'Error: ' . $error->getMessage();
		}
		return $result;
	}
}

