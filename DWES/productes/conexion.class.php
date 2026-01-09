<?php
class Conexion
{
    private $host;
    private $db;
    private $user;
    private $pass;
    
    public static function conectarBD()
    {
        $host = "10.2.218.1";
        $db = "tendaFake";
        $user = "tendaFake";    //Usuario de la base de datos
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
    public static function desconectarBD(&$conexion)
    {
        $conexion = null; // cierra explícitamente la conexión
    }
}
?>