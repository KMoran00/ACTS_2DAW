<?php
require_once 'conexion.class.php';
require_once 'producto.class.php';

function obtenerProductos()
{
    $conexion = Conexion::conectarBD();

    $consulta = "SELECT * FROM Product ORDER BY id";
    $stmt = $conexion->query($consulta);

    $productos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productos[] = new Producto(
            $row['id'],
            $row['name'],
            $row['price'],
            $row['description'],
            $row['family_id']
        );
    }

    Conexion::desconectarBD($conexion);
    return $productos;
}
?>
