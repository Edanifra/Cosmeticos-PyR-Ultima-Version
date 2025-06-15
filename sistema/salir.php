<?php
    require "conexion.php";
    require "php/funciones/CRUDS.php";
    
    session_start();
    registrarBitacora($_SESSION['admin']['id_empleado'],$_SESSION['admin']['nombre'],"ha cerrado sesión","SALIDA",$conn);
    $_SESSION['admin']['activo'] = false;

    header("location: ../");
?>