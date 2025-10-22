<?php
require_once 'funciones.php';

$dni = $_GET['dni'];
$cliente = obtenerClientePorDni($dni);
$mensaje = "";

if ($_POST) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    
    if (!empty($nombre) && !empty($email)) {
        if (actualizarCliente($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email)) {
            header("Location: index.php");
            exit;
        }
    } else {
        $mensaje = "Los campos Nombre y Email son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>

    <?php if ($mensaje != "") { ?>
        <p style="color: red;"><?php echo $mensaje; ?></p>
    <?php } ?>
    
    <?php if ($cliente) { ?>
        <form method="POST">
            DNI: <input type="text" value="<?php echo $cliente->getDni(); ?>" disabled><br>
            Nombre: <input type="text" name="nombre" value="<?php echo $cliente->getNombre(); ?>" required><br>
            Dirección: <input type="text" name="direccion" value="<?php echo $cliente->getDireccion(); ?>"><br>
            Localidad: <input type="text" name="localidad" value="<?php echo $cliente->getLocalidad(); ?>"><br>
            Provincia: <input type="text" name="provincia" value="<?php echo $cliente->getProvincia(); ?>"><br>
            Teléfono: <input type="text" name="telefono" value="<?php echo $cliente->getTelefono(); ?>"><br>
            Email: <input type="email" name="email" value="<?php echo $cliente->getEmail(); ?>" required><br>
            <button type="submit">Guardar Cambios</button>
        </form>
    <?php } ?>

    <br>
    <a href="index.php">Volver al listado</a>
</body>
</html>