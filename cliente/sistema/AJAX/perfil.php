<?php
session_start();
include '../conexion.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

if (!empty($_POST)) {
    if (!empty($_POST['id_cliente'])) {
        $id_cliente = $_POST['id_cliente'];
        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $tipo_foto = $foto['type'];
        $url_temp = $foto['tmp_name'];
        $img_perfil = "img/perfil/homo.jpg"; // Imagen por defecto

        if ($nombre_foto != '') {
            $destino = '../img/perfil/usuario-' . $id_cliente . '/';
            // Verifica si el directorio existe, si no, créalo
            if (!file_exists($destino)) {
                mkdir($destino, 0777, true); // Crea el directorio con permisos adecuados
            }

            // Consulta para obtener la ruta de la imagen actual
            $query = mysqli_query($conn, "SELECT foto FROM cliente WHERE id_cliente = $id_cliente");
            $result = mysqli_fetch_assoc($query);
            $foto_actual = $result['foto'];

            // Si hay una foto actual, eliminarla
            if (!empty($foto_actual)) {
                $foto_a_eliminar = $destino . $foto_actual;
                if (file_exists($foto_a_eliminar)) {
                    unlink($foto_a_eliminar); // Elimina la imagen anterior
                }
            }

            // Genera un nuevo nombre para la imagen
            $img_nombre = 'img_' . md5(date('d-m-Y H:m:s')) . '.jpg'; // Asegúrate de que el nombre tenga extensión
            $src = $destino . $img_nombre;

            // Actualiza la base de datos con la ruta completa de la nueva imagen
            $query = mysqli_query($conn, "UPDATE cliente SET foto = '$img_nombre' WHERE id_cliente = $id_cliente");
            if ($query) {
                // Mueve el archivo solo si la consulta fue exitosa
                if (move_uploaded_file($url_temp, $src)) {
                    echo "yay"; // Archivo subido correctamente
                } else {
                    echo "Error al mover el archivo.";
                }
            } else {
                echo "negativo"; // Error en la consulta
            }
        }
    }
    exit;
}
?>