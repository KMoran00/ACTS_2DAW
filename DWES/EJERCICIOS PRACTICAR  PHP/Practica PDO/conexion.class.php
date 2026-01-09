<?php
class Conexion
{
    //Atributos
    private $dbname;
    private $host;
    private $user;
    private $password;

    //Getters
    public function getDbName()
    {
        return $this->dbname;
    }
    public function getHost()
    {
        return $this->host;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getPassword()
    {
        return $this->password;
    }
    //Setters
    public function setDbName($dbname)
    {
        $this->dbname = $dbname;
    }
    public function setHost($host)
    {
        $this->host = $host;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }


    //Constructor de la clase
    public function __construct($dbname, $host, $user, $password)
    {
        $this . $dbname->$dbname;
        $this . $host->$host;
        $this . $user->$user;
        $this . $password->$password;
    }

    static function conectarBD($dbname, $host, $user, $password)
    {
        $dbname = "Kirsha";
        $host = "10.2.218.1";
        $user = "tendaFake";
        $password = "Lliurex_01";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            return null;
            header("Location: index.php");
            exit();
        };
    }
    static function desconectarBD($pdo)
    {
        $pdo = null;
    }
}
