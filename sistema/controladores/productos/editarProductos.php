<?php
session_start();
require "../../conexion.php";

if (!empty($_POST['cod_barra']) && !empty($_POST['nombre']) && !empty($_POST['descripcion']) && 
    !empty($_POST['precio']) && !empty($_POST['stock_min']) && !empty($_POST['marca']) &&
    !empty($_POST['stock_max']) && !empty($_POST['categoria']) && !empty($_POST['id_producto'])) {
    
    require "../../php/funciones/CRUDS.php";
    
    $cod_barra = $_POST['cod_barra'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $marca = $_POST['marca'];
    $stock_min = $_POST['stock_min'];
    $stock_max = $_POST['stock_max'];
    $categoria = $_POST['categoria'];
    $id_producto = $_POST['id_producto'];

    // Inicializa la variable de imagen
    $imagen = null;

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        // Obtener el nombre de la imagen anterior
        $imagen_prev_query = mysqli_query($conn, "SELECT imagen FROM producto WHERE id_producto = $id_producto");
        $img_prev = mysqli_fetch_assoc($imagen_prev_query);
        $imagen_anterior = $img_prev['imagen'];

        // Eliminar la imagen anterior del servidor
        if (!empty($imagen_anterior)) {
            $ruta_imagen_anterior = '../../imagenes/productos/' . $imagen_anterior;
            if (file_exists($ruta_imagen_anterior)) {
                unlink($ruta_imagen_anterior);
            }
        }

        // Procesar la nueva imagen
        $nombre_archivo_nuevo = basename($_FILES['imagen']['name']);
        $ruta_destino = '../../imagenes/productos/' . $nombre_archivo_nuevo;

        // Validar tipo de archivo
        $tipo_imagen = pathinfo($ruta_destino, PATHINFO_EXTENSION);
        $tipos_permitidos = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($tipo_imagen, $tipos_permitidos)) {
            header("location:../../vistas/error_solicitud/");
            exit();
        }

        // Mover el archivo subido a la carpeta correspondiente
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            $imagen = $nombre_archivo_nuevo; // Asignar el nuevo nombre de imagen
        } else {
            header("location:../../vistas/error_solicitud/");
            exit();
        }
    } else {
        // Si no se subió una nueva imagen, mantenemos la anterior
        $imagen_prev = mysqli_query($conn, "SELECT imagen FROM producto WHERE id_producto = $id_producto");
        $img_prev = mysqli_fetch_assoc($imagen_prev);
        $imagen = $img_prev['imagen'];
    }

    // Comprobar si el código de barras ya existe
    $barras = mysqli_query($conn, "SELECT * FROM producto WHERE cod_barra = '$cod_barra' AND id_producto != $id_producto");
    $result_barras = mysqli_num_rows($barras);
    if ($result_barras > 0) {
        header("location:../../vistas/error_solicitud/");
        exit();
    } else {
        // Actualizar el producto
        $sql = mysqli_query($conn, "UPDATE producto SET cod_barra = '$cod_barra', nombre = '$nombre', descripcion = '$descripcion', 
                                    precio = '$precio', stock = '$stock', stock_min = '$stock_min', marca = '$marca',
                                    stock_max = '$stock_max', id_categoria = '$categoria', imagen = '$imagen'
                                    WHERE id_producto = '$id_producto'");
        if ($sql) {
            header("location:../../vistas/productos/listaProductos.php");
            registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha editado un producto", "SALIDA", $conn);
            exit();
        } else {
            header("location:../../vistas/error_solicitud/");
            exit();
        }
    }
} else {
    header("location:../../vistas/error_solicitud/");
    exit();
}
?>