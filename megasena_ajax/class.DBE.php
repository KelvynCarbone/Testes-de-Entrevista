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
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Sao_Paulo');

    class DBE
	{

	private $host = "";
	private $user = "";
	private $pass = "";
	private $dbname = "";
	private $dbh;
	private $error;
	private $result;

    /*
     *
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "";
        private $dbh;
        private $error;
        private $result;
     */

	/**
	 * REABRE a conex�o ao banco de dados
	 *
	 */

		//Construct da classe para poder instanciar	 
	public function __construct()
		{
		// Set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname.'; charset=utf8';
		// Set options
		$options = array(
		PDO::ATTR_PERSISTENT    => false,
		PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
		);
		//Instancia o PDO
		try
			{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			}
		catch(PDOException $e)
			{
			$this->error = $e->getMessage();
			$this->error = str_replace("\n","",$this->error);
			$this->error = str_replace('"',"'",$this->error);
			print "<script> alert(\"".$this->error."\"); </script>";
			//print "<script> alert('Ocorreu um erro ao conectar no banco de dados'); </script>";
			exit;
			}
		}
	//Função que executa as query
	public function Query($query)
		{
		//Verifica o tipo transição, de acordo com a mesma ele escolhe o tipo de ação
		if(strpos(strtolower($query),"select")!==false)
			{
			try
				{
				$this->result=$this->dbh->prepare($query);
				$this->result->execute();
				}
			catch(PDOException $e)
				{
				$this->error = $e->getMessage();
				$this->error = str_replace("\n","",$this->error);
				$this->error = str_replace('"',"'",$this->error);
				print "<script> alert(\"".$this->error."\"); </script>";
				//return print "Ocorreu um erro ao executar a query!";
				exit;
				}
			}
		else
			{
			try
				{
				$this->result=$this->dbh->prepare($query);
				$this->result=$this->result->execute();
				$this->dbh=null; //Fecha a conexão
				}
			// Catch any errors - como é insert se não fez, faz um rollback
			catch(PDOException $e)
				{
				$this->error = $e->getMessage();
				$this->error = str_replace("\n","",$this->error);
				$this->error = str_replace('"',"'",$this->error);
				print "<script> alert(\"".$this->error."\"); </script>";
				//return print "Ocorreu um erro ao executar a query!";
				exit;
				}
			}
		}

	//Função que executa as query
	public function Rows()
		{
		try
			{
			return $this->result->rowCount();
            $this->dbh=null;
			}
		catch(PDOException $e)
			{
			$this->error = $e->getMessage();
			$this->error = str_replace("\n","",$this->error);
			$this->error = str_replace('"',"'",$this->error);
			print "<script> alert(\"".$this->error."\"); </script>";
			//print "<script> alert('Ocorreu um erro ao executar o Fetch[1]'); </script>";
			exit;
			}
	
		}
		
	//Faz um fetch obj
	public function Fetch($tipo=null)
		{
		if(isset($tipo))
			{
			try
				{
				return $this->result->fetch($tipo);
				$this->dbh=null;
				}
			catch(PDOException $e)
				{
				$this->error = $e->getMessage();
				$this->error = str_replace("\n","",$this->error);
				$this->error = str_replace('"',"'",$this->error);
				print "<script> alert(\"".$this->error."\"); </script>";
				//print "<script> alert('Ocorreu um erro ao executar o Fetch[1]'); </script>";
				exit;
				}
			}
		else
			{
			try
				{
				return $this->result->fetch(PDO::FETCH_OBJ);
				$this->dbh=null;
				}
			catch(PDOException $e)
				{
				$this->error = $e->getMessage();
				$this->error = str_replace("\n","",$this->error);
				$this->error = str_replace('"',"'",$this->error);
				print "<script> alert(\"".$this->error."\"); </script>";
				//print "<script> alert('Ocorreu um erro ao executar o Fetch[1]'); </script>";
				exit;
				}
			}
		}
		
	//Retorna o ultimo id inserido após query	
	public function LastId()
		{
		try
			{
			return $this->dbh->lastInsertId();
            $this->dbh=null;
			}
		// Catch any errors
		catch(PDOException $e)
			{
			$this->error = $e->getMessage();
			$this->error = str_replace("\n","",$this->error);
			$this->error = str_replace('"',"'",$this->error);
			print "<script> alert(\"".$this->error."\"); </script>";
			//print "<script> alert('Ocorreu um erro ao executar o LastId'); </script>";
			exit;
			}
		}
		
	//Faz o rollback em caso de problema	
	public function RollBack()
		{
		try
			{
			return $this->dbh->rollback();
			$this->dbh=null;
			}
		// Catch any errors
		catch(PDOException $e)
			{
			$this->error = $e->getMessage();
			$this->error = str_replace("\n","",$this->error);
			$this->error = str_replace('"',"'",$this->error);
			print "<script> alert(\"".$this->error."\"); </script>";
			//print "<script> alert('Ocorreu um erro ao executar o Rollback'); </script>";
			exit;
			}
		}

	}
?>
