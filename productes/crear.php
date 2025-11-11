<?php
require_once 'conexion.class.php';
require_once 'producto.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = Conexion::conectarBD();

    $nuevo = new Producto(
        null,
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['descripcion'],
        $_POST['familia_id']
    );

    $nuevo->guardarProducto($conexion);
    Conexion::desconectarBD($conexion);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir Producto</title>
    <link rel="stylesheet" href="css/estilos.css">

</head>

<body>
    <h2>Añadir Producto</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br>
        <label>ID Familia:</label><br>
        <input type="number" name="familia_id" required><br><br>
        <button type="submit">Guardar</button>
        <button class="volver" type="button" onclick="window.location.href='index.php'">Volver</button>
    </form>


</body>

</html>