<?php
include "funciones.php";
$archivo = "productos.csv";
$productos = leerProductos($archivo);

if(isset($_POST["guardar"])){
    $nuevo = [
        "id" => siguienteId($productos),
        "nombre" => $_POST["nombre"],
        "precio" => $_POST["precio"],
        "descripcion" => $_POST["descripcion"]
    ];
    $productos[] = $nuevo;
    guardarProductos($archivo, $productos);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar Producto</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br><br>
        <button type="submit" name="guardar">Guardar</button>
    </form>
    <p><a href="index.php">⬅️ Volver</a></p>
</body>
</html>
 