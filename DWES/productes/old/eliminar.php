<?php
include "funciones.php";
$archivo = "productos.csv";
$productos = leerProductos($archivo);

$id = $_GET["id"];
$productos = array_filter($productos, function($p) use ($id){
    return $p["id"] != $id;
});

guardarProductos($archivo, $productos);
header("Location: index.php");
exit;
?>
