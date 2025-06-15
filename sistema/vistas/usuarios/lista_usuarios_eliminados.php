<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        

        $total_registro = contarRegistros($conn,"empleado");
        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        }else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $sql = @mysqli_query($conn, "SELECT * FROM empleado WHERE estado = 0
                                    LIMIT $desde, $por_pagina");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    <title>Usuarios</title>

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
                
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover" id="usuariosEliminados" style="margin-top:1em;">
	                    <h4 style="display:contents;">Lista de usuarios eliminados</h4>
                        <a href="lista_usuarios.php" style="margin-left:1em;" class="btn btn-primary"><i class="fa fa-plus"></i> Listado de usuarios</a>

                        <thead class="table_headers">
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> ID. usuario</th>
                                <th><i class="fa fa-bookmark"></i> Nombre</th>
                                <th class="hidden-phone"> Apellido</th>
                                <th><i class="fa fa-bookmark"></i> Nombre de usuario</th>
                                <th><i class="fa fa-bookmark"></i> correo</th>
                                <th><i class="fa fa-bookmark"></i> Teléfono</th>
                                <th> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            
                                while ($data = @mysqli_fetch_array($sql)) {
                            
                            ?>

                            <tr id="row_<?php echo $data['id_empleado']; ?>">
                                <td><?php echo $data['id_empleado']; ?></td>
                                <td><?php echo $data['nombre']; ?></td>
                                <td><?php echo $data['apellido']; ?></td>
                                <td><?php echo $data['usuario']; ?></td>
                                <td><?php echo $data['correo']; ?></td>
                                <td><?php echo $data['telefono']; ?></td>
                                <td>
                                    <a href="#" id="btn_restablecer_usuario" id_usuario="<?php echo $data['id_empleado']; ?>" class="btn btn-info"><i class="bi bi-arrow-return-left"></i></a>
                                </td>
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

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>	
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  
    <!-- DATATABLE -->
    <script>
        $('#usuariosEliminados').DataTable({
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
            if (!$.fn.DataTable.isDataTable('#usuariosEliminados')) {
                $('#usuariosEliminados').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                    }
                });
            }
        });
    </script>

  </body>
</php>