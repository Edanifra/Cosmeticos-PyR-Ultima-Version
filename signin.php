<?php

    require "conexion.php";

    session_start();
    $alert = '';

    if ($_SESSION['admin']['rol'] != 1) {
        header("location: sistema/vistas/dashboard/");
    }else{
        if (!empty($_POST)) {
            
            if (!empty($_POST['usuario']) && !empty($_POST['nombre']) && !empty($_POST['apellido'])
                && !empty($_POST['correo']) && !empty($_POST['pregunta']) && !empty($_POST['respuesta'])
                && !empty($_POST['clave']) && !empty($_POST['telefono'])) {

                $usuario = $_POST['usuario']; $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido']; $correo = $_POST['correo'];
                $respuesta = $_POST['respuesta']; $pregunta = $_POST['pregunta'];
                $rol = 2; $clave = $_POST['clave']; $telefono = $_POST['telefono'];

                $consulta = @mysqli_query($conn,"SELECT * FROM empleado WHERE correo = '$correo' OR usuario = '$usuario' ");
                $result = mysqli_num_rows($consulta);

                if ($result == 0) {
                    
                    $data = mysqli_fetch_array($consulta);

                    $sql = @mysqli_query($conn,
                                "INSERT INTO empleado (usuario,nombre,apellido,rol,correo,clave,pregunta,respuesta,telefono)
                                      VALUES ('$usuario','$nombre','$apellido','$rol','$correo','$clave','$pregunta','$respuesta','$telefono')");

                    if ($sql) {
                        header("location:sistema/vistas/dashboard/index.php");
                    }else {
                        $alert = '<p class="msg_error">Error al crear el usuario</p>';
                    }

                }else {
                    session_destroy();
                }
                    
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

    <div class="wrapper2">
        <h1>Nuevo usuario</h1>
        <form action="" method="POST">
            <div class="cont">
                <div class="input_box">
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" required>
                    <i class='bx bx-user'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    <i class='bx bx-list-ul'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                    <i class='bx bx-list-ul'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <input type="email" name="correo" id="correo" placeholder="Correo electrónico" required>
                    <i class='bx bx-envelope'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <input type="password" name="clave" id="clave" placeholder="Clave" required>
                    <i class='bx bxs-lock-alt'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <select class="seleccion" name="pregunta" id="pregunta" required>
                        <option value="Nombre de su primera mascota">Nombre de su primera mascota</option>
                        <option value="Pelicula favorita">Película favorita</option>
                        <option value="Pasatiempo favorito">Pasatiempo favorito</option>
                    </select>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <input type="text" name="respuesta" id="respuesta" placeholder="Respuesta" required>
                    <i class='bx bx-message-dots'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
                <div class="input_box">
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
                    <i class='bx bxs-phone'></i>
                    <span style="color: red;">*</span> <!-- Asterisco rojo -->
                </div>
            </div>
            <button type="submit" class="btn" style="margin-top:15px;">Registrarse</button>
            
            <div class="register_link">
                <p>Los campos con (<span style="color: red;">*</span>) son OBLIGATORIOS</p>
            </div>

            <?
            
            if ($alert != '') {
                echo $alert;
            }
            
            ?>
            <p style="font-size: 8pt; margin-top: 5em; color: black; text-align:center;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>
    
</body>
</html>