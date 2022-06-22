<?php

class Database{
	private $connection = null;

	public function __construct($username = 'root', $password = '', $host = 'localhost', $db_name = 'dbname', $connection_type = 'mysqli'){
		try{
			$this->connection = new PDO("$connection_type:host=$host;port=5432;dbname=$db_name",$username,$password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function Insert($query ,$params = []){
		try{
			$statement = $this->ExecuteStatement($query,$params);

			return $this->connection->lastInsertId();

		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function Select($query, $params = []){
		try{
			$statement = $this->ExecuteStatement($query,$params);

			return $statement->fetchAll();
            
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function Update($query, $params = []){
		try{
			$this->ExecuteStatement($query,$params);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function Remove($query, $params = []){
		try{
			$this->ExecuteStatement($query,$params);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
    
    public function CreateParameterString($data,$excluded_parameters = []){
        $parameter_string = "";
        
        foreach($data as $key => $value){
            if(!in_array($key,$excluded_parameters)){
                $parameter_string .= "$key=:$key,";
            }
        }
        
        return substr($parameter_string,0,-1);
    }

	private function ExecuteStatement($query,$params = []){
		try{
			$statement = $this->connection->prepare($query);
            $statement->execute($params);
            
            return $statement;
            
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}

?>