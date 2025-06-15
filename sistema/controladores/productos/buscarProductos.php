<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";

        $busqueda = strtolower($_REQUEST['busqueda']);

        if (empty($busqueda)) {
            header("location: ../../vistas/productos/listaProductos.php");
        }else {
            $total_registro = contarBusqueda($conn,"producto",$busqueda);
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

                                        WHERE ( p.id_producto LIKE '%$busqueda%' OR
                                                p.nombre      LIKE '%$busqueda%' OR
                                                p.descripcion LIKE '%$busqueda%' OR
                                                p.id_producto LIKE '%$busqueda%' OR
                                                p.precio      LIKE '%$busqueda%')

                                        LIMIT $desde, $por_pagina");
        }

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

    <title>Inicio</title>

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

    <script src="../../assets/js/chart-master/Chart.js"></script>
    
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
                <div class="row mt">
                    <div class="col-md-12">
                        <div class="content-panel">

                            <form action="../../controladores/productos/buscarProductos.php" method="GET" class="form_search">
                                <input type="text" value="<?php echo $busqueda; ?>" name="busqueda" id="busqueda" placeholder="Buscar">
                                <input type="submit" value="Buscar" class="btn_search">
                            </form>


                            <table class="table table-striped table-advance table-hover">
	                  	  	    <h4><i class="fa fa-angle-right"></i> Productos</h4>
	                  	  	    <hr>

                                <thead>
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> Nombre</th>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descripción</th>
                                        <th><i class="fa fa-bookmark"></i> Precio</th>
                                        <th><i class=" fa fa-edit"></i> Categoría</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        while ($data = @mysqli_fetch_array($sql)) {
                                            
                                    
                                    ?>

                                    <tr>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['descripcion']; ?></td>
                                        <td><?php echo $data['precio']; ?></td>
                                        <td><?php echo $data['nombre_categoria']; ?></td>
                                        <td>
                                            <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                            <a href="editarProducto.php?id_producto=<?php echo $data['id_producto']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                        </td>
                                    </tr>

                                    <?php
                                    
                                        }
                                    
                                    ?>

                                </tbody>
                            </table>

                            <div class="paginador">
                                <ul>
                                    <?php
                                    
                                    if ($pagina == 1) {
                                    
                                    ?>

                                    <li class="pageSelected2"> |<< </li>
                                    <li class="pageSelected2"> < </li>

                                    <?php
                                    }else {
                                    ?>

                                    <li><a href="?pagina=<?php echo 1; ?>"> |<< </a></li>
                                    <li><a href="?pagina=<?php echo $pagina - 1; ?>"> < </a></li>

                                    <?php
                                    }

                                    for ($i=1; $i <= $total_paginas; $i++) { 
                                        if ($i == $pagina) {
                                            echo '<li class="pageSelected">'.$i.'</li>';
                                        }else {
                                            echo '<li><a href="?pagina='.$i.'" > '.$i.' </a></li>';
                                        }
                                    }

                                    if($pagina == $total_paginas){
                                    
                                    ?>

                                    <li class="pageSelected2"> > </li>
                                    <li class="pageSelected2"> >>| </li>

                                    <?php
                                    
                                    }else{

                                    ?>

                                    <li><a href="?pagina=<?php echo $pagina + 1; ?>"> > </a></li>
                                    <li><a href="?pagina=<?php echo $total_paginas; ?>"> >>| </a></li>

                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>

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
