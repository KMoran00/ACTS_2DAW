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

    //Getters
    public function getDni(){
        return $this->dni;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getLocalidad(){
        return $this->localidad;
    }
    public function getProvincia(){
        return $this->provincia;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getEmail(){
        return $this->email;
    }

    //Setters
    public function setNombre($nombre){
        $this->nombre = $nombre;  
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setLocalidad($localidad){
        $this->localidad = $localidad;
    }
    public function setProvincia($provincia){
        $this->provincia = $provincia;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function setEmail($email){
        $this->email = $email;  
    }

}

?>