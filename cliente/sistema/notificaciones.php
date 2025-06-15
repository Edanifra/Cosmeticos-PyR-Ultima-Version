<?php 
    session_start();
    include 'conexion.php';
    include 'global/funciones.php';

    $alert = '';

    $id = $_SESSION['cliente']['id_usuario'];
    
    $total_registro = contarRegistrosEspecificos($conn,"notificaciones","id_usuario",$id);
    $por_pagina = 5;
    
    if (empty($_GET['pagina'])) {
        $pagina = 1;
    }else {
        $pagina = $_GET['pagina'];
    }
    
    $desde = ($pagina - 1) * $por_pagina;
    $total_paginas = ceil($total_registro / $por_pagina);
    
    $query = mysqli_query($conn,"SELECT * FROM notificaciones WHERE id_usuario = $id LIMIT $desde,$por_pagina");
    
    $num_noti = mysqli_query($conn,"SELECT * FROM notificaciones WHERE id_usuario = $id AND estado = 0");
    $res_num = mysqli_num_rows($num_noti);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Perfil de usuario</title>
</head>
<body>

<?php require "global/header.php"?>

<div class="container d-grid gap-5" style="margin-top:6%;position: relative;right: 5%;">
    <div class="row" style="margin-right: 12%; position: relative; left: 15%;">
        <div>
            <h2 class="text-secondary" style="display:inline-flex; margin-right:15px;">Notificaciones</h2>
            <?php 
            
                if ($res_num > 0) {
            ?>
                    <button class="btn" id="todo_leido" cliente="<?php echo $_SESSION['cliente']['id_usuario'];?>" style="color:green; font-weight:900;">Marcar todo como leído</button>
            <?php
                }else {
            ?>
                    <button class="btn" disabled style="color:green; font-weight:900;">Marcar todo como leído</button>
            <?php
                }
            
            ?>

                <table class="table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th width="380px">Información</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
            <?php while($data = mysqli_fetch_assoc($query)){ ?>

                    <tbody>
                        <tr id="noti_<?php echo $data['id_notificacion']; ?>">
                            <td><?php echo $data['descripcion']; ?></td>
                            <td><?php echo $data['fecha']; ?></td>
                            <td>
                                <?php 
                                
                                    if ($data['estado'] == 0) {
                                    ?>
                                        <button class="btn boton_formato boton_noti noti_<?php echo $data['id_notificacion']; ?>" id="marcar_leido" id_noti="<?php echo $data['id_notificacion']; ?>" style="color:white;"><i class="bi bi-eye"></i></button>
                                    <?php
                                    }else{
                                    ?>
                                        <button class="btn boton_formato" style="color:white;" disabled><i class="bi bi-eye"></i></button>
                                    <?php   
                                    }

                                ?>
                                <a class="btn btn-danger" id="eli_noti" id_noti="<?php echo $data['id_notificacion']; ?>" href="#"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>

        </div>
        <?php
        
        if ($total_registro > 0) {
        ?>

        <div class="paginador">
            <ul>
                <?php
                
                if ($pagina == 1) {
                
                ?>

                <li class="pageSelected2"> |<< </li>
                <li class="pageSelected2"> < </li>

                <?php
                }else {
                ?>

                <li><a href="?pagina=<?php echo 1; ?>"> |<< </a></li>
                <li><a href="?pagina=<?php echo $pagina - 1; ?>"> < </a></li>

                <?php
                }

                for ($i=1; $i <= $total_paginas; $i++) { 
                    if ($i == $pagina) {
                        echo '<li class="pageSelected">'.$i.'</li>';
                    }else {
                        echo '<li><a href="?pagina='.$i.'" > '.$i.' </a></li>';
                    }
                }

                if($pagina == $total_paginas){
                
                ?>

                <li class="pageSelected2"> > </li>
                <li class="pageSelected2"> >>| </li>

                <?php
                
                }else{

                ?>

                <li><a href="?pagina=<?php echo $pagina + 1; ?>"> > </a></li>
                <li><a href="?pagina=<?php echo $total_paginas; ?>"> >>| </a></li>

                <?php
                }
                ?>
            </ul>
        </div>

        <?php
        }
        
        ?>
    </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>