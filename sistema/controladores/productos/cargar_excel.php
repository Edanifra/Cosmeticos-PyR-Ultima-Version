<?php
require('../../conexion.php');

// Verificar si se ha subido un archivo
if (isset($_FILES['cargar_excel'])) {
    $file = $_FILES['cargar_excel'];

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
            $cod_barra = !empty($datos[0]) ? ($datos[0]) : '';
            $nombre = !empty($datos[1]) ? ($datos[1]) : '';
            $descripcion = !empty($datos[2]) ? ($datos[2]) : '';
            $precio = !empty($datos[3]) ? ($datos[3]) : '';
            $stock_min = !empty($datos[4]) ? ($datos[4]) : '';
            $stock_max = !empty($datos[5]) ? ($datos[5]) : '';
            $marca = !empty($datos[6]) ? ($datos[6]) : '';

            if (!empty($cod_barra)) {
                $checkemail_duplicidad = ("SELECT cod_barra FROM producto WHERE cod_barra ='" . ($cod_barra) . "' ");
                $ca_dupli = mysqli_query($conn, $checkemail_duplicidad);
                $cant_duplicidad = mysqli_num_rows($ca_dupli);
            }

            // No existe Registros Duplicados
            if ($cant_duplicidad == 0) {
                $insertarData = "INSERT INTO producto( 
                    cod_barra,
                    nombre,
                    descripcion,
                    precio,
                    stock,
                    stock_min,
                    stock_max,
                    id_categoria,
                    marca
                ) VALUES(
                    '$cod_barra',
                    '$nombre',
                    '$descripcion',
                    '$precio',
                    0,
                    '$stock_min',
                    '$stock_max',
                    8,
                    '$marca'
                )";
                mysqli_query($conn, $insertarData);
            } 
            /** Caso Contrario actualizo el o los Registros ya existentes */
            else {
                $updateData = ("UPDATE producto SET 
                    nombre='" . $nombre . "',
                    descripcion='" . $descripcion . "',
                    precio='" . $precio . "',
                    stock_min='" . $stock_min . "',
                    stock_max='" . $stock_max . "',
                    marca='" . $marca . "'
                    WHERE cod_barra = '" . $cod_barra . "'
                ");
                $result_update = mysqli_query($conn, $updateData);
            }
        }
        $i++;
    }
} else {
    echo 'No se ha subido ningún archivo.';
}

header("location:../../vistas/productos/cargarCSV.php");
?>