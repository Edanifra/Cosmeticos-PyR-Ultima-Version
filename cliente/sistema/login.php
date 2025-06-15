<?php

    require "conexion.php";

    session_start();

    $alert = '';

    if (!empty($_SESSION['cliente']['activo'])) {
        header("location: landing/index.php");
        exit();
    } else {
        if (!empty($_POST)) {
            if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {

                $user = $_POST['usuario'];
                $clave = $_POST['clave'];

                $sql = @mysqli_query($conn,"SELECT * FROM cliente WHERE usuario = '$user' AND clave = '$clave'");
                $result = mysqli_num_rows($sql);

                if ($result > 0) {

                    $datos = mysqli_fetch_assoc($sql);
                    
                    $_SESSION['cliente']['activo'] = true;
                    $_SESSION['cliente']['id_usuario'] = $datos['id_cliente'];
                    $_SESSION['cliente']['nombre'] = $datos['nombre'];
                    $_SESSION['cliente']['apellido'] = $datos['apellido'];
                    $_SESSION['cliente']['correo'] = $datos['correo'];
                    $_SESSION['cliente']['usuario'] = $datos['usuario'];
                    $_SESSION['cliente']['clave'] = $datos['clave'];
                    $_SESSION['cliente']['foto'] = $datos['foto'];
                    $_SESSION['cliente']['telefono'] = $datos['telefono'];

                    header("location:perfil.php");

                }else {
                    $alert = '<p class="msg_error">Usuario o Contraseña Incorrecta</p>';
                }
                
            }else {
                $alert = '<p class="msg_error">Todos los campos deben estar llenos</p>';
            }
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

    <div class="wrapper3">
        <h1>Iniciar sesión</h1>
        <form action="" method="POST">
            
            <div>
                <div class="input_box">
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" required>
                    <i class='bx bx-user'></i>
                </div>

                <div class="input_box">
                    <input type="password" name="clave" id="clave" placeholder="Clave" required>
                    <i class='bx bx-list-ul'></i>
                </div>

                <?php 
                
                if ($alert != '') {
                    echo $alert;
                }
                
                ?>
            </div>
            
            <button type="submit" class="btn">Iniciar Sesión</button>

            <div class="register_link">
                <p>¿Aún no tiene una cuenta? <a href="registro.php">¡Regístrese!</a></p>
            </div>

            <p style="font-size: 8pt; margin-top: 5em; color: black; text-align:center;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>
    
</body>
</html>