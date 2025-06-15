<?php


    // SI LA RESPUESTA Y EL CORREO NO ESTÁN VACÍOS:
    if(!empty($_POST['clave_1']) && !empty($_POST['clave_2'])){

        require "conexion.php";
        require "sistema/php/funciones/validarContrasenas.php";

        $clave1 = $_POST['clave_1'];
        $clave2 = $_POST['clave_2'];
        $correo = $_POST['correo'];

        if (validarContrasenas($clave1, $clave2)) {
            
            $sql = @mysqli_query($conn,"UPDATE empleado SET clave = '$clave1' WHERE correo = '$correo'");

            if ($sql) {
                $alert =  "<p>Contraseña actualizada.  <a href='index.php'>Iniciar Sesión</a></p>";
            }else {
                $alert = "<p>Error al intentar actualizar la contraseña</p>";
            }

        }else {
            $alert = "<p>Ambas contraseñas deben coincidir, por favor, corrija.</p>";
        }

    }else {
        header("location: reset_2.php");
        $alert = "<p>Todos los campos deben estar llenos</p>";
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
        <form action="reset_4.php" method="POST">
            <h1>Seguridad</h1>

            <div class="input_box">
                <input type="text" name="clave_1" id="clave_1" value="<?php echo $clave1 ?>" placeholder="Contraseña..." readonly>
                <i class='bx bx-list-ul' ></i>
            </div>

            <div class="input_box">
                <input type="text" name="clave_2" id="clave_2" value="<?php echo $clave2 ?>" placeholder="Confirmación..." readonly>
                <i class='bx bx-list-ul' ></i>
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