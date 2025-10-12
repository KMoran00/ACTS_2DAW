<?php
// Eliminar la cookie "carrito"
setcookie("carrito", "", time() - 3600);

// Mensaje de agradecimiento al usuario.
echo"<h1>Gracias por su compra</h1>";

//Mensaje de confirmación para el usuario
echo"<p>Su carrito ha sido vaciado</p>";

//Enlace a la página principal
echo"<p><a href='tienda.php'>Volver a la tienda</a></p>";
?>