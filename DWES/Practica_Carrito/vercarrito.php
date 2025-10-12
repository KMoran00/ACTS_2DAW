<?php
//Vincula el archivo funciones.php
include("funciones.php"); 

//Título de la página
echo"<h1>Contenido del carrito</h1>";
mostrar_carrito(); //Llamada a la función mostrar_carrito


//Enlace a la página principal o al check out 
echo "<p><a href='tienda.php'>Seguir comprando</a>   <a href= 'realizarcompra.php'>Realizar compra</a> </p>"; 

?>