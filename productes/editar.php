<?php
require_once 'conexion.class.php';
require_once 'producto.class.php';

$conexion = Conexion::conectarBD();

$id = $_GET['id'] ?? null;
$producto = Producto::buscarPorId($conexion, $id);

if (!$producto) {
    echo"Producto no encontrado.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto->setName($_POST['nombre']);
    $producto->setPrice($_POST['precio']);
    $producto->setDescription($_POST['descripcion']);
    $producto->setFamilyId($_POST['familia_id']);
    $producto->actualizarProducto($conexion);

    Conexion::desconectarBD($conexion);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/estilos.css">

</head>

<body>
    <h2>Editar Producto</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto->getName()) ?>" required><br>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto->getPrice()) ?>"
            required><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion"><?= htmlspecialchars($producto->getDescription()) ?></textarea><br>
        <label>ID Familia:</label><br>
        <input type="number" name="familia_id" value="<?= htmlspecialchars($producto->getFamilyId()) ?>"
            required><br><br>
        <button type="submit">Actualizar</button>
        <button class="volver" type="button" onclick="window.location.href='index.php'">Volver</button>

    </form>
</body>

</html>