<?php

include "../../conexion.php";

$var = @mysqli_query($conn, "SELECT * FROM configuracion");
$data = mysqli_fetch_assoc($var);

?>

<style>
    ul.sidebar-menu li a.active,
    ul.sidebar-menu li a:hover,
    ul.sidebar-menu li a:focus {
        background:
            <?php echo $data['color_complementario']; ?>
        ;
    }

    ul.sidebar-menu li ul.sub li {
        background-color:
            <?php echo $data['color_principal']; ?>
        ;
    }

    ul.sidebar-menu li a {
        color:<?php echo $data['fuente_b_lateral']; ?>;
        text-decoration: none;
        display: block;
        padding: 15px 0 15px 10px;
        font-size: 12px;
        outline: none;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .active, .active i {
        color: <?php echo $data['fuente_b_lateral']; ?> !important;
    }
</style>

<aside>
    <div id="sidebar" class="nav-collapse" style="background:<?php echo $data['color_secundario']; ?>;">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="#"><img src="../../assets/img/user.png" class="img-circle" width="60"></a></p>
            <h5 class="centered" style="text-transform:capitalize;"><?php echo $_SESSION['admin']['usuario']; ?></h5>

            <li class="mt">
                <a class="active" href="../dashboard/index.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Menú de inicio</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-th-list" aria-hidden="true"></i>
                    <span>Gestión de productos</span>
                </a>
                <ul class="sub">
                    <li><a href="../productos/listaProductos.php">Lista de productos</a></li>
                    <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                        <li><a href="../productos/agregarProducto.php">Agregar producto</a></li>
                    <?php } ?>
                    <li><a href="../categorias/listaCategorias.php">Categorías</a></li>
                    <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                        <li><a href="../productos/carga_productos.php">Cargar stock</a></li>
                    <?php } ?>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    <span>Inventario</span>
                </a>
                <ul class="sub">
                    <li><a href="../inventario/ventas.php">Ventas</a></li>
                    <li><a href="../inventario/listaVentas.php">Lista de ventas</a></li>
                    <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                        <li><a href="../inventario/ajustes.php">Ajustes de inventario</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <span>Descuentos</span>
                    </a>
                    <ul class="sub">
                        <li><a href="../descuentos/desc_item.php">Descuentos por item</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-taxi" aria-hidden="true"></i>
                    <span>Pedidos</span>
                </a>
                <ul class="sub">
                    <li><a href="../pedidos/lista_pedidos.php">Pedidos en tienda física</a></li>
                    <li><a href="../pedidos/delivery.php">Pedidos a domicilio</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Clientes</span>
                </a>
                <ul class="sub">
                    <li><a href="../clientes/lista_clientes.php">Lista de clientes</a></li>
                    <li><a href="../clientes/agregar_cliente.php">Agregar cliente</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Usuarios</span>
                </a>
                <ul class="sub">
                    <li><a href="../usuarios/lista_usuarios.php">Lista de usuarios</a></li>
                    <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                        <li><a href="../usuarios/lista_usuarios_eliminados.php">Usuarios eliminados</a></li>
                    <?php } ?>
                    <li><a href="../../../signin.php">Agregar usuario</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-file-excel-o" style="font-size: large;"></i>
                    <span>Plantillas</span>
                </a>
                <ul class="sub">
                    <li><a href="../plantillas/index.php">Plantillas CSV</a></li>
                </ul>
            </li>
            <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Reportes</span>
                    </a>
                    <ul class="sub">
                        <li><a href="../reportes/rep_ventas.php">Reporte de ventas</a></li>
                        <li><a href="../reportes/stock.php">Reporte de stock bajo</a></li>
                        <li><a href="../reportes/rep_inventario.php">Reporte de productos</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($_SESSION['admin']['rol'] == 1) { ?>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span>Configuración</span>
                    </a>
                    <ul class="sub">
                        <li><a href="../configuracion/index.php">Configuración</a></li>
                        <li><a href="../configuracion/bitacora.php">Bitácora</a></li>
                        <li><a href="../configuracion/respaldo.php">Respaldo BD</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="sub-menu">
                <a href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span>Sistema</span>
                </a>
                <ul class="sub">
                    <li><a href="../ayuda/index.php">Ayuda</a></li>
                </ul>
            </li>
            <!-- ////////////////// sidebar menu end-->
    </div>
</aside>