<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";

        $sql = @mysqli_query($conn, "SELECT f.nro_factura, f.fecha, f.total_factura, f.cliente, f.estado,
                                     u.nombre as vendedor,
                                     cl.id_cliente, cl.nombre as cliente
                                     FROM factura f
                                     INNER JOIN empleado u
                                     ON f.empleado = u.id_empleado
                                     INNER JOIN cliente cl
                                     ON f.cliente = cl.id_cliente");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    <title>Facturas</title>
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

                        <!--<div class="search_date">
                            <h4>Buscar por fecha</h4>
                            <form action="buscarVentas.php" method="GET" class="form_search_date">
                                <label for="">Buscar desde:</label>
                                <input type="date" name="fecha_desde" id="fecha_desde" required>
                                <label for="">Hasta:</label>
                                <input type="date" name="fecha_a" id="fecha_hasta" required>
                                <button type="submit" class="btn_view"><i class="fas fa-search"></i></button>
                            </form>
                        </div>-->

                        <div class="content-panel">
                            <table class="table table-striped table-advance table-hover" id="listaVentas">
	                  	  	    <h4 style="display:contents;"><i class="fa fa-angle-right" style="margin:10px;"></i> Facturas procesadas</h4>
                                <a href="ventas.php" class="btn_new"><i class="fas fa-user-plus"></i> Procesar nueva factura</a>

                                <thead class="table_headers">
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> Nro. de factura</th>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Fecha / Hora</th>
                                        <th><i class="fa fa-bookmark"></i> Cliente</th>
                                        <th><i class="fa fa-bookmark"></i> Vendedor</th>
                                        <th><i class="fa fa-bookmark"></i> estado</th>
                                        <th><i class="textright"></i> Total Factura</th>
                                        <th><i class="textright"></i> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        while ($data = @mysqli_fetch_array($sql)) {
                                            
                                            if ($data['estado'] == 1) {
                                                $estado = '<span class="pagada">Pagada</span>';
                                            }else {
                                                $estado = '<span class="anulada">Anulada</span>';
                                            }
                                    
                                    ?>

                                    <tr id="row_<?php echo $data['nro_factura']; ?>">
                                        <td><?php echo $data['nro_factura']; ?></td>
                                        <td><?php echo $data['fecha']; ?></td>
                                        <td><?php echo $data['cliente']; ?></td>
                                        <td><?php echo $data['vendedor']; ?></td>
                                        <td class="estado"><?php echo $estado; ?></td>
                                        <td><span>Bs.</span><?php echo $data['total_factura']; ?></td>
                                        <td>
                                            <button class="btn_view view_factura" type="button" 
                                                cl="<?php echo $data['id_cliente']; ?>" f="<?php echo $data['nro_factura']; ?>"><i class="fa-solid fa-eye"></i></button>
                                            
                                            <?php

                                            if ($_SESSION['admin']['rol'] == 1) {
                                                if ($data['estado'] == 1) {
                                            ?>
                                                <div class="div_acciones">
                                                    <button class="btn btn-danger btn-xs anular_factura" fac="<?php echo $data['nro_factura']; ?>"><i class="fa-solid fa-ban"></i></button>
                                                </div>
                                            <?php
                                                }else {
                                            ?>
                                            <button class="btn btn-xs btn-anulada"><i class="fa-solid fa-ban"></i></button>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </td>
                                    </tr>

                                    <?php
                                    
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
        $('#listaVentas').DataTable({
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
        if (!$.fn.DataTable.isDataTable('#listaVentas')) {
            $('#listaVentas').DataTable({
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
