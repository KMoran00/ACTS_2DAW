<?php
//Inicio la sesión
session_start();

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($_SESSION["autentificado"] != "SI") {
    //si no existe, volver al login
    header("Location: login.php");
    //ademas salgo de este script
    exit();
}
?>