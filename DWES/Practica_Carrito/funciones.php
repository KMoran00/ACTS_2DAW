<?php
//Función que muestra los productos en el carrito
function mostrar_carrito() {
    if(!isset($_COOKIE['carrito'])){
        echo"<p>El carrito está vacío</p>";
        return;
    }

    $arrayCarrito = unserialize($_COOKIE['carrito']);
    if(empty($arrayCarrito)){
        echo"<p>El carrito está vacío</p>";
        return;
    }

    //Tabla que muestra las referencias y unidades de los productos en el carrito
    echo"<table border='1'>";
    echo"<tr><th>Referencias</th><th>Unidades</th></tr>";
    $totalCarro = 0;
    foreach($arrayCarrito as $ref=>&$unidades){
        echo"<tr><td>$ref</td><td>$unidades</td></tr>";
        $totalCarro += $unidades;
    }
    echo "<tr><td colspan='2'>Número total de unidades: $totalCarro </td></tr>";
    echo "</table>";
}

/* Función que muestra el escaparate de productos:
* muestra la referencia, descripció y precio y un 
* enlace para añadir al carrito
*/
function escaparate() {
    $arrayProductos = [
        "ref1" => ["nombre" => "descripción artículo 1", "precio" => 5],
        "ref2" => ["nombre" => "descripción artículo 2", "precio" => 3],
        "ref3" => ["nombre" => "descripción artículo 3", "precio" => 2],
    ];

    echo"<table border='1'>";
    echo"<tr><th>Referencia</th><th>Descripción</th><th>Precio</th><th></th></tr>";
    foreach($arrayProductos as $ref => $prod){
        echo "<tr>";
        echo"<td>$ref</td>";
        echo "<td>{$prod['nombre']}</td>";
        echo "<td>{$prod['precio']}€ </td>";
        echo "<td><a href='añadiralcarro.php?ref=$ref'>Comprar</a></td>";
        echo "</tr>";
    }
    echo"</table>";
}

?>
