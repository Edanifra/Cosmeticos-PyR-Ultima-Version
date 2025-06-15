<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        

        $total_registro = contarRegistros($conn,"cliente");
        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        }else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $sql = @mysqli_query($conn, "SELECT c.id_cliente, c.nombre,
                                                          c.apellido, c.usuario, c.cedula,
                                                          c.correo, c.telefono, c.nacimiento,
                                                          dir.direccion
                                                    FROM cliente c
                                                    INNER JOIN direccion dir
                                                    ON c.id_cliente = dir.id_cliente
                                                    ");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    <title>Clientes</title>
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
                
                <h3></i> Clientes</h3>
                
                <div class="content-panel">
                            <table class="table table-striped table-advance table-hover" id="listaClientes" style="margin-top: 1em;">
	                  	  	    <h4 style="display:contents;"> Lista de clientes</h4>
                                    <a href="agregar_cliente.php" style="margin-left:1em;" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar cliente</a>
                                <br>
                                <thead class="table_headers">
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> ID. usuario</th>
                                        <th><i class="fa fa-bookmark"></i> Nombre</th>
                                        <th class="hidden-phone"> apellido</th>
                                        <th><i class="fa fa-bookmark"></i> Nombre de usuario</th>
                                        <th><i class="fa fa-bullhorn"></i> Cédula</th>
                                        <th><i class="fa fa-bookmark"></i> correo</th>
                                        <th class="hidden-phone"> Dirección</th>
                                        <th><i class="fa fa-bookmark"></i> Teléfono</th>
                                        <th><i class="fa fa-bookmark"></i> F. Nacimiento</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        while ($data = @mysqli_fetch_array($sql)) {
                                    
                                    ?>

                                    <tr id="row_<?php echo $data['id_cliente']; ?>">
                                        <td><?php echo $data['id_cliente']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['apellido']; ?></td>
                                        <td><?php echo $data['usuario']; ?></td>
                                        <td><?php echo $data['cedula']; ?></td>
                                        <td><?php echo $data['correo']; ?></td>
                                        <td><?php echo $data['direccion']; ?></td>
                                        <td><?php echo $data['telefono']; ?></td>
                                        <td><?php echo $data['nacimiento']; ?></td>
                                    </tr>

                                    <?php
                                    
                                        }
                                    
                                    ?>

                                </tbody>
                            </table>

                        </div><!-- /content-panel -->
                

		    </section><!-- /wrapper -->
        </section><!-- /MAIN CONTENT -->








      <!--main content end-->
  </section>

    <script src="../../js/functions.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../../assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../../assets/js/gritter-conf.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>

    <!-- DATATABLE -->
    <script>
        $('#listaClientes').DataTable({
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
        if (!$.fn.DataTable.isDataTable('#listaClientes')) {
            $('#listaClientes').DataTable({
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