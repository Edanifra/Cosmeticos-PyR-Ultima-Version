<?php

function registrarBitacora($id_usuario, $nombre, $descrip, $tipo, $conn){

    $descripcion = "".$nombre." ".$descrip.".";

    $sql = @mysqli_query($conn,"INSERT INTO bitacora (descripcion, id_usuario, tipo) VALUES ('$descripcion','$id_usuario','$tipo')");

}

// ********************* PRODUCTOS ******************************

function buscarProducto($conn, $id_producto){

    $sql = @mysqli_query($conn,"SELECT * FROM producto WHERE id_producto = $id_producto");
    $result = @mysqli_num_rows($sql);

    if ($result > 0) {
        $datos = @mysqli_fetch_array($sql);
        return $datos;
    }else {
        echo "NO HAY ARTÍCULO PARA EL ID PROPORCIONADO";
    }

}

// ****************** CATEGORÍAS **************************
function buscarCategoria($conn){

    $sql = @mysqli_query($conn,"SELECT * FROM categoria_producto");
    return $sql;

}

function buscarCategoriaEspecifica($conn,$id){

    $sql = @mysqli_query($conn,"SELECT * FROM categoria_producto WHERE id_categoria = $id");
    $datos = @mysqli_fetch_array($sql);

    return $datos;
}

function buscarProductos($conn){
    $sql = @mysqli_query($conn,"SELECT * FROM producto");
    return $sql;
}

// CREAR UNA NOTIFICACIÓN PARA TODOS LOS CLIENTES
function crearNotificacionGeneral($conn, $descripcion) {
    // Escapar la descripción para evitar problemas de SQL
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    
    // Obtener todos los clientes
    $queryClientes = "SELECT id_cliente FROM cliente";
    $resultadoClientes = mysqli_query($conn, $queryClientes);
    if (!$resultadoClientes) {
        echo "Error al obtener clientes: " . mysqli_error($conn);
        return; // Salir de la función si hay un error
    }
    while ($cliente = mysqli_fetch_assoc($resultadoClientes)) {
        // Insertar notificación para cada cliente
        $cliente_id = $cliente['id_cliente'];
        $queryInsertar = "INSERT INTO notificaciones (id_usuario, descripcion, estado) VALUES ('$cliente_id', '$descripcion', 0)";
        
        // Imprimir la consulta para depuración
        // echo $queryInsertar; // Descomentar para ver la consulta
        
        if (!mysqli_query($conn, $queryInsertar)) {
            echo "Error al insertar notificación: " . mysqli_error($conn);
        }
    }
    exit;
}

function crearNotificacion($conn, $descripcion, $id_cliente) {
    // Escapar la descripción para evitar problemas de SQL
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    
    $query = mysqli_query($conn,"INSERT INTO notificaciones (descripcion, id_usuario)
                                                VALUES ('$descripcion','$id_cliente')");

    if ($query) {
        echo "notificación creada";
    }

    exit;
}

function contarRegistros($conn, $nombre_tabla){

    $sql = @mysqli_query($conn,"SELECT COUNT(*) as total_registro FROM $nombre_tabla");
    $resultado = @mysqli_fetch_array($sql);
    
    $total_registro = $resultado['total_registro'];
    return $total_registro;

}

function contarBusqueda($conn, $nombre_tabla, $busqueda){

    $rol = '';
    if ($busqueda == '') {
        # code...
    }

    $sql = @mysqli_query($conn,"SELECT COUNT(*) as total_registro FROM $nombre_tabla 
                                WHERE ( id_producto LIKE '%$busqueda%' OR
                                        nombre      LIKE '%$busqueda%' OR
                                        descripcion LIKE '%$busqueda%' OR
                                        id_producto LIKE '%$busqueda%' OR
                                        precio      LIKE '%$busqueda%')");
    $resultado = @mysqli_fetch_array($sql);
    
    $total_registro = $resultado['total_registro'];
    return $total_registro;

}

?>