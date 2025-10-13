<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: tienda.php");
    exit();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Autentificación PHP</title>
    </head>
    <body>
        <h1>Autentificación PHP</h1>
        <form action="control.php" method="POST">
        <table>
            <tr>
            <td colspan="2" align="center"
            <?php if (isset($_GET["errorusuario"]) && $_GET["errorusuario"] == "si") { ?>
            bgcolor="red"><span style="color:#ffffff"><b>Datos incorrectos</b></span>
            <?php } else { ?>
            bgcolor="#cccccc">Introduce tu clave de acceso
            <?php } ?>
            </td>
            </tr>
            <tr>
            <td align="right">Usuario:</td>
            <td><input type="text" name="usuario" size="8" maxlength="50"></td>
            </tr>
            <tr>
            <td align="right">Contraseña:</td>
            <td><input type="password" name="contrasenya" size="8" maxlength="50"></td>
            </tr>
            <tr>
            <td colspan="2" align="center"><input type="submit" value="ENTRAR"></td>
            </tr>
        </table>
        </form>
    </body>
</html>
