<?php

function verificarOferta($id_producto,$conn){

    $sql = mysqli_query($conn,"SELECT * FROM descuentos WHERE id_producto = '$id_producto'");

    $result = mysqli_num_rows($sql);

    if ($result > 0) {
        return true;
    }else {
        return false;
    }
}

function contarRegistrosEspecificos($conn, $nombre_tabla, $nombre_campo, $id_usuario){

    $sql = @mysqli_query($conn,"SELECT COUNT(*) as total_registro FROM $nombre_tabla WHERE $nombre_campo = $id_usuario");
    $resultado = @mysqli_fetch_array($sql);
    
    $total_registro = $resultado['total_registro'];
    return $total_registro;

}

function contarRegistros($conn, $nombre_tabla){

    $sql = @mysqli_query($conn,"SELECT COUNT(*) as total_registro FROM $nombre_tabla");
    $resultado = @mysqli_fetch_array($sql);
    
    $total_registro = $resultado['total_registro'];
    return $total_registro;

}

function obtenerOferta($id_producto, $conn){

    $sql = mysqli_query($conn,"SELECT porcentaje_descuento FROM descuentos WHERE id_producto = '$id_producto'");

    $porcentaje = mysqli_fetch_assoc($sql);
    $descuento = $porcentaje['porcentaje_descuento'];
    return number_format($descuento);
    
}

function obtenerPrecioViejo($id_producto, $conn){
    $sql = mysqli_query($conn,"SELECT precio_anterior FROM descuentos WHERE id_producto = '$id_producto'");
    $result = mysqli_fetch_assoc($sql);

    $precio_viejo = $result['precio_anterior'];
    return $precio_viejo;
}

?>