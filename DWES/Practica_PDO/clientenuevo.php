<?php
require_once 'funciones.php'; // Incluye el archivo de funciones

$mensaje = "";

if ($_POST) {
    // Obtener los datos del formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    if (preg_match('/^[0-9]{8}[A-Za-z]$/', $dni) && !empty($nombre) && !empty($email)) {
        try {
            if (insertarCliente($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email)) {
                $mensaje = "Cliente insertado correctamente.";
                header("Location: index.php");
            } else {
                $mensaje = "Error al insertar el cliente. DNI ya existente";
            }
        } catch (Exception $e) {
            $mensaje = "Error al insertar el cliente: " . $e->getMessage();
        }

    } else {
        $mensaje = "DNI no válido vuelva a intentarlo";

    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Cliente</title>
</head>

<body>
    <h1>Registrar nuevo Cliente</h1>

    <?php if ($mensaje != "") { ?>
        <p style="color: red;"><?php echo $mensaje; ?></p>
    <?php } ?>

    <form action="$_REQUEST['PHP_SELF']">
        DNI: <input type="text" name="dni" maxlength="9" required><br>
        Nombre: <input type="text" name="nombre" required><br>
        Dirección: <input type="text" name="direccion"><br>
        Localidad: <input type="text" name="localidad"><br>
        Provincia: <input type="text" name="provincia"><br>
        Teléfono: <input type="text" name="telefono"><br>
        Email: <input type="email" name="email" required><br>
        <button type="submit">Guardar Cliente</button>
    </form>

    <br>
    <a href="index.php">Volver al listado</a>
</body>

</html>

