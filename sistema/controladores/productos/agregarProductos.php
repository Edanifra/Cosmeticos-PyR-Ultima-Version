<?php
session_start();
require "../../conexion.php";

if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio'])
    && !empty($_POST['stock_min']) && !empty($_POST['stock_max']) && !empty($_POST['categoria'])) {
    
    require "../../php/funciones/CRUDS.php";

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock_min = $_POST['stock_min'];
    $stock_max = $_POST['stock_max'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];

    // Manejo de la carga de la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileSize = $_FILES['foto']['size'];
        $fileType = $_FILES['foto']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validar la extensión del archivo
        $allowedfileExtensions = array('jpg', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Directorio donde se guardará la imagen
            $uploadFileDir = '../../imagenes/productos/';
            $dest_path = $uploadFileDir . $fileName;

            // Verificar si el directorio existe, si no, crearlo
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true); // Crear el directorio con permisos
            }

            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Guardar la ruta de la imagen en la base de datos
                $sql = @mysqli_query($conn, "INSERT INTO producto (nombre, descripcion, precio, stock, stock_min, stock_max, id_categoria, marca, imagen)
                                            VALUES ('$nombre', '$descripcion', $precio, 0, $stock_min, $stock_max, '$categoria', '$marca', '$fileName')");
                if ($sql) {
                    registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha registrado un producto", "ENTRADA", $conn);
                    header("location:../../vistas/productos/listaProductos.php");
                } else {
                    echo "Error al registrar producto";
                }
            } else {
                echo "Error al mover el archivo a la carpeta de destino.";
            }
        } else {
            echo "Tipo de archivo no permitido. Solo se permiten imágenes JPG, PNG y JPEG.";
        }
    } else {
        echo "No se ha subido ninguna imagen o ha ocurrido un error.";
    }
} else {
    var_dump($_POST);
}
?>