<?php
require('../../conexion.php');

// Verificar si se ha subido un archivo
if (isset($_FILES['cargar_excel_usu'])) {
    $file = $_FILES['cargar_excel_usu'];

    // Verificar la extensión del archivo
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (strtolower($ext) !== 'csv') {
        die('Error: El archivo debe ser un archivo CSV.');
    }

    // Verificar la codificación del archivo
    $content = file_get_contents($file['tmp_name']);
    if (!mb_check_encoding($content, 'UTF-8')) {
        die('Error: El archivo debe estar en formato UTF-8.');
    }

    // Procesar el archivo CSV
    $tipo       = $file['type'];
    $tamanio    = $file['size'];
    $archivotmp = $file['tmp_name'];
    $lineas     = file($archivotmp);
    $i = 0;
    
    foreach ($lineas as $linea) {
        $cantidad_registros = count($lineas);
        $cantidad_regist_agregados = ($cantidad_registros - 1);
        if ($i != 0) {
            $datos = explode(";", $linea);
            $usuario = !empty($datos[0]) ? ($datos[0]) : '';
            $nombre = !empty($datos[1]) ? ($datos[1]) : '';
            $apellido = !empty($datos[2]) ? ($datos[2]) : '';
            $rol = !empty($datos[3]) ? ($datos[3]) : '';
            $correo = !empty($datos[4]) ? ($datos[4]) : '';
            $telefono = !empty($datos[5]) ? ($datos[5]) : '';
            $pregunta = !empty($datos[6]) ? ($datos[6]) : '';
            $respuesta = !empty($datos[7]) ? ($datos[7]) : '';
            $clave = !empty($datos[8]) ? ($datos[8]) : '';

            if (!empty($cod_barra)) {
                $checkemail_duplicidad = ("SELECT * FROM empleado WHERE usuario ='" . ($usuario) . "' ");
                $ca_dupli = mysqli_query($conn, $checkemail_duplicidad);
                $cant_duplicidad = mysqli_num_rows($ca_dupli);
            }

            // No existe Registros Duplicados
            if ($cant_duplicidad == 0) {
                $insertarData = "INSERT INTO empleado( 
                    usuario,
                    nombre,
                    apellido,
                    rol,
                    correo,
                    clave,
                    telefono
                ) VALUES(
                    '$usuario',
                    '$nombre',
                    '$apellido',
                    2,
                    '$correo',
                    '$clave',
                    '$telefono'
                )";
                mysqli_query($conn, $insertarData);
            } 
            /** Caso Contrario actualizo el o los Registros ya existentes */
            else {
                $updateData = ("UPDATE empleado SET 
                    usuario='" . $usuario . "',
                    nombre='" . $nombre . "',
                    apellido='" . $apellido . "',
                    correo='" . $correo . "',
                    clave='" . $clave . "',
                    telefono='" . $telefono . "'
                ");
                $result_update = mysqli_query($conn, $updateData);
            }
        }
        $i++;
    }
} else {
    header("location:../../vistas/error_solicitud/");
}

header("location:../../vistas/usuarios/cargarCSV.php");
?>