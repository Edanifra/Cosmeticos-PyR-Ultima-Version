<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

      if (!empty($_REQUEST) && !empty($_REQUEST['id_video']) && !empty($_REQUEST['title'])) {
        
        $id_video = $_REQUEST['id_video'];
        $titulo = $_REQUEST['title'];

      }else {
        header("location:index.php");
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
            
            
          <div class="centrarContentPanel" style="padding:8%;">
            <h1>Tutorial: <?php echo $titulo; ?></h1>
            <video width="700px" class="fm-video video-js" data-setup="{}" controls id="fm-video">
                <source src="../../imagenes/video/<?php echo $id_video; ?>" type="video/mp4">
            </video>
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
