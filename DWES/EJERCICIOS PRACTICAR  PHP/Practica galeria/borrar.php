<?php
// Obtener el nombre del archivo enviado por POST
$archivo = $_POST["archivo"];
$ruta = "uploads/" . $archivo;

// Verificar que el archivo exista y borrarlo
if (file_exists($ruta)) {
    unlink($ruta); // Eliminar el archivo
}

header("Location: index.php");
exit;
?>