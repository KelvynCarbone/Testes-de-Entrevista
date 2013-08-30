<?php
//Instancia a classe
require('./class.DBE.php');

//Recebe as variaveis
$table=$_POST['table'];
$td=$_POST['td'];

//Chama a classe
$DB = New DBE();

//Query
$query="INSERT INTO megasena (tabela,numero) values ('".$table."','".$td."') ";

try
	{
	//Executa a Query
	$DB->Query($query);
	}
//Em caso de erro avisa
catch (Exception $e) 
	{
	print "<script> alert('Erro ao inserir no banco') </script>";
	}
	

?>