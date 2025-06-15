<?php 
    require "conexion.php";
    if (isset($_SESSION['cliente']['activo']) && $_SESSION['cliente']['activo'] == true) {
        $token = md5($_SESSION['cliente']['id_usuario']);
        $id_usuario = $_SESSION['cliente']['id_usuario'];

        $query_total_items = mysqli_query($conn, "SELECT COUNT(cantidad) as total_items FROM detalle_carrito WHERE token_user = '$token'");
        $resultado = mysqli_fetch_assoc($query_total_items);

        $query_total_notificaciones = mysqli_query($conn, "SELECT COUNT(*) as notificaciones FROM notificaciones WHERE estado = 0 AND id_usuario = $id_usuario");
        $res_noti = mysqli_fetch_assoc($query_total_notificaciones);
    }
?>

<nav
    class="navbar navbar-expand-lg navbar-default topnav fixed-top" role="navigation" style="z-index: 25;background: white;border-bottom:1px solid #cbc2c2;height: 51px;"
>
    <div class="container">
        
        <a class="navbar-brand" style="color:gray;font-style:italic;" href="catalogo.php">
        <?php 
       $query_conf = @mysqli_query($conn,"SELECT * FROM configuracion");
        while ($row = mysqli_fetch_assoc($query_conf)) {
            echo $row['nombre'];
        }
       
        ?>
        </a>

        <div id="fecha-hora"></div>

        <button
            class="navbar-toggler hidden-lg-up"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
        ></button>
        <div class="collapse navbar-collapse d-flex" style="justify-content: end;" id="collapsibleNavId">
            <?php 
                if (isset($_SESSION['cliente']['activo']) && $_SESSION['cliente']['activo'] == true) {
            ?>
                    <div style="display: flex; gap:5px;">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0" style="display: contents;">
                            <li class="nav-item">
                                <?php
                                
                                if (!empty($_SESSION['cliente']['activo'])) {
                                ?>
                                
                                    <a style="color:black;" id="notificaciones" class="nav-link" href="notificaciones.php"><i class="bi bi-bell"></i> (<?php if (isset($res_noti)) {
                                        if ($res_noti['notificaciones'] == 0) {
                                            echo 0;
                                        } else {
                                            print_r($res_noti['notificaciones']);
                                        }
                                    }else {
                                        echo 0;
                                    }
                                    ?>)
                                    </a>

                                <?php
                                }
                                ?>
                            </li>
                            
                        </ul>
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0" style="display: contents;">
                            <li class="nav-item">
                                <?php
                                
                                if (!empty($_SESSION['cliente']['activo'])) {
                                ?>
                                
                                    <a style="color:black;" id="carrito_compras" class="nav-link" href="carro.php"><i class="bi bi-cart"></i> (<?php if (isset($resultado)) {
                                        if ($resultado['total_items'] == 0) {
                                            echo 0;
                                        } else {
                                            print_r($resultado['total_items']);
                                        }
                                    }else {
                                        echo 0;
                                    }
                                    ?>)
                                    </a>

                                <?php
                                }
                                ?>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a class="btn" href="perfil.php">
                                <i class="bi bi-person-circle" style="font-size: 1.2em;"></i> 
                                <?php echo $_SESSION['cliente']['nombre']; ?>
                                <i class="bi bi-caret-down-fill"></i>
                            </a>
                            <div class="dropdown-content">
                                <a class="btn" href="logout.php">
                                    <i class="bi bi-box-arrow-in-left" style="font-size: 1.2em;"></i> Cerrar sesión
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }else {
            ?>
                    <a href="#" id="btn_iniciar_sesion" class="btn btn-secondary btn_iniciar_sesion">Iniciar sesión</a>
            <?php
                }
            ?>

        </div>
    </div>

</nav>

<div class="Modal">
    <div class="bodyModal">
    </div>
</div>

<script>
    function actualizarFechaHora() {
        const ahora = new Date();
        const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const fecha = ahora.toLocaleDateString('es-ES', opciones);
        const hora = ahora.toLocaleTimeString('es-ES');

        document.getElementById('fecha-hora').innerHTML = `${fecha} - ${hora}`;
    }

    // Actualizar cada segundo
    setInterval(actualizarFechaHora, 1000);

    // Llamar la función por primera vez
    actualizarFechaHora();
</script>