<?php
session_start();
    $_SESSION = array(); // Borramos el contenido de la sesion

    // Borra la cookie que almacena la sesión
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000);
    }

    session_destroy();  // Destruye la sesión
?>
<html>
    <head>
        <title>Has salido!!</title>
    </head>
    <body>
        Gracias por tu acceso
        <br>
        <br>
        <a href="login.php">Login</a>
    </body>
</html>

