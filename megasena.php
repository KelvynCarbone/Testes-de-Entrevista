<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mega Sena</title>
<style>
	.check
		{
		background:#CCC;
		}
	table
		{
		border: 1px solid #333;
		margin-bottom:10px;
		}
</style>
</head>

<?php
//Função que gera 6 números de 1 à 60 aleatóriamente e ordenados.
function Megasena()
	{
	//Inicia o array vazio.
	$valores = array();

	//Inicia contador em zero para os 6 numeros que irão ser exibidos.
	$i = 0;
	
	//While fazer o processo 6 vezes
	while( $i <= 5 ) 
		{
		//Pega os números aleatórios de 1 à 60.
		$numero = rand( 1,60 );
		
		//Se o número não existir numero dentro do array ele põe.
		if( ! in_array( $numero,$valores ) ) 
			{
			//Seta o valor dentro do array
			$valores[] = $numero;
			++$i;
			}
		}
	//Orderna  os números
	sort( $valores );
	
	//Retorna os números
	return $valores;
	}

function GeraJogo()
	{
	$jogo = array();
	$x = 1;
	
	//Gera as 3 tabelas
	while($x <= 3) 
		{
		//Usa a função para gerar os valores
		$valores = Megasena();
		$r=0;
		
		//Gera o jogo para montar as tabelas de acordo com os valores
		foreach($jogo as $j) 
			{
			$r = 0;
			foreach($valores as $n) 
				{
				if(in_array($n,$j)) 
					{
					$r++;
					}
				}
			if($r==6) 
				{
				break;
				}
			}
		 $jogo[] = $valores;
		 $x++;
		}
		
	//Monta as tableas de acordo com o resultado da função
	foreach($jogo as $j) 
		{
		 echo "<table>";
		 echo "<tr>";
		 $l = 1;
		 for($i = 1; $i <= 60; ++$i) 
			{
			if(in_array( $i,$j )) 
				{
				echo "<td class='check'>";
				} 
			else 
				{
				echo "<td>";
				}
			echo $i;
			echo "</td>";
			$l++;

			if($l > 10) 
				{
				$l = 1;
				echo "</tr>";
				echo "<tr>";
				}
			}
		echo "</table>";
		}
	}

//Chama a função
GeraJogo();
?>

</body>
</html>