<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        
        $estado_entrega = '';

        $sql = mysqli_query($conn,"SELECT d.id_delivery, d.id_cliente, d.fecha_entrega, d.estado_entrega, d.monto_total, 
                                                c.nombre, m.tipo_pago, dir.direccion
                                                FROM delivery d
                                                INNER JOIN cliente c ON d.id_cliente = c.id_cliente
                                                INNER JOIN metodo_pago m ON d.metodo_pago = m.id_metodo
                                                INNER JOIN direccion dir ON d.direccion = dir.id");
        $result = mysqli_num_rows($sql);
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    <title>Lista de pedidos a domicilio</title>

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
                        <div class="content-panel">
                            <!-- <form action="../../controladores/productos/buscarProductos.php" method="GET" class="form_search">
                                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                                <input type="submit" value="Buscar" class="btn_search">
                            </form> -->
                            <table class="table table-striped table-advance table-hover" id="listaPedidos">
	                  	  	    <h4><i class="fa fa-angle-right"></i> Pedidos a domicilio</h4>
	                  	  	    <hr>

                                <thead class="table_headers">
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> Nro. pedido</th>
                                        <th><i class="fa fa-bullhorn"></i> Cliente</th>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Fecha</th>
                                        <th><i class="fa fa-bookmark"></i> Estado</th>
                                        <th><i class=" fa fa-edit"></i> Dirección</th>
                                        <th><i class=" fa fa-edit"></i> Monto total</th>
                                        <th><i class=" fa fa-edit"></i> Medio de pago</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        if ($result > 0) {
                                            
                                            while ($data = @mysqli_fetch_array($sql)) {
                                            
                                                switch ($data['estado_entrega']) {
                                                    case 0:
                                                        $estado_entrega = '<span class="pedido_pendiente">Pendiente</span>';
                                                        break;
                                                    case 1:
                                                        $estado_entrega = '<span class="pedido_aprobado">Aprobado</span>';
                                                        break;
                                                    case 2:
                                                        $estado_entrega = '<span class="pedido_cancelado">Cancelado</span>';
                                                        break;
                                                    default:
                                                        $estado_entrega = '<span class="pedido_pendiente">Pendiente</span>';
                                                        break;
                                                }
                                    ?>

                                    <tr class="row_<?php echo $data['id_delivery']; ?>">
                                        <td style="padding:15px;"><?php echo $data['id_delivery']; ?></td>
                                        <td style="padding:15px;"><?php echo $data['nombre']; ?></td>
                                        <td style="padding:15px;"><?php echo $data['fecha_entrega']; ?></td>
                                        <td style="padding:15px;"><?php echo $estado_entrega; ?></td>
                                        <td style="padding:15px;"><?php echo $data['direccion']; ?></td>
                                        <td style="padding:15px;"><?php echo $data['monto_total']; ?></td>
                                        <td style="padding:15px;"><?php echo $data['tipo_pago']; ?></td>
                                        <td>
                                            <a href="detalle_delivery.php?id_delivery=<?php echo $data['id_delivery']; ?>&id_cliente=<?php echo $data['id_cliente']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>

                                    <?php
                                    
                                            }
                                        }
                                    
                                    ?>

                                </tbody>
                            </table>

                        </div><!-- /content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- /row -->

		    </section><!-- /wrapper -->
        </section><!-- /MAIN CONTENT -->








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
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>
    <!-- DATATABLE -->
    <script>
        $('#listaPedidos').DataTable({
            destroy: true, // Permite reinicializar la tabla en cada carga
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No hay datos disponibles en la tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            } // Eliminar la coma aquí
        });
        $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#listaPedidos')) {
            $('#listaPedidos').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                }
            });
        }
    });
    </script>

	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: '¡Bienvenido a PyR Cosmetics!',
            // (string | mandatory) the text inside the notification
            text: 'Disfrute su experiencia.',
            // (string | optional) the image to display on the left
            image: '../../assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
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
