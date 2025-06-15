<?php

    $alert = '';

    // SI LA RESPUESTA Y EL CORREO NO ESTÁN VACÍOS:
    if(!empty($_POST['respuesta']) && !empty($_POST['correo'])){

        require "conexion.php";

        $pregunta = $_POST['pregunta'];
        $respuesta = $_POST['respuesta'];
        $correo = $_POST['correo'];


        $sql = @mysqli_query($conn,"SELECT * FROM empleado WHERE correo = '$correo' AND pregunta = '$pregunta' 
        AND respuesta = '$respuesta'");

        $resultado = mysqli_num_rows($sql);

        // SI LA PREGUNTA FUE CONTESTADA CORRECTAMENTE:
        if ($resultado > 0) {

        }else{
            $alert = "<p>La pregunta NO fue contestada correctamente</p>";
        }

    }else {
        header("location: reset_2.php");
        $alert = "<p>Todos los campos deben estar completados.</p>";
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
            <p>Ingrese su nueva contraseña y confirme para reiniciarla</p>

            <div class="input_box">
                <input type="text" name="clave_1" id="clave_1" placeholder="Contraseña..." required>
                <i class='bx bx-list-ul' ></i>
            </div>

            <div class="input_box">
                <input type="text" name="clave_2" id="clave_2" placeholder="Confirmación..." required>
                <i class='bx bx-list-ul' ></i>
            </div>

            <input type="hidden" name="correo" value="<?php echo $correo; ?>">

            <button type="submit" class="btn">Actualizar</button>

            <p style="font-size: 8pt; margin-top: 5em; color: black;">PyR Cosmetics C.A 2024 © Todos los derechos reservados</p>
        </form>
    </div>

</body>
</html>