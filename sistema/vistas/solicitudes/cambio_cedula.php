<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";
        

        $total_registro = contarRegistros($conn,"solicitud_cedula");
        $por_pagina = 5;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        }else {
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina - 1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $sql = @mysqli_query($conn, "SELECT s.id_solicitud, s.cedula, s.estado,
                                            c.nombre, c.apellido, c.usuario, c.cedula as cedula_cliente
                                    FROM solicitud_cedula s
                                    INNER JOIN cliente c
                                    ON s.id_cliente = c.id_cliente
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

    <title>Inventario</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/lineicons/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <script src="../../js/functions.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
    
    
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
                
                <h3><i class="fa fa-angle-right"></i> Configuración</h3>
                
                <div class="content-panel">
                            <table class="table table-striped table-advance table-hover">
	                  	  	    <h4 style="display:contents;"><i class="fa fa-angle-right" style="margin:10px;"></i> Solicitudes de cambio de cédula</h4>

                                <thead class="table_headers">
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> ID. solicitud</th>
                                        <th><i class="fa fa-bookmark"></i> Nombre</th>
                                        <th class="hidden-phone"> Apellido</th>
                                        <th><i class="fa fa-bookmark"></i> Usuario</th>
                                        <th><i class="fa fa-bookmark"></i> Cédula</th>
                                        <th><i class="fa fa-bullhorn"></i> Solicitud de cambio</th>
                                        <th><i class="fa fa-bullhorn"></i> Estado</th>
                                        <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        while ($data = @mysqli_fetch_array($sql)) {

                                        $estado_solicitud = $data['estado'];

                                        if ($estado_solicitud == 0) {
                                            $solicitud = "<p>Pendiente</p>";
                                        }else if($estado_solicitud == 1){
                                            $solicitud = "<p>Aprobado</p>";
                                        }else if($estado_solicitud == 2){
                                            $solicitud = "<p>Denegado</p>";
                                        }
                                    
                                    ?>

                                    <tr id="row_<?php echo $data['id_solicitud']; ?>">
                                        <td><?php echo $data['id_solicitud']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['apellido']; ?></td>
                                        <td><?php echo $data['usuario']; ?></td>
                                        <td><?php echo $data['cedula_cliente']; ?></td>
                                        <td id="soli_cedula"><?php echo $data['cedula']; ?></td>
                                        <td><?php echo $solicitud; ?></td>
                                        <td>
                                            <?php
                                                if ($estado_solicitud == 0) {
                                            ?>
                                            <a href="#" solicitud="<?php echo $data['id_solicitud']; ?>" id="aprobar_solicitud" class="btn btn-primary"><i class="bi bi-check"></i></a>
                                            <a href="#" solicitud="<?php echo $data['id_solicitud']; ?>" id="denegar_solicitud" class="btn btn-danger"><i class="bi bi-ban"></i></a>
                                            <?php }else{ ?>
                                                <p>No hay acciones disponibles para esta solicitud.</p>
                                            <?php }?>
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