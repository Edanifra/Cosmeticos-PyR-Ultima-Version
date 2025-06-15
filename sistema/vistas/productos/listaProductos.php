<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        

        $total_registro = contarRegistros($conn,"producto");
        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        }else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $sql = @mysqli_query($conn, "SELECT p.id_producto, p.nombre, p.descripcion, p.precio,
                                    p.stock, p.stock_min, p.stock_max, p.imagen,
                                    c.nombre_categoria FROM producto p 
                                    INNER JOIN categoria_producto c ON p.id_categoria = c.id_categoria 
                                    WHERE estado = 1 AND id_producto != 115005451");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    <title>Lista de productos</title>
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
                            <table class="table table-striped table-advance table-hover" id="tablaProductos">
	                  	  	    <h4><i class="fa fa-angle-right"></i> Lista de productos 
                                <a href="agregarProducto.php" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar nuevo producto</a>
                                <a href="#" class="btn btn_excel" id="modal_excel"><i class="fa fa-table"></i> Cargar archivo CSV</a>
                            </h4>
                                
	                  	  	    <hr>

                                <thead
                                    class="table_headers"
                                >
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> Código</th>
                                        <th><i class="fa fa-bullhorn"></i> Nombre</th>
                                        <th class="hidden-phone" style="width: 250px;"><i class="fa fa-question-circle"></i> Descripción</th>
                                        <th class="hidden-phone" style="width:60px;"><i class="fa fa-picture-o"></i> Foto</th>
                                        <th class="hidden-phone"> Stock</th>
                                        <th class="hidden-phone"> Stock Min</th>
                                        <th class="hidden-phone"> Stock Max</th>
                                        <th><i class="fa fa-bookmark"></i> Precio</th>
                                        <th><i class=" fa fa-edit"></i> Categoría</th>
                                        <?php if ($_SESSION['admin']['rol'] == 1) {?><th>Acciones</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        while ($data = @mysqli_fetch_array($sql)) {
                                            
                                    
                                    ?>

                                    <tr class="row_<?php echo $data['id_producto']; ?>">
                                        <td><?php echo $data['id_producto']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['descripcion']; ?></td>
                                        <td>
                                            <?php if (!empty($data['imagen'])) {
                                            ?>
                                                <img style="width: 50%; border-radius: 5px;" src="../../imagenes/productos/<?php echo $data['imagen']; ?>">
                                            <?php
                                            }else{?>
                                                <img style="width: 50%; border-radius: 5px;" src="../../imagenes/productos/imagen_no_disponible.jpeg">
                                            <?php }?>
                                        </td>
                                        <td><?php echo $data['stock']; ?></td>
                                        <td><?php echo $data['stock_min']; ?></td>
                                        <td><?php echo $data['stock_max']; ?></td>
                                        <td><?php echo $data['precio']; ?></td>
                                        <td><?php echo $data['nombre_categoria']; ?></td>
                                        <?php if ($_SESSION['admin']['rol'] == 1) {?>
                                        <td>
                                            <a href="editarProducto.php?id_producto=<?php echo $data['id_producto']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-xs del_product" product="<?php echo $data['id_producto']; ?>" ><i class="fa fa-trash-o "></i></button>
                                        </td>
                                        <?php } ?>
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
        $('#tablaProductos').DataTable({
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
        if (!$.fn.DataTable.isDataTable('#tablaProductos')) {
            $('#tablaProductos').DataTable({
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
