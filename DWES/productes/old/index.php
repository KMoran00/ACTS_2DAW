<?php
include "funciones.php";
$archivo = "productos.csv";
$productos = leerProductos($archivo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Productos (CSV)</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        a { margin: 5px; text-decoration: none; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Lista de Productos</h2>
    <p style="text-align:center;"><a href="crear.php">➕ Agregar Producto</a></p>
    <table>
        <tr>
            <th>ID</th><th>Nombre</th><th>Precio</th><th>Descripción</th><th>Acciones</th>
        </tr>
        <?php foreach($productos as $p): ?>
        <tr>
            <td><?= $p["id"] ?></td>
            <td><?= $p["nombre"] ?></td>
            <td><?= $p["precio"] ?></td>
            <td><?= $p["descripcion"] ?></td>
            <td>
                <a href="editar.php?id=<?= $p["id"] ?>">✏️ Editar</a>
                <a href="eliminar.php?id=<?= $p["id"] ?>" onclick="return confirm('¿Eliminar?')">🗑️ Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
