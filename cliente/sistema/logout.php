<?php
    require "conexion.php";
    
    session_start();
    $_SESSION['cliente']['activo'] = false;

    header("location: catalogo.php");
?>