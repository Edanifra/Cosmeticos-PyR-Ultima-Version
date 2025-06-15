<?php

session_start();

if (empty($_SESSION['admin']['activo'])) {
    header("location: ../../../");
} else {

    require "../../conexion.php";
    require "../../modelos/productos.php";

    $consulta = @mysqli_query($conn, "SELECT * FROM categoria_producto WHERE id_categoria != 6");

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

        <section id="container">

            <?php

            require "../../php/usefull/header.php";

            ?>

            <?php

            require "../../php/usefull/sidebar.php";

            ?>

            <section id="main-content">
                <section class="wrapper">


                    <h3><i class="fa fa-newspaper-o"></i> Artículos</h3> <a href="../categorias/agregarCategoria.php"
                        class="btn btn-primary"><i class="bi bi-plus"></i> Crear nueva categoría</a>
                    <!-- BASIC FORM ELELEMNTS -->
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Agregar nuevo artículo</h4>
                                <form class="form-horizontal style-form" enctype="multipart/form-data"
                                    action="../../controladores/productos/agregarProductos.php" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Esmalte..." name="nombre"
                                                class="form-control" required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Descripcion</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Esmalte para uñas..." name="descripcion"
                                                class="form-control" required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Precio</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="12,00" name="precio" class="form-control"
                                                required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Stock</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="stock" class="form-control" value=0 readonly
                                                required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Stock mínimo</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="15" name="stock_min" id="stockMin"
                                                class="form-control" required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Stock máximo</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="40" name="stock_max" id="stockMax"
                                                class="form-control" required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Categoría</label>
                                        <select name="categoria" class="form-control"
                                            style="display: flex; position: relative; left: 1%; width: 75%;">
                                            <?php

                                            while ($data = @mysqli_fetch_array($consulta)) {


                                                ?>

                                                <option value="<?php echo $data['id_categoria']; ?>">
                                                    <?php echo $data['nombre_categoria']; ?>
                                                </option>

                                                <?php

                                            }

                                            ?>

                                        </select>
                                        <div class="asterisco">*</div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Marca</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Valmy..." name="marca" class="form-control"
                                                required>
                                            <div class="asterisco">*</div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                                        <div class="photo">
                                            <div class="prevPhoto" id="prevPhoto">
                                                <span class="delPhoto notBlock">X</span>
                                                <img id="imgPreview" src="" alt="Vista previa">
                                            </div>
                                            <div class="upimg" style="position: relative; width: 200px; height: 200px;">
                                                <input type="file" name="foto" id="foto" accept="image/*"
                                                    style="display: none;">
                                                <label for="foto"
                                                    style="cursor: pointer; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                                    <span id="uploadText" style="display: none;">Haz clic aquí para
                                                        seleccionar una imagen</span>
                                                </label>
                                            </div>
                                            <div id="form_alert"></div>
                                        </div>
                                        <div class="asterisco">*</div>
                                    </div>

                                    <div>Los campos obligatorios estan resaltados con un (<div
                                            style="display:inline-block;" class="asterisco">*
                                        </div>)
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-10"
                                            style="width:100%; display: flex; justify-content:center;">
                                            <input style="background: #7272df; color: white;" type="submit"
                                                class="form-control" value="Agregar">
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


        <!--common script for all pages-->
        <script src="../../assets/js/common-scripts.js"></script>

        <script type="text/javascript" src="../../assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../../assets/js/gritter-conf.js"></script>

        <!--script for this page-->
        <script src="../../assets/js/sparkline-chart.js"></script>
        <script src="../../assets/js/zabuto_calendar.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const stockMin = document.getElementById("stockMin");
                const stockMax = document.getElementById("stockMax");

                const maxMinStock = 100; // Máximo permitido para Stock mínimo
                const maxMaxStock = 500; // Máximo permitido para Stock máximo

                stockMin.addEventListener("input", function () {
                    if (parseInt(stockMin.value) > maxMinStock) {
                        stockMin.value = maxMinStock;
                    }
                });

                stockMax.addEventListener("input", function () {
                    if (parseInt(stockMax.value) > maxMaxStock) {
                        stockMax.value = maxMaxStock;
                    }
                });
            });

            document.getElementById('foto').addEventListener('change', function () {
                var delPhoto = document.querySelector('.delPhoto');
                var prevPhoto = document.getElementById('prevPhoto');
                var imgPreview = document.getElementById('imgPreview');
                var up = document.getElementById('uploadText');

                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        imgPreview.src = e.target.result; // Establecer la fuente de la imagen
                        imgPreview.style.display = 'block'; // Mostrar la imagen
                    }
                    reader.readAsDataURL(this.files[0]); // Leer el archivo como URL de datos

                    delPhoto.classList.add('notBlock'); // Mostrar la X
                    prevPhoto.style.display = 'flex'; // Mostrar el contenedor de la foto
                } else {
                    delPhoto.classList.remove('notBlock'); // Ocultar la X
                    prevPhoto.style.display = 'none'; // Ocultar el contenedor de la foto
                }
            });

            document.querySelector('.delPhoto').addEventListener('click', function () {
                document.getElementById('foto').value = ''; // Limpiar el input
                this.classList.remove('notBlock'); // Ocultar la X
                document.getElementById('imgPreview').style.display = 'none'; // Ocultar la imagen
                document.getElementById('prevPhoto').style.display = 'none'; // Ocultar el contenedor de la foto
            });
        </script>

    </body>
</php>