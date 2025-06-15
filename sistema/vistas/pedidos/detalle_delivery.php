<?php
session_start();

if (empty($_SESSION['admin']['activo'])) {
    header("location: ../../../");
}else {
    if (empty($_GET)) {
        header("location: delivery.php");
    }else {
        if (empty($_GET['id_delivery']) || !is_numeric($_GET['id_delivery'])) {
            header("location: lista_pedidos.php");
        }else {
            include_once "../../conexion.php";
    
            $id_delivery = $_GET['id_delivery'];
            $id_cliente = $_GET['id_cliente'];
            $estado_entrega = '';
    
            $alert = "";
    
            $sql = mysqli_query($conn,"SELECT d.cod_producto, d.precio_venta, d.cantidad, d.id_cliente,
                                                            p.nombre, p.descripcion
                                                    FROM detalle_delivery d
                                                    INNER JOIN producto p
                                                    ON p.id_producto = d.cod_producto
                                                    WHERE id_delivery = $id_delivery;");
            $result = mysqli_num_rows($sql);
    
            $info_pedido = mysqli_query($conn,"SELECT estado_entrega FROM delivery WHERE id_delivery = $id_delivery");
            $resultao = mysqli_fetch_assoc($info_pedido);

        }
    }
}

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    
    <title>Pedido #<?php echo $id_delivery; ?></title>

    <?php
        include "../../php/usefull/cabecera.php";
    ?>
  </head>

  <body>

  <section id="container" >
      <!--header start-->
        <?php
            
            require "../../php/usefull/header.php";

        ?>
      <!--header end-->

      <!--sidebar start-->

        <?php
        
            require "../../php/usefull/sidebar.php";
        
        ?>

      <!--sidebar end-->

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


                            <h2 style="display: contents;">Pedido #<?php echo $id_delivery; ?></h2>

                            <?php 
                                $estatus = $resultao['estado_entrega'];
                                if ($estatus == 0) {
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_pendiente">Pendiente</span>';
                                }else if($estatus == 1){
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_aprobado">Aprobado</span>';
                                }else if($estatus == 2){
                                    $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_cancelado">Cancelado</span>';
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
                                                <td style="text-align: center;"><?php echo $data['cod_producto']; ?></td>
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

                            <!-- QUERY PARA INCLUIR LOS DATOS DEL CLIENTE -->

                            <?php
                                $asigned_client = @mysqli_query($conn,"SELECT d.id_delivery, d.id_cliente, c.nombre, c.apellido, 
                                                                            c.telefono, dir.direccion, c.usuario, c.cedula
                                                                    FROM detalle_delivery d
                                                                    INNER JOIN cliente c ON d.id_cliente = c.id_cliente
                                                                    INNER JOIN direccion dir ON dir.id_cliente = c.id_cliente
                                                                    WHERE id_delivery = $id_delivery");
                            ?>

                            <div>
                                <h3 class="text-secondary">Información del cliente</h3>
                                <table class="table table-info table-bordered tbl_venta">
                                    <thead class="table_headers">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Dirección</th>
                                            <th>Nombre de usuario</th>
                                            <th>Cédula</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle_venta">
                                        <tr>
                                            <?php 
                                            while ($data = mysqli_fetch_assoc($asigned_client)) {
                                            ?>
                                                <td><?php echo $data['nombre']; ?></td>
                                                <td><?php echo $data['apellido']; ?></td>
                                                <td><?php echo $data['direccion']; ?></td>
                                                <td><?php echo $data['usuario']; ?></td>
                                                <td><?php echo $data['cedula']; ?></td>
                                                <td><?php echo $data['telefono']; ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>

                            <div>
                                <h3 class="text-secondary">Acciones</h3>
                                <?php 
                                    if ($_SESSION['admin']['rol'] != '1') {
                                ?>
                                    <p>Solamente un administrador tiene los permisos para autorizar o denegar pedidos.</p>
                                <?php 
                                    }else{
                                ?>
                                    <button class="btn_general approved">Aprobar</button>
                                    <button class="btn_general denied">Denegar</button>
                                <?php
                                    }
                                ?>
                            </div>
                            
                            <br>

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
