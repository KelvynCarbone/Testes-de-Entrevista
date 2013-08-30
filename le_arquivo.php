<?php

class Arquivo 
	{
	 //Variсvel privada
	 private $conteudo;
	 
	 //Funчуo que retorna o conteudo
	 function Conteudo() 
		{
		//Retorna o conteњdo
		return htmlentities($this->conteudo);
		}
	 //Lъ o Arquivo
	 function LerArquivo($arquivo) 
		{
		//
		$this->conteudo = file_get_contents($arquivo);
		}
	}
	
$arquivo= New Arquivo();

$arquivo->LerArquivo("./texto.txt");
print $arquivo->Conteudo();
?>