<?php
include("funciones.php"); // Incluye el archivo de funciones


$dni = $_GET['dni']; // Obtiene el DNI del cliente a borrar
$cliente = obtenerClientePorDni($dni);


//Mensaje de aviso si el cliente no existe
if ($cliente == null) {
    echo "Cliente no encontrado.";
}

if ($_POST) {
    if (isset($_POST['confirmar'])) {
        try {
            if (borrarCliente($dni)) {
                echo "Cliente borrado correctamente.";
                header("Location: index.php");

            } else {
                echo "Error al borrar el cliente.";
            }
        } catch (Exception $e) {
            echo "Error al borrar el cliente: " . $e->getMessage();
        }
    } else{
        header("Location: index.php"); // Redirige a la página principal si se cancela
    }
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar Cliente</title>
</head>

<body>
    <h1>Eliminar Cliente</h1>
    <p>¿Desea eliminar el cliente <strong><?php echo $cliente->getNombre(); ?></strong>?</p>

    <form method="POST">
        <button type="submit" name="confirmar">Sí, eliminar</button>
        <button type="submit" name="cancelar">Cancelar</button>
    </form>
</body>

</html>