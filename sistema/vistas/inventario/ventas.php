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

        $sql = @mysqli_query($conn, "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, c.nombre_categoria FROM producto p 
                                    INNER JOIN categoria_producto c ON p.id_categoria = c.id_categoria 
                                    WHERE estado = 1
                                    LIMIT $desde, $por_pagina");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>

    <title>Inventario</title>

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
                
                <h3><i class="fa fa-angle-right"></i> Ventas</h3>
                

                <div class="datos_cliente">
                    <div class="action_cliente">
                        <h4>Datos del cliente</h4>
                        <a href="#" class="btn_new_cliente btn btn-success"><i class="fas fa-plus"> Nuevo cliente</i></a>
                    </div>
                    <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
                        <input type="hidden" name="action" value="addCliente">
                        <input type="hidden" name="idCliente" id="idCliente" value="" required>
                        <div class="wd30">
                            <label>Cédula:</label>
                            <input type="text" name="cedula_cliente" id="cedula_cliente">
                        </div>
                        <div class="wd30">
                            <label>Nombre:</label>
                            <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
                        </div>
                        <div class="wd30">
                            <label>Teléfono:</label>
                            <input type="text" name="tel_cliente" id="tel_cliente" disabled required>
                        </div>
                        <div class="wd100">
                            <label>Dirección:</label>
                            <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
                        </div>
                        <div id="div_registro_cliente" class="wd100">
                            <button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i> Guardar</button>
                        </div>
                    </form>
                </div>

                <div class="centrarContentPanel">
                    <table class="tbl_venta">
                        <thead>
                            <tr class="table_headers">
                                <th width="100px">Código</th>
                                <th>Descripcion</th>
                                <th>Existencia</th>
                                <th width="100px">Cantidad</th>
                                <th class="textright">Precio</th>
                                <th class="textright">Precio Total</th>
                                <th>Acción</th>
                            </tr>
                                <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                                <td id="txt_descripcion">-</td>
                                <td id="txt_existencia">-</td>
                                <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                                <td id="txt_precio" class="textright">0.00</td>
                                <td id="txt_precio_total" class="textright">0.00</td>
                                <td><a href="#" id="add_product_venta" class="link_add"> Agregar</a></td>
                            <tr>
                            </tr>
                            <tr>
                                <th>Código</th>
                                <th colspan="2">Descripción</th>
                                <th>Cantidad</th>
                                <th class="textright">Precio</th>
                                <th class="textright">Precio Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="detalle_venta">
                            <!-- CONTENIDO DE AJAX -->
                        </tbody>
                        <tfoot id="detalle_totales">
                            <!-- CONTENIDO DE AJAX -->
                        </tfoot>
                    </table>
                </div>

                <div class="datos_venta">
                    <h4>Datos de la venta</h4>
                    <div class="datos">
                        <div class="wd50">
                            <label>Vendedor</label>
                            <p><?php echo $_SESSION['admin']['nombre']; ?></p>
                        </div>
                        <div class="wd50">
                            <label>Acciones</label>
                            <div class="acciones_venta">
                                <a href="#" class="btn_ok btn btn-danger textcenter" id="btn_anular_venta">Anular</a>
                                <a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display:none;">Procesar</a>
                            </div>
                        </div>
                    </div>
                </div>

		    </section><!-- /wrapper -->
        </section><!-- /MAIN CONTENT -->








      <!--main content end-->
  </section>

    <script type="text/javascript">
        $(document).ready(function(){
            var usuarioId = '<?php echo $_SESSION['admin']['id_empleado']; ?>';
            searchForDetalle(usuarioId);
        });
    </script>

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
