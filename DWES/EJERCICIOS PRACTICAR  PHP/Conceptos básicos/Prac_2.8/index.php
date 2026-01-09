<?php
echo"Producto - Precio/kg - Peso - Precio <br>";

define("PRECIO_JUDIAS", 3.50);
$peso_judias = 1.21;
$coste_judias = PRECIO_JUDIAS * $peso_judias;
echo("Judías - ".PRECIO_JUDIAS." - ".$peso_judias." - ". number_format($coste_judias,2)."<br>");

define("PRECIO_PATATAS", 0.40);
$peso_patatas = 1.73;
$coste_patatas = PRECIO_PATATAS * $peso_patatas;
echo("Patatas - ".PRECIO_PATATAS." - ".$peso_patatas." - ". number_format($coste_patatas,2)."<br>");

$total = $coste_judias + $coste_patatas;
echo ("Total: " .number_format($total,2)." euros <br>");
echo"Gracias por su compra <br>";


?>