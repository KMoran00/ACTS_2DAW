<?php
include "funciones.php";
$archivo = "productos.csv";
$productos = leerProductos($archivo);

$id = $_GET["id"];
$producto = null;

foreach ($productos as $p) {
    if ($p["id"] == $id) {
        $producto = $p;
        break;
    }
}

if(!$producto) die("Producto no encontrado.");

if(isset($_POST["guardar"])){
    foreach ($productos as &$p) {
        if ($p["id"] == $id) {
            $p["nombre"] = $_POST["nombre"];
            $p["precio"] = $_POST["precio"];
            $p["descripcion"] = $_POST["descripcion"];
        }
    }
    guardarProductos($archivo, $productos);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= $producto["nombre"] ?>" required><br>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="<?= $producto["precio"] ?>" required><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion"><?= $producto["descripcion"] ?></textarea><br><br>
        <button type="submit" name="guardar">Actualizar</button>
    </form>
    <p><a href="index.php">⬅️ Volver</a></p>
</body>
</html>
