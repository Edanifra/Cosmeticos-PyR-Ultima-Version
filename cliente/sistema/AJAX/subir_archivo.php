<?php
session_start();
require "../conexion.php";

// Verifica si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si el archivo fue subido sin errores
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] == 0) {
        $directorio = '../img/comprobantes/usuario-'.$_SESSION['cliente']['id_usuario'].'/pedido-'.$_REQUEST['id_pedido'].'/'; // Carpeta donde se guardarán los archivos
        $archivo = $_FILES['comprobante'];
        $nombreArchivo = $archivo['name'];
        $rutaDestino = $directorio . basename($archivo['name']);
        $id_pedido = $_REQUEST['id_pedido'];

        $actualizar_estado = mysqli_query($conn,"UPDATE pedido SET estado_pedido = 4 WHERE id_pedido = $id_pedido");

        // Crea el directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $guardarFoto = mysqli_query($conn,"UPDATE pedido SET comprobante = '$nombreArchivo' WHERE id_pedido = $id_pedido");

        // Mueve el archivo a la carpeta de destino
        if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            echo 'Archivo subido exitosamente a ' . $id_pedido;
        } else {
            echo 'Error al mover el archivo.';
        }
    } else {
        echo 'Error al subir el archivo.';
    }
} else {
    echo 'Método de solicitud no válido.';
}
?>