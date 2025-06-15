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
                                    p.stock, p.stock_min, p.stock_max, p.imagen, p.marca, p.cod_barra,
                                    c.nombre_categoria FROM producto p 
                                    INNER JOIN categoria_producto c ON p.id_categoria = c.id_categoria 
                                    WHERE estado = 1 AND id_producto != 115005451
                                    ORDER BY id_producto DESC
                                    LIMIT $desde, $por_pagina");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    
    <title>Cargar usuarios por CSV</title>

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
                    <div class="contentPanel centrarContentPanel">
                        <h2>Paso a paso</h2>
                        <div class="contentPanel centrarContentPanel" style="background:white; width:50%; border-radius:5px;">
                            <h4 style="margin:1em;">#1 - Descargar la plantilla</h4>
                            <img style="border-radius:5px; width:90%;" src="../../imagenes/plantillas/usuarios/prt-1.png" alt="">
                            <span style="width:60%; margin:1em;">Para empezar, debe hacer click en el botón descargar en la parte final
                                  del documento. Esto al descargarse, podrá acceder al documento de tipo CSV
                                  y comenzar a cargar los datos.
                            </span>
                        </div>
                    </div>
                    <div class="contentPanel centrarContentPanel">
                        <div class="contentPanel centrarContentPanel" style="background:white; width:50%; border-radius:5px;">
                            <h4 style="margin:1em;">#2 - Llenar el formato</h4>
                            <img style="border-radius:5px; width:90%;" src="../../imagenes/plantillas/productos/prt-2.png" alt="">
                            <span style="width:60%; margin:1em;">
                                Ahora debemos abrir el archivo y, de acuerdo al formato, ingresar los datos en orden,
                                primero el nombre de usuario, luego el nombre, apellido, correo, clave y el número de 
                                teléfono del usuario.  Una vez concretado este paso, hacemos click en 
                                el ícono <i class="fa fa-floppy-o" aria-hidden="true"></i> arriba a la izquierda'.
                            </span>
                        </div>
                    </div>
                    <div class="contentPanel centrarContentPanel">
                        <div class="contentPanel centrarContentPanel" style="background:white; width:50%; border-radius:5px;">
                            <h4 style="margin:1em;">#3 - Cargar archivo</h4>
                            <img style="border-radius:5px; width:90%;" src="../../imagenes/plantillas/productos/prt-3.png" alt="">
                            <span style="width:60%; margin:1em;">
                                Ahora nos dirigimos a <a href="../usuarios/lista_usuarios.php" style="text-decoration:underline;">lista de usuarios</a> 
                                y seleccionamos el botón <span class="btn btn_excel" style="cursor:default;"><i class="fa fa-table" aria-hidden="true"></i> Cargar archivo CSV</span> 
                                y seleccionamos el botón 'Cargar archivo'.
                            </span>
                        </div>
                    </div>
                    <div class="contentPanel centrarContentPanel">
                        <div class="contentPanel centrarContentPanel" style="background:white; width:50%; border-radius:5px;">
                            <h4 style="margin:1em;">#4 - Subir archivo</h4>
                            <img style="border-radius:5px; width:90%;" src="../../imagenes/plantillas/productos/prt-4.png" alt="">
                            <span style="width:60%; margin:1em;">
                                Haremos click en el botón 'Cargar archivo', tras lo cual tendremos que seleccionar 
                                el documento CSV modificado donde hemos cargado los usuarios. Una vez hecho esto, 
                                haremos click en el botón 'Subir archivo'.
                            </span>
                        </div>
                    </div>
                    <div class="contentPanel centrarContentPanel">
                        <div class="contentPanel centrarContentPanel" style="background:white; width:50%; border-radius:5px;">
                            <h4 style="margin:1em;">#5 - Verificar cambios</h4>
                            <img style="border-radius:5px; width:90%;" src="../../imagenes/plantillas/productos/prt-5.png" alt="">
                            <span style="width:60%; margin:1em;">
                                En la lista de productos verificamos que los usuarios que hemos cargado en el archivo CSV se 
                                hayan añadido al sistema.
                            </span>
                        </div>
                    </div>
                    <div class="contentPanel centrarContentPanel" style="margin-bottom: 5em;">
                        <a href="archivos/usuarios.csv" class="btn btn_excel"><i class="fa fa-download" aria-hidden="true"></i> Descargar archivo CSV</a>
                    </div>
                </div>
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


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>	
	

  </body>
</php>
