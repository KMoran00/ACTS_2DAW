<?php 
include("funciones.php"); //Vinculamos el archivo funciones.php

//Título mostrado en la web
echo "<h1> Mi Tienda </h1>";

//Condición que muestra un mensaje dependiendo de si el carrito está vacío o no
if (isset($_COOKIE['carrito'])){
    $arrayCarrito = unserialize($_COOKIE['carrito']);
    $totalCarro = array_sum($arrayCarrito);  //Variable que suma todos los productos del carrito
    echo"<p>Llevas $totalCarro artículos seleccionados</p>";
}
else{
    echo"<p>El carrito está vacío</p>";
}

escaparate(); //Llamada a la función escaparate

//Formulario con botón que redirige a vercarrito.php
echo"<form action='vercarrito.php' method='get' style='margin-top:20px;'>
        <input type='submit' value='Ver carrito'>
      </form>";
      
?>
