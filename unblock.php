<?php

    if (!empty($_POST['respuesta']) && !empty($_POST['correo'])) {

        require "conexion.php";

        $respuesta = $_POST['respuesta'];
        $pregunta = $_POST['pregunta'];
        $correo = $_POST['correo'];
        
        $sql = @mysqli_query($conn,"SELECT * FROM empleado WHERE correo = '$correo' AND pregunta = '$pregunta' 
        AND respuesta = '$respuesta'");

        $resultado = mysqli_num_rows($sql);

        if ($resultado > 0) {
            
            $sql = @mysqli_query($conn,"UPDATE empleado SET intentos = 0 WHERE correo = '$correo'");
            header("location: index.php");

        }else{
            header("location: desbloquearUsuario.php");
        }
        
    }else {
        header("location: bloqueado.php");
    }

?>