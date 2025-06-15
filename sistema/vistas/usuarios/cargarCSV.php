<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        

        $total_registro = contarRegistros($conn,"empleado");
        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        }else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $sql = @mysqli_query($conn, "SELECT * FROM empleado
                                    WHERE estado = 1
                                    ORDER BY id_empleado DESC
                                    LIMIT $desde, $por_pagina");
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

    <title>Cargar archivo CSV</title>

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
    <script src="../../js/functions.js"></script>
    
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
                        <div class="content_panel centrarContentPanel">
                            <div style="padding: 1em;background: white;border-radius: 5px; width: 55%;">
                                <form action="../../controladores/usuarios/cargar_excel.php" method="POST" enctype="multipart/form-data">
                                    <input type="file" style="display:none;" name="cargar_excel_usu" id="cargar_excel_usu" required>
                                    <div class="modalButtons">
                                        <label for="cargar_excel_usu" class="btn btn_excel"><i class="fa fa-table"></i> Cargar archivo</label>
                                        <button type="submit" class="btn btn-primary">Subir archivo</button>
                                    </div>
                                </form>

                                <div style="margin-top: 20px;">
                                    <h4 style="text-align:center;"><i class="fa fa-exclamation-triangle"></i> IMPORTANTE</h4>
                                    <p>* Recuerde que el archivo a subir es la plantilla 
                                        modificada con los productos que desee añadir. NO 
                                        MODIFIQUE EL FORMATO.</p>
                                    <p>* La plantilla es formato CSV, el único formato que el sistema 
                                        le permitirá subir.</p>
                                    <p>* Si no posee la plantilla para cargar productos, <a href="../plantillas/index.php" class="text-info" style="font-weight:900;">haga click aquí.</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="content-panel">
                            <table class="table table-info table-bordered table-hover">
	                  	  	    <h4><i class="fa fa-list"></i> Lista de usuarios</h4>

                                <thead>
                                    <tr>
                                        <th class="table_headers"><i class="fa fa-bullhorn"></i> ID usuario</th>
                                        <th class="table_headers"><i class="fa fa-bullhorn"></i> Nombre</th>
                                        <th class="table_headers" style="width: 200px;"> Apellido</th>
                                        <th class="table_headers" class="hidden-phone" style="width: 250px;"> Correo</th>
                                        <th class="table_headers" class="hidden-phone"> Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        while ($data = @mysqli_fetch_array($sql)) {
                                            
                                    
                                    ?>

                                    <tr class="row_<?php echo $data['id_empleado']; ?>">
                                        <td><?php echo $data['id_empleado']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['apellido']; ?></td>
                                        <td><?php echo $data['correo']; ?></td>
                                        <td><?php echo $data['telefono']; ?></td>
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
    <script src="../../js/functions.js"></script>
    <script src="https://kit.fontawesome.com/d369b98639.js" crossorigin="anonymous"></script>


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
