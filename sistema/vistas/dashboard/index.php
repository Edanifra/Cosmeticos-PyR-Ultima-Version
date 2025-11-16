<?php

	session_start();

	require "../../conexion.php";
	require "../../php/funciones/CRUDS.php";

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }

	$sql = @mysqli_query($conn,"SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.imagen, c.nombre_categoria FROM producto p 
											INNER JOIN categoria_producto c ON p.id_categoria = c.id_categoria 
											WHERE estado = 1");
    
    // productos
    $p = mysqli_query($conn, "SELECT COUNT(*) AS total FROM producto WHERE estado = 1");
    $row = mysqli_fetch_assoc($p);
    $total_productos = $row['total'];

    // clientes
    $c = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cliente");
    $row = mysqli_fetch_assoc($c);
    $clientes = $row['total'];

    // pedidos
    $ped = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pedido");
    $row = mysqli_fetch_assoc($ped);
    $pedidos = $row['total'];
    
    // Solicitudes
    $sol = mysqli_query($conn, "SELECT COUNT(*) AS total FROM solicitud_cedula");
    $row = mysqli_fetch_assoc($sol);
    $solicitudes = $row['total'];

    // Bitácora
    $bit = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bitacora");
    $row = mysqli_fetch_assoc($bit);
    $bitacora = $row['total'];

    // Consulta para obtener productos con stock bajo
    $sql = "SELECT c.nombre_categoria AS categoria, SUM(df.cantidad) AS total_vendido
        FROM detallefactura df
        INNER JOIN producto p ON df.codproducto = p.id_producto
        INNER JOIN categoria_producto c ON p.id_categoria = c.id_categoria
        WHERE df.codproducto != 115005451
        GROUP BY c.id_categoria
        ORDER BY total_vendido DESC
        LIMIT 15;"; // Cambia la condición según tu lógica
    $resultado = mysqli_query($conn, $sql);
    
    $categorias = [];
    
    while ($result = mysqli_fetch_assoc($resultado)) {
        $categorias[] = $result;
    }
    $categorias_json = json_encode($categorias);

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

              	<div class="contentPanel centrarContentPanel">
                    <div class="row" style="background:white; margin-top:2em; border-radius:5px;">
                        <div class="col-lg-9 main-chart">
                    
                            <div class="row mtbox">
                                <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                                    <div class="box1">
                                        <span class="li_heart"></span>
                                        <h3><?php echo $bitacora; ?></h3>
                                    </div>
                                        <p><?php echo $bitacora; ?> Entradas en la bitácora</p>
                                </div>
                                <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                        <span class="li_cloud"></span>
                                        <h3><?php echo $pedidos; ?></h3>
                                    </div>
                                        <p><?php echo $pedidos; ?> Pedidos registrados</p>
                                </div>
                                <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                        <span class="li_stack"></span>
                                        <h3><?php echo $total_productos; ?></h3>
                                    </div>
                                        <p>Tienes <?php echo $total_productos; ?> productos registrados.</p>
                                </div>
                                <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                        <span class="li_news"></span>
                                        <h3><?php echo $solicitudes; ?></h3>
                                    </div>
                                        <p><?php echo $solicitudes; ?> Solicitudes registradas</p>
                                </div>
                                <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                        <span class="li_data"></span>
                                        <h3><?php echo $clientes; ?></h3>
                                    </div>
                                        <p><?php echo $clientes; ?> Clientes registrados</p>
                                </div>		
                            </div>
                            
                        </div><!-- /row mt -->	
                    </div>
                </div>

			</section>
            <section class="wrapper">
                
                <h3><i class="fa fa-angle-right"></i> Productos más vendidos</h3>
                
                <div class="tab-pane" id="chartjs">
                    <div class="row mt">
                        <div class="col-lg-6">
                            <div class="content-panel reporte">
                                <div class="panel-body text-center">
                                    <canvas id="mychart" height="300" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="content-panel reporte">
                                <div class="panel-body text-center">
                                    <canvas id="my2" height="300" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>

		    </section><!-- /wrapper -->

      <!--main content end-->
  </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Convertir el JSON a un objeto de JavaScript
            const categorias = <?php echo $categorias_json; ?>;
            // Extraer las etiquetas y los datos
            const labels = categorias.map(cat => cat.categoria);
            const data = categorias.map(cat => cat.total_vendido);
            console.log(labels); // Verifica los labels
            console.log(data); // Verifica los datos
            // Crear la primera gráfica
            var ctx = document.getElementById("mychart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad',
                        data: data, // Aquí deberías pasar solo data sin corchetes adicionales
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56','#FF3356'], // Colores para las secciones
                    }]
                }
            });
            // Crear la segunda gráfica
            var second = document.getElementById("my2").getContext("2d");
            var myChart2 = new Chart(second, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad',
                        data: data, // Aquí también
                        backgroundColor: '#36A2EB', // Color para las barras
                    }]
                }
            });
        });
    </script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="../../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../../assets/js/jquery.sparkline.js"></script>
    <script src="../../js/functions.js"></script>


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
