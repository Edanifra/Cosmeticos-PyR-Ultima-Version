<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";

        $sql = mysqli_query($conn,"SELECT * FROM categoria_producto WHERE id_categoria != 6");

        $colores = @mysqli_query($conn,"SELECT color_principal FROM configuracion");
        $resultado = @mysqli_fetch_assoc($colores);
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    
    <title>Inicio</title>

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
                
                
                <h3><i class="fa fa-newspaper-o"></i> Ajustes</h3> <a href="../categorias/listaCategorias.php" class="btn btn-primary" style="border:1px, solid, <?php echo $resultado['color_principal']; ?>; background:<?php echo $resultado['color_principal']; ?>;"><i class="bi bi-card-list"></i> Lista de categorías</a>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Ajustes de inventario por categoría</h4>
                            
                            <?php
                            while ($data = mysqli_fetch_assoc($sql)) {
                            ?>

                            <button class="btn btn-primary" style="outline:none;border:1px, solid, <?php echo $resultado['color_principal']; ?>; background:<?php echo $resultado['color_principal']; ?>;" id="btn_cat_prod" id_categoria="<?php echo $data['id_categoria']; ?>"><?php echo $data['nombre_categoria']; ?></button>

                            <?php
                            }
                            ?>
                        </div>
                        <div class="form-panel" id="productos_cat">
                            <!-- DATOS DEL AJAX SEGÚN EL BOTÓN PRESIONADO -->
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
    <script src="../../assets/js/jquery.sparkline.js"></script>
    <script src="../../js/functions.js"></script>


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>

  </body>
</php>
