<?php
/*Funчуo que gera 6 nњmeros de 1 р 60 aleatѓriamente e ordenados.*/
function Megasena()
	{
	/*Inicia o array vazio.*/
	$valores = array();

	/*Inicia contador em zero para os 6 numeros que irуo ser exibidos.*/
	$i = 0;
	
	/*While fazer o processo 6 vezes*/
	while( $i <= 5 ) 
		{
		/*Pega os nњmeros aleatѓrios de 1 р 60.*/
		$numero = rand( 1,60 );
		
		/*Se o nњmero nуo existir numero dentro do array ele pѕe.*/
		if( ! in_array( $numero,$valores ) )
			{
			/*Seta o valor dentro do array*/
			$valores[] = $numero;
			++$i;
			}
		}
	/*Orderna  os nњmeros*/
	sort( $valores );
	
	/*Retorna os nњmeros*/
	return $valores;
	}

/*Executa a Funчуo*/
print_r (Megasena());

?>