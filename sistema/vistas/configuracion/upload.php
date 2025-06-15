<?php
// Conexión a la base de datos
include '../../conexion.php'; // Asegúrate de incluir tu archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_imagen = $_POST['tipo_imagen']; // tipo de imagen (logo, img_landing_1, img_landing_2, img_landing_3, publicidad_detalle)
    $id = $_POST['id']; // ID del registro que se va a actualizar
    $directorio = $_POST['directorio']; // Directorio donde se guardarán las imágenes

    // Eliminar la imagen anterior de la base de datos
    $query = "SELECT $tipo_imagen FROM tienda WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Eliminar la imagen física si existe
    if ($row[$tipo_imagen]) {
        unlink($directorio . $row[$tipo_imagen]);
    }

    // Cargar la nueva imagen
    $nombre_archivo = basename($_FILES['imagen']['name']);
    $ruta_archivo = $directorio . $nombre_archivo;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo)) {
        // Actualizar el nombre de la imagen en la base de datos
        $query = "UPDATE tienda SET $tipo_imagen = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $nombre_archivo, $id);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Imagen cargada y actualizada']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al cargar la imagen']);
    }
}
?>