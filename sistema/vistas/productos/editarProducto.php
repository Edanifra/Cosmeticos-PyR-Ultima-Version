<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        
        if (!empty($_GET['id_producto'])) {
            
            $id = $_GET['id_producto'];

            $data = buscarProducto($conn, $id);
            $categoria = buscarCategoria($conn);

        }else {
            header("location: listaProductos.php");
        }

    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    
    <title>Editar producto</title>

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
               
                <h3><i class="fa fa-newspaper-o"></i> Artículos</h3>
                    
                    <!-- BASIC FORM ELELEMNTS -->
                    <div class="row mt">
                        <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Editar producto</h4>
                            <form class="form-horizontal style-form" enctype="multipart/form-data" action="../../controladores/productos/editarProductos.php" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Código de barras</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cod_barra" value="<?php echo $data['cod_barra']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nombre" value="<?php echo $data['nombre']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Descripcion</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="descripcion" value="<?php echo $data['descripcion']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                                    <input type="file" name="imagen" id="imagen">
                                    <!-- Mostrar el nombre de la imagen actual -->
                                    <?php if (!empty($data['imagen'])): ?>
                                        <div style="display: flex;align-items: center;margin: 20px;">
                                            <p style="margin-right:15px;">Imagen actual: <?php echo htmlspecialchars($data['imagen']); ?></p>
                                            <!-- Si quieres mostrar una vista previa de la imagen -->
                                            <img  src="<?php echo '../../imagenes/productos/' . htmlspecialchars($data['imagen']); ?>" alt="Imagen actual" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Marca</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="marca" value="<?php echo $data['marca']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Precio</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="precio" value="<?php echo $data['precio']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Stock</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="stock" value="<?php echo $data['stock']; ?>" class="form-control" value=1 readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Stock mínimo</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="stock_min" value="<?php echo $data['stock_min']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Stock máximo</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="stock_max" value="<?php echo $data['stock_max']; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Categoría</label>
                                    <select name="categoria" class="form-control" style="display: flex; position: relative; left: 1%; width: 81%;">
                                        <?php 
                                            while ($datos = @mysqli_fetch_array($categoria)) {
                                                // Compara el id_categoria del producto actual con el id_categoria de la opción
                                                $selected = ($datos['id_categoria'] == $data['id_categoria']) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $datos['id_categoria']; ?>" <?php echo $selected; ?>> 
                                            <?php echo $datos['nombre_categoria']; ?> 
                                        </option>
                                        <?php 
                                            }
                                        ?>
                                    </select>  
                                </div>

                                <input type="hidden" name="id_producto" value="<?php echo $id; ?>" class="form-control">

                                <div class="form-group">
                                    <div class="col-sm-10" style="width:100%;">
                                        <input style="background: #7272df; color: white;" type="submit" class="form-control" value="Guardar">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div><!-- col-lg-12-->      	
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
