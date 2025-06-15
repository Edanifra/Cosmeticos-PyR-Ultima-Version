<?php

    session_start();
    require "../../conexion.php";
    require "../../php/funciones/CRUDS.php";

    if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['id_categoria'])) {

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_categoria = $_POST['id_categoria'];

        $sql = @mysqli_query($conn,"UPDATE categoria_producto SET nombre_categoria = '$nombre', descripcion = '$descripcion' 
                                    WHERE id_categoria = $id_categoria");

        if ($sql) {
            header("location:../../vistas/categorias/listaCategorias.php");
            registrarBitacora($_SESSION['admin']['id_empleado'],$_SESSION['admin']['nombre'],"ha editado una categoría","SALIDA",$conn);
        }else {
            echo "Error al editar la categoría";
        }

    }else {
        header("location: ../../vistas/categorias/listaCategorias.php");
    }

?>