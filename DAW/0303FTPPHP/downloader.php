<?php
// Càrrega de la configuració des de config.ini
$config = parse_ini_file("config.ini");
$server = $config['ftp_server'];
$user = $config['ftp_user'];
$pass = $config['ftp_pass'];
$remoteDir = $config['remote_dir'];
$localDir = rtrim($config['local_dir'], '/');
$passive = (bool)$config['ftp_passive'];


echo "Connectant al servidor FTP...\n";
$ftp = ftp_ssl_connect($server);
if (!$ftp) {
die("Error: no es pot connectar al servidor FTP.\n");
}


if (!ftp_login($ftp, $user, $pass)) {
die("Error: usuari o contrasenya incorrectes.\n");
}


echo "Connexió correcta!\n";
ftp_pasv($ftp, $passive);


// Comprovar que el directori existeix
if (!ftp_chdir($ftp, $remoteDir)) {
die("Error: el directori remot '$remoteDir' no existeix.\n");
}


echo "Llegint directori remot...\n";
$files = ftp_nlist($ftp, ".");


if (!$files || count($files) == 0) {
die("No hi ha fitxers per descarregar.\n");
}


if (!is_dir($localDir)) {
mkdir($localDir, 0777, true);
}


$success = 0;
$fail = 0;


foreach ($files as $file) {
echo "Descarregant: $file ... ";
$localPath = $localDir . '/' . $file;


if (ftp_get($ftp, $localPath, $file, FTP_BINARY)) {
echo "OK. Eliminant del servidor... ";
if (ftp_delete($ftp, $file)) {
echo "Esborrat.\n";
$success++;
} else {
echo "ERROR en eliminar.\n";
$fail++;
}
} else {
echo "ERROR en descarregar.\n";
$fail++;
}
}


echo "\n--- RESUM ---\n";
echo "Correctes: $success\n";
echo "Fallits: $fail\n";
ftp_close($ftp);
?>