<?php

    session_start();

    if (!empty($_SESSION['admin']['activo'])) {
        header("location: sistema/vistas/dashboard/");
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
        <form action="desbloquearUsuario.php" method="POST">
            <h1>Desbloquear usuario</h1>
            <p>Por favor, ingrese su correo electrónico para proceder a desbloquear su usuario</p>
            <div class="input_box">
                <input type="text" name="correo" id="correo" placeholder="Correo electrónico" required>
                <i class='bx bxs-user'></i>
            </div>

            <button type="submit" class="btn">Enviar</button>

            <p style="font-size: 8pt; margin-top: 5em; color: black;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>

</body>
</html>