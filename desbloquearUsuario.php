<?php

    session_start();
    $alert = '';

    if (!empty($_SESSION['admin']['activo'])) {
        header("location: sistema/vistas/dashboard/");
    }else {
        if (!empty($_POST['correo'])) {

            require "conexion.php";
            
            $correo = $_POST['correo'];

            $consulta = @mysqli_query($conn,"SELECT * FROM empleado WHERE correo = '$correo'");
            $resultado = mysqli_num_rows($consulta);

            if ($resultado <= 0) {
                header("location:bloqueado.php");
            }
            
        }else {
            header("location:bloqueado.php");
        }
    }

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>
<body>

    <div class="wrapper">
        <form action="unblock.php" method="POST">
            <h1>Seguridad</h1>
            <p>Por favor, responda a su pregunta de seguridad para desbloquear su usuario</p>
            <?php 
            
                while ($data = mysqli_fetch_array($consulta)) {
            
            ?>

            <div class="input_box">
                <input style="background:rgba(255, 255, 255, 0.2);" type="text" name="pregunta" id="pregunta" value="<?php echo $data['pregunta']; ?>" readonly>
                <i class='bx bx-question-mark'></i>
            </div>

            <?php 
            
                }
            
            ?>


            <div class="input_box">
                <input type="text" name="respuesta" id="respuesta" placeholder="Firulais..." required>
                <i class='bx bx-list-ul' ></i>
            </div>

            <input type="hidden" name="correo" value="<?php echo $correo; ?>">

            <?php
            
            if ($alert != '') {
                echo $alert;
            }
            
            ?>

            <button type="submit" class="btn">Enviar</button>

            <p style="font-size: 8pt; margin-top: 5em; color: black;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>

</body>
</html>