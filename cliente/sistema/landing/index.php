<?php

include "../conexion.php";

$query = mysqli_query($conn,"SELECT p.*, d.porcentaje_descuento
                                            FROM producto p
                                            JOIN descuentos d 
                                            ON p.id_producto = d.id_producto;");

$cat = mysqli_query($conn,"SELECT * FROM categoria_producto WHERE id_categoria != 6");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>
        <?php 
        $query_conf = @mysqli_query($conn,"SELECT * FROM configuracion");
        while ($row = mysqli_fetch_assoc($query_conf)) {
            echo $row['nombre'];
        }
        ?>
    </title>

    

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav d-block">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#">
                    
                <?php 
                $query_conf = @mysqli_query($conn,"SELECT * FROM configuracion");
                while ($row = mysqli_fetch_assoc($query_conf)) {
                    echo $row['nombre'];
                }
                ?>

                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="display: flow-root;">
                    <li>
                        <a href="#about">Acerca de</a>
                    </li>
                    <li>
                        <a href="#services">Servicios</a>
                    </li>
                    <li>
                        <a href="#contact">Contacto</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <h1 style="margin-top: 2em;display: flex;justify-content: center;">¡Ofertas de la semana!</h1>
    <div style="display: flex; justify-content: center; margin-top: 3em;">
        <section class="carru">
            <?php 
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <div class="producto">
                    <a href="../detalle_producto.php?id_producto=<?php echo $data['id_producto']; ?>" style="text-decoration: none; color: inherit;"> <!-- Añade estilos para quitar el subrayado -->
                        <img src="../../../sistema/imagenes/productos/<?php echo $data['imagen']; ?>" alt="<?php echo $data['nombre']; ?>" style="display: block;"> <!-- Asegúrate de que la imagen sea un bloque -->
                        <span class="descuento"><?php echo $data['porcentaje_descuento']; ?>% descuento</span>
                    </a>
                </div>
            <?php }?>
            <a href="../catalogo.php" class="catalogo-link btn btn-success">Ir al catálogo</a>
        </section>
    </div>

    <!-- CARRUSEL DE CATEGORÍAS -->
    <div style="margin-top: 3%; margin-bottom: 3%;">
        <h2 style="display: flex;justify-content: center;margin-left: 5%;">Explora nuestras categorías</h2>
        <div id="carouselExample" class="carousel slide" style="background: #e3d4d4;padding:4em;" data-ride="carousel">
            <div class="carousel-inner" style="display: flex;justify-content: center;">
                <?php
                $active = 'active'; // Para marcar el primer elemento como activo
                while ($row = mysqli_fetch_assoc($cat)) {
                    ?>
                    <div class="carousel-item <?php echo $active; ?>">
                        <h5><?php echo $row['nombre_categoria']; ?></h5>
                    </div>
                    <?php
                    $active = ''; // Después del primer elemento, ya no es activo
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
    

    <!-- Page Content -->
    <?php 
    
    $landing = @mysqli_query($conn,"SELECT * FROM tienda");
    while($datos = mysqli_fetch_assoc($landing)){
    ?>
	<a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading"><?php echo $datos['title_landing_1']; ?></h2>
                    <p class="lead"><?php echo $datos['txt_landing_1']; ?></p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/landing_1/<?php echo $datos['img_landing_1']; ?>" style="border-radius: 10px;">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading"><?php echo $datos['title_landing_2']; ?></h2>
                    <p class="lead"><?php echo $datos['txt_landing_2']; ?></p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="img/landing_2/<?php echo $datos['img_landing_2']; ?>" style="border-radius: 10px;">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading"><?php echo $datos['title_landing_3']; ?></h2>
                    <p class="lead"><?php echo $datos['txt_landing_3']; ?></p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/landing_3/<?php echo $datos['img_landing_3']; ?>" style="border-radius: 10px;">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Contáctanos:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="<?php echo $datos['instagram']; ?>" class="btn btn-default btn-lg"><i class="fa fa-instagram fa-fw"></i> <span class="network-name">Instagram</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $datos['facebook']; ?>" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $datos['whatsapp']; ?>" class="btn btn-default btn-lg" target="_blank">
                                <i class="fa fa-whatsapp"></i> <span class="network-name"><span class="network-name">Whatsapp</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->
    <?php }?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Inicio</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">Acerca de</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Servicios</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contacto</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; PyR Cosmetics C.A. Todos los derechos reservados</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>

</html>
