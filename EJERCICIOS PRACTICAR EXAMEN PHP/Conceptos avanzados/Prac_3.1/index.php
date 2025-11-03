<?php
$frase = "A quien madruga Dios le ayuda";

function mostrar_impares($frase)
{
	$longitud = strlen($frase);
    for ($i = 1; $i < $longitud; $i++) {
    	if($i%2 != 0){
    		echo $frase[$i];
    	}
    }
}

mostrar_impares($frase);

?>