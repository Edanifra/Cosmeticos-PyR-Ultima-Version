<?php

include "../../conexion.php";

$var = @mysqli_query($conn, "SELECT color_principal FROM configuracion");
$data = mysqli_fetch_assoc($var);

?>

<header class="header black-bg" id="header" style="background:<?php echo $data['color_principal']; ?>;">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="../../vistas/dashboard/index.php" class="logo"><b>PyR Cosmetics</b></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
    </div>
    <div class="top-menu">
        <ul class="nav pull-right top-menu" style="display:flex;gap:20px;align-items:baseline; color:white;">
            <li>
                <div id="fecha-hora"></div>
            </li>
            <li>
                <a class="logout" href="../../salir.php"><i class="fa fa-sign-out" aria-hidden="true"
                        style="font-size: 1.7em;"></i> Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</header>

<div class="modal">
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