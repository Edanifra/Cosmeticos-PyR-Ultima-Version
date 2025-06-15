<?php 
    session_start();
    
    if ($_SESSION['cliente']['activo'] == true) {
        include 'conexion.php';
        include 'global/funciones.php';

        $alert = '';

        $id = $_SESSION['cliente']['id_usuario'];

        $query = mysqli_query($conn,"SELECT * FROM cliente WHERE id_cliente = $id");

        $direccion = mysqli_query($conn,"SELECT * FROM direccion WHERE id_cliente = '$id'");
        
        $num_dir = contarRegistrosEspecificos($conn,"direccion","id_cliente",$id);
    }else {
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Perfil de usuario</title>
</head>
<body>

<?php require "global/header.php"?>

<?php //require "global/sidebar.php"?>

<div class="container d-grid gap-5" style="margin-top:6%;">
    <div class="row" id="info_perfil" style="margin-right: 12%; position: relative; left: 15%;">
        <div>
            <h2 class="text-secondary">Información del perfil</h2>
            <hr>

<?php while($data = mysqli_fetch_assoc($query)){ ?>




<div class="col-12 d-flex" style="justify-content:center; gap: 3em;">
    <div style="display:contents;">
        <div class="card" style="border: none; display: flex; width: 19em; align-items: center;">
            <img class="card-img-top" style="border-radius:30%; width: 80%;" src="
                <?php

                    if (!empty($data['foto'])) {
                        echo "img/perfil/usuario-".$id."/".$data['foto'];
                    }else {
                        echo "img/perfil/homo.jpg";
                    }

                ?>
            " alt="Title" />
            <div class="d-flex" style="justify-content:center; gap:5px;">
                <a href="#" class="btn_editar_foto" cliente="<?php echo $id;?>" id="btn_editar_foto"><i class="bi bi-pencil-fill" style="font-size: xx-large;"></i></a>
                <a href="#" class="btn_borrar_foto" cliente="<?php echo $id;?>" id="btn_borrar_foto"><i class="bi bi-x" style="font-size: xx-large;"></i></a>
            </div>
        </div>
        <div class="card" style="justify-content:center; border:none;">
            <h2 style="text-transform:capitalize; font-weight: 700;" id="perfil_nombre_principal"><?php echo "".$data['nombre']." ".$data['apellido']; ?></h2>
            <h4 id="perfil_correo_principal"><?php echo $data['correo']; ?></h4>
        </div>
    </div>
</div><br><br>
<h2 class="text-secondary">Datos personales</h2><hr>
    <div style="display: flex; justify-content: center;"><div style="display: none;" class="alert_perfil col-6"></div></div>

    <form action="" method="post" id="txt_form_perfil" onsubmit="event.preventDefault(); actualizarPerfil(<?php echo $id; ?>);">
        <!-- NOMBRES Y APELLIDOS -->
        <div style="justify-content: space-evenly; display: flex;">
            <div class="datazos nombre">
                <label style="font-weight:500;">Nombres</label>
                <input onchange="desbloquearBoton();" required type="text" name="nombre" id="perfil_nombre" value="<?php echo $data['nombre']; ?>">
            </div>
            <div class="datazos apellido">
                <label for="apellido" style="font-weight:500;">Apellidos</label>
                <input onchange="desbloquearBoton();" required type="text" name="apellido" id="perfil_apellido" value="<?php echo $data['apellido']; ?>">
            </div>
        </div>

        <!-- CORREO Y FECHA DE NACIMIENTO -->
        <div style="justify-content: space-evenly; display: flex;">
            <div class="datazos">
                <label for="correo" style="font-weight:500;">Correo electrónico:</label>
                <input onchange="desbloquearBoton();" required type="email" name="correo" id="perfil_correo" value="<?php echo $data['correo']; ?>">
            </div>
            <div class="datazos">
                <label for="nacimiento" style="font-weight:500;">Fecha de nacimiento:</label>
                <input onchange="desbloquearBoton();" required type="date" name="nacimiento" id="perfil_nacimiento" value="<?php echo $data['nacimiento']; ?>">
            </div>
        </div>

        <!-- TELÉFONO Y CÉDULA -->
        <div style="justify-content: space-evenly; display: flex;">
            <div class="datazos">
                <label for="cedula" style="font-weight:500;">Cédula:</label>
                <input onchange="desbloquearBoton();" required type="number" style="background-color: #b4a6a6;" name="cedula" id="perfil_cedula" value="<?php echo $data['cedula']; ?>" readonly>

                <?php
                //$sql_cedula = mysqli_query($conn,"SELECT * FROM solicitud_cedula WHERE id_cliente = $id AND estado = 0");
                //$result_cedula = mysqli_num_rows($sql_cedula);
                //if ($result_cedula > 0) {?>
               <!-- <div><button class="btn btn-primary" style="margin-top:5px;" id="cambio_cedula" disabled cliente="<?php echo $id; ?>" id="cambio_cedula">Solicitar cambio de cédula</button></div> -->
                <?php // }else{?>
               <!-- <div><button class="btn btn-primary" style="margin-top:5px;" id="cambio_cedula" cliente="<?php echo $id; ?>" id="cambio_cedula">Solicitar cambio de cédula</button></div> -->
                <?php // }?>

            </div>
            <div class="datazos">
                <label for="telefono" style="font-weight:500;">Teléfono:</label>
                <input onchange="desbloquearBoton();" required type="text" name="telefono" id="perfil_telefono" value="<?php echo $data['telefono']; ?>">
            </div>
        </div>
        <div style="justify-content: center; display: flex; margin:2em;">
            <button id="txt_boton_perfil" type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>

    <br>

    <h2 class="text-secondary" style="display: inline-flex; margin-right:10px;">Direcciones</h2> 
    <?php if ($num_dir <= 0) {?>
        <button class="btn btn-secondary" id="add_dir" id_cliente="<?php echo $id;?>"><i class="bi bi-plus"></i> Añadir direccion</button> <hr>
    <?php }?>
    <div style="justify-content: space-evenly; display: flex;">
        <table class="table">
            <thead>
                <tr>
                    <td style="width: 65%;">Dirección</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($num_dir > 0){
                    while ($data = mysqli_fetch_assoc($direccion)) {

                ?>
                <tr>
                    <td><?php echo $data['direccion'];?></td>
                    <td>
                        <button class="btn boton_formato" id="edit_dir" cliente="<?php echo $id; ?>" id_dir="<?php echo $data['id']; ?>" style="color:white;"><i class="bi bi-pencil-fill"></i></button>
                        <button class="btn btn-danger" id="delete_dir" id_client="<?php echo $id; ?>" direccion="<?php echo $data['id']; ?>"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
                <?php 

                    }
                }else {
                ?>
                    <tfoot>
                        <tr>
                            <td colspan="3">No hay direcciones registradas para este usuario.</td>
                        </tr>
                    </tfoot>
                <?php
                }

                ?>
            </tbody>
        </table>
    </div>
    <br><br>




<?php } ?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>