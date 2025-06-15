<?php

    session_start();
    $alert = '';

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../modelos/productos.php";

        $consulta = @mysqli_query($conn, "SELECT * FROM producto");

        if (!empty($_POST)) {
            if (!empty($_POST['txt_cod_producto']) && !empty($_POST['cant_prod'])) {
        
                if (is_numeric($_POST['txt_cod_producto']) && is_numeric($_POST['cant_prod'])) {
                    
                    require "../../conexion.php";
                    require "../../php/funciones/CRUDS.php";
                    
                    $id_producto = $_POST['txt_cod_producto'];
                    $cant_producto = $_POST['cant_prod'];
        
                    $stock_actual = mysqli_query($conn,"SELECT stock FROM producto WHERE id_producto = $id_producto");
                    $cant_actual = mysqli_fetch_assoc($stock_actual);
                    $nuevo_stock = ($cant_actual['stock'] + $cant_producto);
        
                    if ($cant_producto > 0) {
                        $sql = mysqli_query($conn,"UPDATE producto SET stock = $nuevo_stock WHERE id_producto = $id_producto");
        
                        if ($sql) {
                            registrarBitacora($_SESSION['admin']['id_empleado'],$_SESSION['admin']['nombre'],"ha cargado ".$cant_producto." unidades del producto #".$id_producto,"CARGA",$conn);
                            
                            if ($cant_producto == 1) {
                                $alert = "Se ha cargado exitosamente ".$cant_producto." unidad del producto SKU: ".$id_producto;
                            }else if($cant_producto > 1){
                                $alert = "Se han cargado exitosamente ".$cant_producto." unidades del producto SKU: ".$id_producto;
                            }

                        }else {
                            $alert = "Algo salió mal durante la carga del producto";
                        }
                    }else {
                        $alert = "No se pueden cargar 0 unidades de un producto, por favor, introduzca el valor real a cargar.";
                    }
        
                }
        
            }else {
                $alert = "El ID o la cantidad están vacías. Debe asegurarse de que todos los datos sean válidos.";
            }
        }
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
                
                
                <h3><i class="fa fa-newspaper-o"></i> Artículos</h3> <a href="agregarProducto.php" class="btn btn-primary"><i class="bi bi-plus"></i> Registrar nuevo producto</a>
                <!-- BASIC FORM ELELEMNTS -->

                <?php

                if ($alert != '') {
                ?>

                <div class="contentAlert">
                    <?php echo $alert;?>
                </div>

                <?php
                }
                
                ?>

                <div class="row mt">
                    <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Cargar unidades de producto</h4>
                        <form class="form-horizontal style-form" action="" method="POST">
                            <div class="form-group"
                                style="display: flex;align-content: center;justify-content: center;align-items: flex-end;flex-wrap: wrap;"
                            >
                                <label class="col-sm-2 col-sm-2 control-label">SKU de producto:</label>
                                <td><input type="text" name="txt_cod_producto" id="txt_producto" required></td>
                            </div>
                            <div class="form-group" style="padding:0.5em;">
                                <table class="table table-info">
                                    <thead 
                                        style="background: #33539E;color: white;"
                                    >
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Stock Actual</th>
                                            <th>Stock Min.</th>
                                            <th>Stock Max</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="txt_nom_prod"></td>
                                            <td id="txt_desc_prod"></td>
                                            <td id="txt_stock_prod"></td>
                                            <td id="txt_smin_prod"></td>
                                            <td id="txt_smax_prod"></td>
                                            <td id="txt_cant_prod"><input type="number" name="cant_prod" id="cant_prod" disabled required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10" style="width:100%; display:flex; justify-content:center;">
                                    <input style="background: #7272df; color: white; width:60%;" type="submit" name="boton_cargar" class="form-control" value="Cargar">
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
    <script src="../../assets/js/jquery.sparkline.js"></script>
    <script src="../../js/functions.js"></script>


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>
	
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
