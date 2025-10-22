<?php
require_once 'funciones.php';
$clientes = obtenerClientes();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
</head>

<body>
    <h1>Listado de Clientes</h1>

    <a href="clientenuevo.php">Nuevo Cliente</a><br><br>

    <table>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Localidad</th>
            <th>Provincia</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($clientes as $cli): ?>
            <tr>
                <td><?php echo htmlspecialchars($cli->getDni()); ?></td>
                <td><?php echo htmlspecialchars($cli->getNombre()); ?></td>
                <td><?php echo htmlspecialchars($cli->getDireccion()); ?></td>
                <td><?php echo htmlspecialchars($cli->getLocalidad()); ?></td>
                <td><?php echo htmlspecialchars($cli->getProvincia()); ?></td>
                <td><?php echo htmlspecialchars($cli->getTelefono()); ?></td>
                <td><?php echo htmlspecialchars($cli->getEmail()); ?></td>
                <td>
                    <a href="editarcliente.php?dni=<?php echo urlencode($cli->getDni()); ?>">Editar</a> |
                    <a href="borrarcliente.php?dni=<?php echo urlencode($cli->getDni()); ?>">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>