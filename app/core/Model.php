<?php


class Model{

	protected $table;
	protected $conn;

	public function __construct(){
		$this->conn = $this->connect();
	}


	private function connect(){
		  
		try {
		  return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD,[
		  		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		  		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		  ]);
		}
		catch(PDOException $pe){
			die("DB Connection Failed ".$pe->getMessage());
		}
	}


	protected function getAll(){

		$sql = 'SELECT * FROM `'.$this->table.'`';
		$stmt = $this->conn->prepare($sql);
		$result = $stmt->execute();

		return $stmt->fetchAll();
	}

	protected function getById($idKey,$idValue){
		$sql = 'SELECT * FROM `'.$this->table.'` WHERE '.$idKey.' = :'.$idKey;
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$idKey => $idValue]);
		return $stmt->fetchAll();

	}

	protected function insert($columns){
		$keys = array_keys($columns);
		$values = array_values($columns);

		$sql = 'INSERT INTO `'.$this->table.'` ('.implode(',', $keys).') VALUES (:'.implode(',:',$keys).')';
		error_log($sql);
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute($columns);
	}
}