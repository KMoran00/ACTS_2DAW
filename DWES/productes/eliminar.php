<?php
require_once 'conexion.class.php';
require_once 'producto.class.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $conexion = Conexion::conectarBD();
    
    Producto::eliminarProducto($conexion, $id);
    Conexion::desconectarBD($conexion);
}

header("Location: index.php");
exit;
?>
