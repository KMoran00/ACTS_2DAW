<?php
require_once 'conexion.class.php';
require_once 'producto.class.php';
require_once 'funciones.php';

// Obtenemos todos los productos
$productes = obtenerProductos();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CRUD Productos PDO</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/55940ae555.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="encabezado">
        <h2>Lista de Productos</h2>
        <div class="acciones-superiores">
            <a href="#" class="carrito-icono"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>

    <div class="enlace-centrado">
        <a href="crear.php">Añadir Producto</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Familia</th>
            <th>Acciones</th>
        </tr>

        <?php if (!empty($productes)): ?>
            <?php foreach ($productes as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->getId()) ?></td>
                    <td><?= htmlspecialchars($p->getName()) ?></td>
                    <td><?= htmlspecialchars($p->getPrice()) ?></td>
                    <td><?= htmlspecialchars($p->getDescription()) ?></td>
                    <td><?= htmlspecialchars($p->getFamilyId()) ?></td>
                    <td>
                        <a href="editar.php?id=<?= urlencode($p->getId()) ?>">Editar</a> |
                        <a href="eliminar.php?id=<?= urlencode($p->getId()) ?>"
                            onclick="return confirm('¿Desea eliminar este producto?');">Eliminar</a> |


                        <button class="carrito" type="button" onclick="window.location.href='index.php'">Añadir al
                            carrito</button>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay productos registrados.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>