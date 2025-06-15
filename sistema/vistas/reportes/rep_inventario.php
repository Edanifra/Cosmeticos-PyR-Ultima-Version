<?php

session_start();

if (empty($_SESSION['admin']['activo'])) {
    header("location: ../../../");
} else {
    require "../../conexion.php";
    require "../../php/funciones/CRUDS.php";
    
    // Obtener el total de registros
    $total_registro = contarRegistros($conn, "producto");
    $por_pagina = 5;
    $pagina = empty($_GET['pagina']) ? 1 : $_GET['pagina'];
    $desde = ($pagina - 1) * $por_pagina;
    $total_paginas = ceil($total_registro / $por_pagina);
    
    // Consulta para obtener productos con stock bajo
    $sql = "SELECT id_producto, nombre, stock, stock_min, stock_max FROM producto WHERE stock < stock_min"; // Cambia la condición según tu lógica
    $resultado = mysqli_query($conn, $sql);
    
    $productos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $productos[] = $row;
    }
    
    // Convertir el array a JSON
    $productos_json = json_encode($productos);
}

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Reporte de inventario</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/lineicons/style.css">    
    <link rel="stylesheet" href="../../css/estilazo.css">
    
    <!-- Custom styles for this template -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../assets/css/style-responsive.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/helpers.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/helpers.min.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/html2canvas.min.js"></script>
    <script src="../../js/jspdf.min.js"></script>
    
    <!-- php shim and Respond.js IE8 support of php elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/php/3.7.0/php.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                
                <h3><i class="fa fa-angle-right"></i> Reporte de inventario general</h3>

		    </section><!-- /wrapper -->
            <section>
                <div style="padding:5%;">

                    <button class="btn btn-primary" id="verPDF" style="outline:none; margin:10px;">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar reporte en PDF
                    </button>

                    <div
                        class="table-responsive"
                        style="background: white;"
                        id="tabla_reporte_ventas"
                    >
                        <div class="membrete">
                            <img src="../../imagenes/logo/pyrcosmetics.png" alt="">
                            <span>
                                <h2>PYR COSMETICS C.A</h2>
                                <p>Zona Comercial La Mora, calle 37, Venezuela, Edo. Aragua</p>
                                <p>RIF: J-00015646483</p>
                                <p>Teléfono: 0424-598-0204</p>
                                <p>Email: pyrcosmetics@gmail.com</p>
                            </span>
                            <div class="fecha">
                                <h4>Fecha: </h4><span id="fecha"></span>
                                <h4>Hora: </h4><span id="hora"></span>
                            </div>
                        </div>

                        <div class="tituloReporte">
                            <h3>Reporte de Productos</h3>
                        </div>

                        <table
                            class="table table-bordered table-primary"
                        >
                            <thead class="table_headers">
                                <tr>
                                    <th style="font-weight:900;" scope="col">SKU</th>
                                    <th style="font-weight:900;" scope="col">Cod. Barra</th>
                                    <th style="font-weight:900;" scope="col">Nombre</th>
                                    <th style="font-weight:900;" scope="col">Descripcion</th>
                                    <th style="font-weight:900;" scope="col">Categoría</th>
                                    <th style="font-weight:900;" scope="col">Stock</th>
                                    <th style="font-weight:900;" scope="col">Precio</th>
                                </tr>
                            </thead>

                            <?php 
                            $sql2 = mysqli_query($conn,"SELECT p.id_producto, p.cod_barra, p.nombre,
                                                               p.descripcion, c.nombre_categoria, p.precio,
                                                               p.stock 
                                                        FROM producto p
                                                        INNER JOIN categoria_producto c
                                                        ON c.id_categoria = p.id_categoria
                                                        WHERE p.id_producto != 115005451");
                            while($data = mysqli_fetch_assoc($sql2)){?>

                            <tbody>
                                <tr class="">
                                    <td><?php echo $data['id_producto'];?></td>
                                    <td><?php echo $data['cod_barra'];?></td>
                                    <td><?php echo $data['nombre']; ?></td>
                                    <td><?php echo $data['descripcion']; ?></td>
                                    <td><?php echo $data['nombre_categoria']; ?></td>
                                    <td><?php echo $data['stock']; ?></td>
                                    <td><?php echo $data['precio']; ?></td>
                                </tr>
                            </tbody>

                            <?php } ?>

                        </table>
                    </div>
                    
                </div>
            </section>
        </section><!-- /MAIN CONTENT -->








      <!--main content end-->
  </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function actualizarFechaHora() {
                const ahora = new Date();

                // Formatear la fecha y hora
                const opcionesFecha = { year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = ahora.toLocaleDateString('es-VE', opcionesFecha); // Formato de fecha para Venezuela
                const horaFormateada = ahora.toLocaleTimeString('es-VE'); // Hora en formato local

                // Insertar la fecha y hora en el HTML
                document.getElementById('fecha').textContent = fechaFormateada;
                document.getElementById('hora').textContent = horaFormateada;
            }

            // Actualizar la fecha y hora inicialmente
            actualizarFechaHora();

            // Opcional: Actualizar la hora cada segundo (si es necesario)
            setInterval(actualizarFechaHora, 1000);
        });
    </script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../../assets/js/jquery.sparkline.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script>
    <script src="../../js/functions.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/html2canvas.min.js"></script>
    <script src="../../js/jspdf.min.js"></script>


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>	
  </body>
</php>
