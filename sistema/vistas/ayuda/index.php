<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";

        $sql = @mysqli_query($conn,"SELECT * FROM tutoriales");
        $result = mysqli_num_rows($sql);
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>
    
    <title>Inicio</title>

    <?php
        include "../../php/usefull/cabecera.php";
    ?>

    <link rel="stylesheet" href="../../css/video-js.min.css">
    <script src="../../js/video.min.js"></script>
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
            
        
          <div class="centrarContentPanel">
            <h2 style="margin: 5%;">Tutoriales del sistema</h2>
            <div style="display:grid; grid-template-columns: repeat(4, 1fr);gap: 1em;">


                <?php 
                
                if($result > 0){
                    while($data = mysqli_fetch_assoc($sql)){
                ?>
                        <div class="col-3" style="max-width:90%;">
                            <div class="card cartita position-relative" style="width:100%;">
                                <a href="verTutorial.php?id_video=<?php echo $data['nombre']; ?>&title=<?php echo $data['titulo']; ?>">
                                    <img 
                                    loading="lazy"
                                    class="card-img-top" 
                                    src="../../imagenes/intro.jpg"
                                    style="height: 100%;width:100%;"
                                    />
                                </a>
                                <div class="cuerpo_carta carta_specs">
                                    <div class="card-body">
                                        <h4 class="card-title titulo_de_carta">
                                            <?php echo $data['titulo']; ?>
                                        </h4>
                                        <p class="card-text"><?php echo $data['descripcion']; ?></p>
                                    </div>
                                    <a href="verTutorial.php?id_video=<?php echo $data['nombre']; ?>&title=<?php echo $data['titulo']; ?>">Ver</a>
                                </div>
                            </div>
                        </div>
                
                <?php
                        }
                    }
                ?>

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
    <script src="../../assets/js/jquery.sparkline.js"></script>
    <script src="../../js/functions.js"></script>

    <script>
        let reproductor = videojs('fm-video',{

            fluid:true

        });
    </script>


    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>

  </body>
</php>
