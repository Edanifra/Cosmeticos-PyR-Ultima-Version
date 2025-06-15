<?php

    session_start();
    require "conexion.php";
    $alert = '';

    if (!empty($_SESSION['admin']['activo'])) {
        header("location: sistema/vistas/dashboard/");
    }else{
        if (!empty($_POST)) {
            
            if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {

                $usuario = $_POST['usuario'];

                $sql = @mysqli_query($conn,"SELECT intentos FROM empleado WHERE usuario = '$usuario'");

                while ($data = @mysqli_fetch_array($sql)) {
                    
                    if ($data['intentos'] >= 3) {
                        
                        $alert = '<p>USUARIO BLOQUEADO</p> <a href="bloqueado.php">Desbloquear</a>';
    
                    }else{

                        $usuario = $_POST['usuario'];
                        $clave = $_POST['clave'];

                        // Verificar si el usuario existe
                        $query_verificar = @mysqli_query($conn, "SELECT * FROM empleado WHERE usuario = '$usuario'");
                        $num_verificar = mysqli_num_rows($query_verificar);

                        if ($num_verificar > 0) {
                            // Verificar la contraseña
                            $consulta = mysqli_query($conn, "SELECT * FROM empleado WHERE usuario = '$usuario' AND clave = '$clave'");
                            $result = mysqli_num_rows($consulta);
                            
                            if ($result > 0) {
                                
                                $verificar_estado = @mysqli_query($conn,"SELECT estado FROM empleado WHERE usuario = '$usuario'");
                                $result_estado = mysqli_fetch_assoc($verificar_estado);

                                if ($result_estado['estado'] == 1) {
                                    require "sistema/php/funciones/CRUDS.php";
                                    $data = mysqli_fetch_array($consulta);
                                    $_SESSION['admin']['activo'] = true;
                                    $_SESSION['admin']['id_empleado'] = $data['id_empleado'];
                                    $_SESSION['admin']['nombre'] = $data['nombre'];
                                    $_SESSION['admin']['apellido'] = $data['apellido'];
                                    $_SESSION['admin']['correo'] = $data['correo'];
                                    $_SESSION['admin']['rol'] = $data['rol'];
                                    $_SESSION['admin']['usuario'] = $usuario;
                                    $_SESSION['admin']['clave'] = $clave;
                                    header("location: sistema/vistas/dashboard/");
                                    registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha iniciado sesión", "ENTRADA", $conn);
                                }else {
                                    $alert = '<p>Su usuario ha sido eliminado, contacte con un administrador para restablecerlo.</p>';
                                }
                            } else {
                                // Incrementar intentos
                                $sql = @mysqli_query($conn, "SELECT intentos FROM empleado WHERE usuario = '$usuario'");
                                while ($data = @mysqli_fetch_array($sql)) {
                                    $intentos = $data['intentos'];
                                    $error = @mysqli_query($conn, "UPDATE empleado SET intentos = ($intentos + 1) WHERE usuario = '$usuario'");
                                }
                                session_destroy();
                                $alert = '<p>Nombre de usuario o contraseña erróneo, solo tiene 3 intentos antes de que su usuario sea bloqueado</p>';
                            }
                        } else {
                            $alert = '<p>Usuario no existente.</p>';
                        }
    
                    }

                }

            }else {
                $alert = '<p>Todos los campos obligatorios deben ser llenados</p>';
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

    <div class="wrapper">
        <form action="" method="POST">
            <h1>Iniciar Sesión</h1>
            <div class="input_box">
                <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" required>
                <i class='bx bxs-user'></i>
                <span style="color: red;">*</span> <!-- Asterisco rojo -->
            </div>
            <div class="input_box">
                <input type="password" name="clave" id="clave" placeholder="Contraseña" required>
                <i class='bx bxs-lock-alt'></i>
                <span style="color: red;">*</span> <!-- Asterisco rojo -->
            </div>

            <div class="remember-forgot" style="margin:10px;">
                <a href="reset_1.php">¿Olvidó su contraseña?</a>
                <a href="bloqueado.php">¿Usuario bloqueado?</a>
            </div>

            <button type="submit" class="btn">Iniciar Sesión</button>

            <div class="register_link">
                <p>Los campos con (<span style="color: red;">*</span>) son OBLIGATORIOS</p>
            </div>

            <?php
            
            if ($alert != '') {
                echo $alert;
            }
            
            ?>

            <p style="font-size: 8pt; margin-top: 5em; color: black;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>
    
</body>
</html>