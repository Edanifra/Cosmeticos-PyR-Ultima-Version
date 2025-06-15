<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../modelos/productos.php";

        $consulta = @mysqli_query($conn, "SELECT * FROM producto");

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
                
                <h3><i class="fa fa-angle-right"></i> Descuentos por ítem</h3>

                <div class="centrarContentPanel">
                    <table class="table table-bordered tbl_venta">
                        <thead class="table_headers">
                            <tr>
                                <th width="100px">Código</th>
                                <th>Descripcion</th>
                                <th>% de descuento</th>
                                <th class="textright">Precio</th>
                                <th class="textright">Precio Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody style="background:white;">
                            <tr>
                                <td><input type="text" name="txt_cod_producto" id="txt_cod_producto" style="outline:none;"></td>
                                <td id="txt_descripcion">-</td>
                                <td>
                                    <select name="porcentaje_descuento" id="porcentaje_descuento" style="outline:none;" disabled>
                                        <option value="5">5%</option>
                                        <option value="10">10%</option>
                                        <option value="15">15%</option>
                                        <option value="20">20%</option>
                                        <option value="25">25%</option>
                                    </select>
                                </td>
                                <td id="txt_precio" class="textright">0.00</td>
                                <td id="txt_precio_total" class="textright">0.00</td>
                                <td><a href="#" id="add_product_desc" style="display:none; color:white;" class="link_add btn btn-success"> Agregar</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br><br>
                <table class="table table-bordered table-info" style="text-align: center;">
                    <thead class="table_headers">
                        <tr>
                            <th>ID. Producto</th>
                            <th colspan="2">% Descuento</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="detalle_desc" style="background:white;">
                    <?php
                        $sql = mysqli_query($conn,"SELECT d.id_producto, d.porcentaje_descuento, p.nombre, p.descripcion 
                                        FROM descuentos d
                                        INNER JOIN producto p 
                                        ON d.id_producto = p.id_producto
                                ");

                        while ($data = mysqli_fetch_assoc($sql)) {?>
                            <tr>
                                <td><?php echo $data['id_producto'] ?></td>
                                <td colspan="2"><?php echo $data['porcentaje_descuento'] ?> %</td>
                                <td><?php echo $data['nombre'] ?></td>
                                <td><?php echo $data['descripcion'] ?></td>
                                <td class="">
                                    <a id="borrar_descuento" class="btn btn-danger" href="#" onclick="borrarDescuento(<?php echo $data['id_producto']; ?>);">Eliminar descuento</a>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>

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
