<?php

    session_start();
    require "../../conexion.php";

    if (!empty($_POST['nombre']) && !empty($_POST['descripcion'])) {

        require "../../php/funciones/CRUDS.php";

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $sql = @mysqli_query($conn,"INSERT INTO categoria_producto (nombre_categoria,descripcion) VALUES ('$nombre','$descripcion')");

        if ($sql) {
            registrarBitacora($_SESSION['admin']['id_empleado'],$_SESSION['admin']['nombre'],"ha registrado una categoría","ENTRADA",$conn);
            header("location:../../vistas/categorias/listaCategorias.php");
        }else {
            echo "Error al registrar categoria";
        }

    }else {
        var_dump($_POST);
    }

?>