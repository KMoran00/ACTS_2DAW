<?php
// Usuario y contraseña válidos
$usuario= "kirsha";
$contrasenya = "qwerty";

//vemos si el usuario y contraseña es válido
if ($_POST["usuario"]==$usuario && $_POST["contrasenya"]==$contrasenya) {

    //defino una sesion y guardo datos
    session_start();
    $_SESSION["autentificado"]= "SI";
    header ("Location: tienda.php");
}
else {
    //si no existe le mando otra vez a la portada
    header("Location: login.php?errorusuario=si");
}
?>
