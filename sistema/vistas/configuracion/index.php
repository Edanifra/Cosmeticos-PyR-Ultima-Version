<?php

    session_start();

    if (empty($_SESSION['admin']['activo'])) {
        header("location: ../../../");
    }else {

        require "../../conexion.php";
        require "../../php/funciones/CRUDS.php";

        $sql = @mysqli_query($conn, "SELECT * FROM configuracion");

        $tienda = @mysqli_query($conn,"SELECT * FROM tienda");
    }

?>






<!DOCTYPE html>
<php lang="en">
  <head>

    <title>Configuración</title>

    <?php
        include "../../php/usefull/cabecera.php";
    ?>
    <script src="../../js/functions.js"></script>
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
                
                <h3>Configuración</h3>
                
                <?php
                
                while($data = mysqli_fetch_assoc($sql)){
                ?>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Configuración general</h4>
                            <form class="form-horizontal style-form form_conf_general" action="" method="POST" onsubmit="event.preventDefault(); conf_general();">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Nombre de la compañía</label>
                                    <div class="col-sm-10">
                                        <input onchange="configGeneral();" type="text" id="nom_comp" value="<?php echo $data['nombre']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Documento (RIF)</label>
                                    <div class="col-sm-10">
                                        <input onchange="configGeneral();" type="text" id="rif" value="<?php echo $data['rif']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Correo</label>
                                    <div class="col-sm-10">
                                        <input onchange="configGeneral();" type="text" id="correo" value="<?php echo $data['email']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Teléfono</label>
                                    <div class="col-sm-10">
                                        <input onchange="configGeneral();" type="text" id="telefono" value="<?php echo $data['telefono']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Dirección</label>
                                    <div class="col-sm-10">
                                        <input onchange="configGeneral();" type="text" id="direccion" value="<?php echo $data['direccion']; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div style="justify-content: center; display: flex; margin:2em;">
                                    <button id="txt_boton_config" style="display: none;" type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Colores de panel de administración</h4>
                            <form class="form-horizontal style-form form_conf_admin" onsubmit="event.preventDefault(); conf_admin();" action="" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Color barra superior</label>
                                    <div class="col-sm-10">
                                        <input type="color" onchange="configAdmin();" id="color_principal" name="color_principal" value="<?php echo $data['color_principal']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Color barra lateral</label>
                                    <div class="col-sm-10">
                                        <input type="color" onchange="configAdmin();" id="color_secundario" name="color_secundario" value="<?php echo $data['color_secundario']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Color elementos de barra lateral</label>
                                    <div class="col-sm-10">
                                        <input type="color" onchange="configAdmin();" id="color_complementario" name="color_complementario" value="<?php echo $data['color_complementario']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Color de fuente barra lateral</label>
                                    <div class="col-sm-10">
                                        <input type="color" onchange="configAdmin();" id="fuente_lateral" name="fuente_lateral" value="<?php echo $data['fuente_b_lateral']; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div style="justify-content: center; display: flex; margin:2em;">
                                    <button id="txt_boton_admin" style="display: none;" type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    
                    while($row = mysqli_fetch_assoc($tienda)){
                    
                    ?>
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Configuración tienda online</h4>
                            <form class="form-horizontal style-form form_conf_tienda" onsubmit="event.preventDefault(); conf_tienda();" action="" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Texto del Landing #1</label>
                                    <div class="col-sm-10">
                                        <input onchange="configTienda();" type="text" id="txt_landing_1" value="<?php echo $row['txt_landing_1']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Texto del Landing #2</label>
                                    <div class="col-sm-10">
                                        <input onchange="configTienda();" type="text" id="txt_landing_2" value="<?php echo $row['txt_landing_2']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Texto del Landing #3</label>
                                    <div class="col-sm-10">
                                        <input onchange="configTienda();" type="text" id="txt_landing_3" value="<?php echo $row['txt_landing_3']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Instagram</label>
                                    <div class="col-sm-10">
                                        <input onchange="configTienda();" type="text" id="instagram" value="<?php echo $row['instagram']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <input onchange="configTienda();" type="text" id="facebook" value="<?php echo $row['facebook']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Whatsapp</label>
                                    <div class="col-sm-10">
                                        <input onchange="configTienda();" type="number" id="whatsapp" value="<?php echo $row['whatsapp']; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div style="justify-content: center; display: flex; margin:2em;">
                                    <button id="txt_boton_tienda" style="display: none;" type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Imágenes</h4>
                            <form class="form-horizontal style-form form_conf_tienda" enctype="multipart/form-data" action="" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Logo</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imagen" id="imagen_logo" accept="image/*">
                                        <img style="width: 20%;" src="../../imagenes/logo/<?php echo $row['logo']?>" alt="">
                                        <input type="hidden" id="tipo_imagen" value="logo">
                                        <input type="hidden" id="directorio" value="../../imagenes/logo/">
                                        <input type="hidden" id="id" value="<?php echo $row['id']; ?>"> <!-- Asegúrate de tener el ID -->
                                        <button type="button" id="cargar_logo">Cargar Imagen</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Imágen del Landing #1</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imagen" id="imagen_landing_1" accept="image/*">
                                        <img style="width: 20%;" src="../../../cliente/sistema/landing/img/landing_1/<?php echo $row['img_landing_1']?>" alt="">
                                        <input type="hidden" id="landing_1" value="img_landing_1">
                                        <input type="hidden" id="directorio" value="../../../cliente/sistema/landing/img/landing_1/">
                                        <input type="hidden" id="id" value="<?php echo $row['id']; ?>"> <!-- Asegúrate de tener el ID -->
                                        <button type="button" id="cargar_landing_1">Cargar Imagen</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Imágen del Landing #2</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imagen" id="imagen_landing_2" accept="image/*">
                                        <img style="width: 20%;" src="../../../cliente/sistema/landing/img/landing_2/<?php echo $row['img_landing_2']?>" alt="">
                                        <input type="hidden" id="landing_2" value="img_landing_2">
                                        <input type="hidden" id="directorio" value="../../../cliente/sistema/landing/img/landing_2/">
                                        <input type="hidden" id="id" value="<?php echo $row['id']; ?>"> <!-- Asegúrate de tener el ID -->
                                        <button type="button" id="cargar_landing_2">Cargar Imagen</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Imágen del Landing #3</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imagen" id="imagen_landing_3" accept="image/*">
                                        <img style="width: 20%;" src="../../../cliente/sistema/landing/img/landing_3/<?php echo $row['img_landing_3']?>" alt="">
                                        <input type="hidden" id="landing_3" value="img_landing_3">
                                        <input type="hidden" id="directorio" value="../../../cliente/sistema/landing/img/landing_3/">
                                        <input type="hidden" id="id" value="<?php echo $row['id']; ?>"> <!-- Asegúrate de tener el ID -->
                                        <button type="button" id="cargar_landing_3">Cargar Imagen</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Imágen del Banner de publicidad</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imagen" id="imagen_publicidad" accept="image/*">
                                        <img style="width: 20%;" src="../../../cliente/sistema/img/<?php echo $row['publicidad_detalle']?>" alt="">
                                        <input type="hidden" id="publicidad" value="logo">
                                        <input type="hidden" id="directorio" value="../../../cliente/sistema/img/">
                                        <input type="hidden" id="id" value="<?php echo $row['id']; ?>"> <!-- Asegúrate de tener el ID -->
                                        <button type="button" id="cargar_publicidad">Cargar Imagen</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    
                    }

                    ?>
                </div><!-- Final del row que centra el contenido-->  

                <?php
                }
                
                ?>

		    </section><!-- /wrapper -->
        </section><!-- /MAIN CONTENT -->








      <!--main content end-->
  </section>

    <script type="text/javascript">
        $(document).ready(function(){
            var usuarioId = '<?php echo $_SESSION['admin']['id_empleado']; ?>';
            searchForDetalle(usuarioId);
        });

        function configGeneral(){
            $('#txt_boton_config').fadeIn();
        }

        function configAdmin(){
            $('#txt_boton_admin').fadeIn();
        }

        function configTienda(){
            $('#txt_boton_tienda').fadeIn();
        }

        // Función para actualizar los colores
        function updateColors() {
            var colorPrincipal = $('#color_principal').val();
            var colorSecundario = $('#color_secundario').val();
            var colorComplementario = $('#color_complementario').val();
            var fuenteLateral = $('#fuente_lateral').val();

            $('#sidebar').css('background-color', colorSecundario);
            $('#header').css('background-color', colorPrincipal);
            $('.sub').css('background-color', colorPrincipal);
            $('.active').css('background-color', colorComplementario);
            // Aquí puedes agregar más elementos que quieras cambiar con el color complementario
        }

        // Escuchar cambios en los inputs de color
        $('#color_principal, #color_secundario, #color_complementario').on('input', function() {
            updateColors();
        });

        // Llamar a la función al cargar la página para establecer los colores iniciales
        updateColors();
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
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <!--common script for all pages-->
    <script src="../../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../../assets/js/sparkline-chart.js"></script>    
	<script src="../../assets/js/zabuto_calendar.js"></script>	

    <!-- DATATABLE -->
    <script>
        $('#bitacora').DataTable({
            destroy: true, // Permite reinicializar la tabla en cada carga
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No hay datos disponibles en la tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            } // Eliminar la coma aquí
        });
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#bitacora')) {
                $('#bitacora').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                    }
                });
            }
        });
    </script>
  </body>
</php>