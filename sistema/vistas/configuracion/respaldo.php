<?php
// Configuración de la base de datos
$host = 'localhost';
$user = 'root';  // Cambia esto si tu usuario es diferente
$password = '';  // Cambia esto si tienes una contraseña
$dbname = 'boutique';  // Cambia esto por el nombre de tu base de datos

// Ruta donde se guardará el respaldo
$backup_file = 'backups/' . $dbname . '_' . date('Y-m-d_H-i-s') . '.sql';

// Crear la carpeta de backups si no existe
if (!file_exists('backups')) {
    mkdir('backups', 0777, true);
}

// Comando mysqldump
$command = "C:\\xampp\\mysql\\bin\\mysqldump --user=$user --password=$password --host=$host --routines $dbname > $backup_file";

// Ejecutar el comando
system($command, $output);

// Comprobar si el archivo fue creado
if (file_exists($backup_file)) {
    // Forzar la descarga del archivo
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($backup_file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file));
    flush(); // Limpia el buffer del sistema
    readfile($backup_file);
    exit;
} else {
    http_response_code(500);
    echo 'Error al crear el backup';
}
?>