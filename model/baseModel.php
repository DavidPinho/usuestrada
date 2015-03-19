<?php 

//DataBase Connection

class BaseModel{
	public   $dbname,
				$user,
				$pass,
				$connection;

	public function __construct()
	{

		$this->dbname = "usuestrada";
		$this->user = "root";
		$this->pass = "";
		$this->connection = self::connectDB($this->dbname,$this->user,$this->pass);
	}

	private function connectDB($nome, $usuario, $senha)
	{
		try
		{
			$connection = new PDO('mysql:host=localhost;dbname='.$nome,$usuario,$senha,array(PDO::ATTR_PERSISTENT => true));
			$connection->exec("set names utf8");
        }
        catch (PDOException $e)
        {
            die("Erro!: " . $e->getMessage() . "<br/>");
            return false;
        }
        return $connection;
	}

    
}
?>