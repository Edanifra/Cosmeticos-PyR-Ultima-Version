<?php
session_start();

if (empty($_SESSION['admin']['activo'])) {
    header("location: ../../../");
}else {
    if (empty($_GET)) {
        header("location: lista_pedidos.php");
    }else {
        if (empty($_GET['id_pedido']) || !is_numeric($_GET['id_pedido'])) {
            header("location: lista_pedidos.php");
        }else {
            include_once "../../conexion.php";
    
            $id_pedido = $_GET['id_pedido'];
            $id_cliente = $_GET['id_cliente'];
            $estado_pedido = '';
    
            $alert = "";
    
            $sql = mysqli_query($conn,"SELECT dp.codproducto, dp.precio_venta, dp.cantidad, dp.id_usuario,
                                                p.nombre, p.descripcion
                                        FROM detalle_pedido dp
                                        INNER JOIN producto p
                                        ON p.id_producto = dp.codproducto
                                        WHERE nopedido = $id_pedido;");
            $result = mysqli_num_rows($sql);
    
            $info_pedido = mysqli_query($conn,"SELECT estado_pedido FROM pedido WHERE id_pedido = $id_pedido");
            $resultao = mysqli_fetch_assoc($info_pedido);

            $obtener_domiciliario = mysqli_query($conn,"SELECT * FROM empleado WHERE rol = 3");
        }
    }
}

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    
    <title>Pedido #<?php echo $id_pedido; ?></title>

    <?php
        include "../../php/usefull/cabecera.php";
    ?>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      

        <?php
            
            require "../../php/usefull/header.php";

        ?>


      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->

        <?php
        
            require "../../php/usefull/sidebar.php";
        
        ?>

      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      





        <section id="main-content">
            <section class="wrapper">
                <div class="row mt">
                    <div class="col-md-12">
                        <div class="container">
                            <br>

                            <?php
                                if($alert != '') {
                            ?>

                            <div class="alert alert-success">
                                <a href="#" class="badge bg-secondary">Ver carrito</a>
                            </div>

                            <?php } ?>


                            <h2 style="display: contents;">Pedido #<?php echo $id_pedido; ?></h2>

                            <?php 
                                $estatus = $resultao['estado_pedido'];
                                if ($estatus == 1) {
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_pendiente">Pendiente</span>';
                                }else if($estatus == 3){
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_aprobado">Aprobado</span>';
                                }else if($estatus == 2){
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_cancelado">Cancelado</span>';
                                }else if ($estatus == 4) {
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_pendiente">Pendiente</span><span style="margin-left:1em;" class="pedido_pendiente">Reportado como pagado</span>';
                                }

                                echo $estado_pedido;
                            ?>

                            <br><br>
                            <h3 class="text-secondary">Información del pedido</h3>

                            <div class="centrarContentPanel">
                                <div class="table-responsive">
                                    <table class="table table-info table-bordered tbl_venta">
                                        <thead class="table_headers">
                                            <tr>
                                                <th>Cod. Producto</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th width="70px">Cantidad</th>
                                                <th  width="70px">Precio</th>
                                                <th  width="70px">Precio Total</th>
                                            </tr>
                                        </thead>
                                        <?php

                                        $detalleTabla   = '';
                                        $sub_total      = 0;
                                        $iva            = 16;
                                        $total          = 0;
                                        $arrayData      = array();
                                        
                                        while ($data = mysqli_fetch_assoc($sql)) {

                                        $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
                                        $sub_total      = round($sub_total + $precioTotal, 2);
                                        $total          = $precioTotal;
                                        
                                        $total_producto = ($data['precio_venta'] * $data['cantidad']);

                                        ?>
                                        <tbody id="detalle_venta">
                                            <tr>
                                                <td style="text-align: center;"><?php echo $data['codproducto']; ?></td>
                                                <td><?php echo $data['nombre']; ?></td>
                                                <td><?php echo $data['descripcion']; ?></td>
                                                <td style="text-align: center;"><?php echo $data['cantidad']; ?></td>
                                                <td><?php echo $data['precio_venta']; ?></td>
                                                <td><?php echo $total_producto ?>.00</td>
                                            </tr>
                                        <?php } 
                                        
                                        $impuesto   = round($sub_total * ($iva / 100), 2);
                                        $tl_sniva   = round($sub_total - $impuesto, 2);
                                        $total      = round($tl_sniva + $impuesto, 2);
                                        ?>
                                        </tbody>
                                        <tfoot id="detalle_totales" style="background:white;">
                                            <tr>
                                                <td colspan="6"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="font-weight:bold;">SUBTOTAL Bs.</td>
                                                <td class="textright" id="sin_iva"><?php echo $tl_sniva; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="font-weight:bold;">IVA (<?php echo $iva; ?>%)</td>
                                                <td class="textright" id="impuesto"><?php echo $impuesto; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="font-weight:bold;">TOTAL Bs.</td>
                                                <td class="textright" id="total"><?php echo $total; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            <br>
                            <?php
                                $verificar_domicilio = @mysqli_query($conn,"SELECT COUNT(*) as num_filas FROM detalle_pedido WHERE codproducto = 115005451 AND nopedido = $id_pedido");
                                $veri_result = mysqli_fetch_assoc($verificar_domicilio);

                                if ($veri_result['num_filas'] > 0) {
                                    $veri_domi = @mysqli_query($conn,"SELECT domiciliario FROM detalle_pedido WHERE nopedido = $id_pedido");
                                    $veri_domi_2 = mysqli_fetch_assoc($veri_domi);
                                    $domiciliario = $veri_domi_2['domiciliario'];

                                    if ($domiciliario != 0) {

                                        $asigned_delivery = @mysqli_query($conn,"SELECT * FROM empleado WHERE id_empleado = $domiciliario");
                            ?>

                                <h3 class="text-secondary">Domiciliario asignado</h3>
                                <div class="contentPanel centrarContentPanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-primary">
                                            <thead class="table_headers">
                                                <tr>
                                                    <td class="espHeaders">ID empleado</td>
                                                    <td class="espHeaders">Nombre</td>
                                                    <td class="espHeaders">Apellido</td>
                                                </tr>
                                            </thead>
                                            <tbody style="background:white;">
                                                <tr style="text-align: center;">
                                                    <?php
                                                    while($domi = mysqli_fetch_assoc($asigned_delivery)) {?>
                                                        <td><?php echo $domi['id_empleado']; ?></td>
                                                        <td><?php echo $domi['nombre']; ?></td>
                                                        <td><?php echo $domi['apellido']; ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php
                                    }else{
                            ?>

                                <h3 class="text-secondary">Asignar domiciliario</h3>
                                <div class="contentPanel centrarContentPanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-primary">
                                            <thead class="table_headers">
                                                <tr>
                                                    <td class="espHeaders">ID empleado</td>
                                                    <td class="espHeaders">Nombre</td>
                                                    <td class="espHeaders">Apellido</td>
                                                    <td class="espHeaders">Acción</td>
                                                </tr>
                                            </thead>
                                            <tbody style="background:white;">
                                                <?php
                                                    while($deli = mysqli_fetch_assoc($obtener_domiciliario)) {?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $deli['id_empleado']; ?></td>
                                                            <td><?php echo $deli['nombre']; ?></td>
                                                            <td><?php echo $deli['apellido']; ?></td>

                                                            <form action="../../controladores/pedidos/asignarDomiciliario.php" method="post">
                                                                <input type="hidden" name="id_empleado" value="<?php echo $deli['id_empleado']; ?>">
                                                                <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
                                                                <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                                                                <td><button type="submit" class="btn btn-primary">Asignar</button></td>
                                                            </form>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php
                                    }
                                }
                            ?>

                            <h3 class="text-secondary">Información del cliente</h3>
                            <div class="table-responsive">
                                <table class="table table-primary">
                                        <thead class="table_headers">
                                            <tr>
                                                <th>Cédula</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background:white;">
                                            <?php 
                                                $query_cliente = mysqli_query($conn,"SELECT * FROM cliente WHERE id_cliente = $id_cliente");
                                                
                                                while($cliente = mysqli_fetch_assoc($query_cliente)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cliente['cedula']; ?></td>
                                                <td><?php echo $cliente['nombre']; ?></td>
                                                <td><?php echo $cliente['apellido']; ?></td>
                                                <td><?php echo $cliente['telefono']; ?></td>
                                                <td><?php echo $cliente['correo']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                </table>
                            </div>

                            <?php 
                            
                            // VERIFICAR SI EL PEDIDO TIENE UN DOMICILIO CARGADO
                            $deliv = @mysqli_query($conn,"SELECT COUNT(*) as num_reg FROM detalle_pedido WHERE nopedido = $id_pedido AND codproducto = 115005451");
                            $num_reg = mysqli_fetch_assoc($deliv);

                            // SI num_reg ES MAYOR QUE CERO, EL PEDIDO EN CUESTIÓN TIENE UN DOMICILIO CARGADO
                            if ($num_reg['num_reg'] > 0) {
                                
                                // SI HAY UN DOMICILIO CARGADO, VERIFICAMOS SI TIENE UN DOMICILIARIO ASIGNADO
                                $veri_domiciliario = @mysqli_query($conn,"SELECT domiciliario FROM detalle_pedido WHERE nopedido = $id_pedido");
                                $domici = mysqli_fetch_assoc($veri_domiciliario);

                                // SI TIENE UN DOMICILIARIO ASIGNADO, DESPLEGAMOS LAS ACCIONES, SI NO, LE INDICAMOS AL ADMINISTRADOR
                                if ($domici['domiciliario'] != 0) {
                                ?>
                                    <br>
                                    <h3 class="text-secondary">Acciones</h3>
                                    <div class="table-responsive">
                                        <table class="table table-primary">
                                            <tbody>
                                                <tr style="text-align: center;">
                                                    <?php
                                                    if ($resultao['estado_pedido'] != 2 && $_SESSION['admin']['rol'] == 1
                                                        && $resultao['estado_pedido'] != 3) {?>
                                                        <td><button class="btn btn-success" pedido="<?php echo $id_pedido; ?>" id="btn_aprobar_pedido">Aprobar pedido</button></td>
                                                        <td><button class="btn btn-danger" pedido="<?php echo $id_pedido; ?>" id="btn_cancelar_pedido">Cancelar pedido</button></td>
                                                    <?php
                                                    }else {?>
                                                        <td><span>Acciones no disponibles para este pedido</span></td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }else {
                                ?>
                                    <br>
                                    <h3 class="text-secondary">Acciones</h3>
                                    <div class="table-responsive">
                                        <table class="table table-primary">
                                            <tbody>
                                                <tr style="text-align: center;">
                                                    <td><span>Un domiciliario debe ser asignado antes de aprobar o cancelar el pedido.</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }

                            }else {
                                // SI NO HAY UN DOMICILIO CARGADO, VERIFICAMOS EL ESTADO DEL PEDIDO
                                ?>
                                <br>
                                <h3 class="text-secondary">Acciones</h3>
                                <div class="table-responsive">
                                    <table class="table table-primary">
                                        <tbody>
                                            <tr style="text-align: center;">
                                                <?php
                                                if ($resultao['estado_pedido'] != 2 && $_SESSION['admin']['rol'] == 1
                                                    && $resultao['estado_pedido'] != 3) {?>
                                                    <td><button class="btn btn-success" pedido="<?php echo $id_pedido; ?>" id="btn_aprobar_pedido">Aprobar pedido</button></td>
                                                    <td><button class="btn btn-danger" pedido="<?php echo $id_pedido; ?>" id="btn_cancelar_pedido">Cancelar pedido</button></td>
                                                <?php
                                                }else {?>
                                                    <td><span>Acciones no disponibles para este pedido</span></td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            }
                            ?>

                            <br>
                            <h3 class="text-secondary">Comprobante de pago</h3>
                            <div class="table-responsive">
                                <table class="table table-primary">
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <?php 
                                                $query_foto = mysqli_query($conn,"SELECT comprobante FROM pedido WHERE id_pedido = $id_pedido");
                                                $foto = mysqli_fetch_assoc($query_foto);

                                                if (!empty($foto['comprobante'])) {
                                            ?>
                                                <td><img style="width: 90%;max-height: 30em; object-fit:contain;" src="../../../cliente/sistema/img/comprobantes/usuario-<?php echo $id_cliente; ?>/pedido-<?php echo $id_pedido; ?>/<?php echo $foto['comprobante']; ?>"></td>
                                            <?php }else{?>
                                                <td><span>No hay comprobante de pago cargado para este pedido</span></td>
                                            <?php }?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>








      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../../assets/js/jquery.sparkline.js"></script>
    <script src="../../js/functions.js"></script>
    <script src="https://kit.fontawesome.com/d369b98639.js" crossorigin="anonymous"></script>


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({php: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</php>
