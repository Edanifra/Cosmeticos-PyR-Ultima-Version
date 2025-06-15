<?php

    require "../../conexion.php";

    session_start();
    $alert = '';

    if (!empty($_POST)) {
        if (!empty($_POST['usuario']) && !empty($_POST['nombre']) && !empty($_POST['apellido'])
            && !empty($_POST['correo']) && !empty($_POST['cedula']) && !empty($_POST['fecha'])
            && !empty($_POST['clave']) && !empty($_POST['telefono'])) {

            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $cedula = $_POST['cedula'];
            $fecha = $_POST['fecha'];
            $clave = $_POST['clave'];
            $telefono = $_POST['telefono'];

            // Consulta para verificar si el usuario o correo ya existen
            $consulta = mysqli_query($conn, "SELECT * FROM cliente WHERE correo = '$correo' OR usuario = '$usuario'");
            $result = mysqli_num_rows($consulta);

            if ($result == 0) {
                // Inserción de nuevo cliente
                $sql = mysqli_query($conn, "INSERT INTO cliente (usuario,nombre,apellido,cedula,correo,clave,nacimiento,telefono) 
                        VALUES ('$usuario','$nombre','$apellido','$cedula','$correo','$clave','$fecha','$telefono')");
                if ($sql) {
                    header("location: lista_cliente.php");
                    exit();
                }else {
                    $alert = '<p class="msg_error">Ocurrió un problema al registrar al nuevo usuario, intente más tarde.</p>';
                }
            }else {
                $alert = '<p class="msg_error">El nombre de usuario o el correo electrónico ya están registrados.</p>';
            }
        }else {
            $alert = '<p class="msg_error">Todos los datos deben ser llenados.</p>';
        }
    }

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrarse</title>

    <?php
        include "../../php/usefull/cabecera.php";
    ?>
    <link rel="stylesheet" href="../../../style.css">
</head>
<body>

    <div class="wrapper2">
        <h1>Nuevo usuario</h1>
        <form action="" method="POST">
            
            <div class="cont">
                <div class="input_box">
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" required>
                    <i class='bx bx-user'></i>
                </div>

                <div class="input_box">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    <i class='bx bx-list-ul'></i>
                </div>

                <div class="input_box">
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                    <i class='bx bx-list-ul'></i>
                </div>

                <div class="input_box">
                    <input type="email" name="correo" id="correo" placeholder="Correo electrónico" required>
                    <i class='bx bx-envelope'></i>
                </div>

                <div class="input_box">
                    <input type="password" name="clave" id="clave" placeholder="Clave" required>
                    <i class='bx bxs-lock-alt' ></i>
                </div>

                <div class="input_box">
                    <input type="number" name="cedula" id="cedula" placeholder="Cédula de Identidad" required>
                    <i class="bx bxs-id-card"></i>
                </div>

                <div class="input_box">
                    <input type="date" name="fecha" id="fecha" required>
                    <label for="fecha"><i class='bx bx-calendar'></i></label>
                </div>

                <div class="input_box">
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
                    <i class='bx bxs-phone'></i>
                </div>
            </div>

            <input type="hidden" name="rol" value="2">

            <?php 
                
                if ($alert != '') {
                    echo $alert;
                }
                
                ?>
            
            <button type="submit" class="btn">Registrarse</button>

            <div class="register_link">
                <p>¿Ya tiene una cuenta? <a href="login.php">Iniciar sesión</a></p>
            </div>

            <p style="font-size: 8pt; margin-top: 5em; color: black; text-align:center;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>
    
</body>
</html>