<?php 
//Clase Cliente
class Cliente{
    private $dni;
    private $nombre;
    private $direccion;
    private $localidad;
    private $provincia;
    private $telefono;
    private $email;

    //Constructor de la clase
    public function __construct($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email){
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->telefono = $telefono;
        $this->email = $email;

    }

}

?>