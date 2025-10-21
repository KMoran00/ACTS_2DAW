<?php
function conectarBD()
{
    $host = "localhost";
    $db = "Practica_PDO";
    $user = "root";         //Usuario de la base de datos
    $pass = "Lliurex_01";   //Contraseña de la base de datos

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return null;
    }
}
?>