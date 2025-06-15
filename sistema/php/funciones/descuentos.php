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
    
function obtenerOferta($id_producto, $conn){
    
    $sql = mysqli_query($conn,"SELECT porcentaje_descuento FROM descuentos WHERE id_producto = '$id_producto'");
    
    $porcentaje = mysqli_fetch_assoc($sql);
    $descuento = $porcentaje['porcentaje_descuento'];
    return number_format($descuento);

}

?>