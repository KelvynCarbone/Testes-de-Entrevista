<?php

class Arquivo 
	{
	 //Variável privada
	 private $conteudo;
	 
	 //Função que retorna o conteudo
	 function Conteudo() 
		{
		//Retorna o conteúdo
		return htmlentities($this->conteudo);
		}
	 //Lê o Arquivo
	 function LerArquivo($arquivo) 
		{
		//
		$this->conteudo = file_get_contents($arquivo);
		}
	}


?>
<form method="post" enctype="multipart/form-data">
<label>Selecione o arquivo:</label>
<input type="file" name="arquivo">
<input type="submit" name="ok" value="Enviar">
</form>

<?php
if(isset($_FILES[ "arquivo" ]["tmp_name"])) 
	{
	$arq = $_FILES[ "arquivo" ]["tmp_name"];
	$arquivo = New arquivo();
	$arquivo->LerArquivo($arq);
	echo $arquivo->Conteudo();
	}
?>