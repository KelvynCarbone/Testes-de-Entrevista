<?php
/**
 * 
 * Classe de manipulação PDO: 
 *
 * @example $DB= new DBE(); $DB->Query("query");
 * @desc Uso Básico
 *
 * @type PHP/MYSQL
 *
 * @name DBE
 * @author Kelvyn Indicatti Carbone (http://kelvyncarbone.tumblr.com)
 */	
    class DBE
	{

        private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $dbname = "";
	private $dbh;
	private $error;
	private $result;
        
        /**
         * REABRE a conex�o ao banco de dados
         *
         */
         
	//Construct da classe para poder instanciar	 
        public function __construct()
		{
		// Set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		// Set options
		$options = array(
		PDO::ATTR_PERSISTENT    => true,
		PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
		);
		// Create a new PDO instanace
		try
			{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			}
		// Catch any errors
		catch(PDOException $e)
			{
			$this->error = $e->getMessage();
			}
		}
	//Função que executa as query
	public function Query($query)
		{
		//Verifica o tipo transição, de acordo com a mesma ele escolhe o tipo de ação
		if(strpos(strtolower($query),"select")!==false)
			{
			$this->result=$this->dbh->query($query);
			}
		else
			{
			$this->result = $this->dbh->exec($query);
			}
		}
		
	//Função que executa as query
	public function Rows()
		{
		$this->result->execute();
		return $this->result->rowCount();
		}
	//Faz um fetch obj
	public function Fetch($tipo)
		{
		if(!$tipo)
			{
			return $this->result->fetch(PDO::FETCH_OBJ);
			}
		else
			{
			return $this->result->fetch($tipo);
			}
		}
	//Retorna o ultimo id inserido após query	
	public function LastId()
		{
		return $this->dbh->lastInsertId();
		}
	//Faz o rollback em caso de problema	
	public function RollBack()
		{
		return $this->dbh->rollback();
		}
		
	}
?>