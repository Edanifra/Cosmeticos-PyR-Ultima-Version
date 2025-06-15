<?php

include "../conexion.php";

$query = mysqli_query($conn,"SELECT p.*, d.porcentaje_descuento
                                            FROM producto p
                                            JOIN descuentos d 
                                            ON p.id_producto = d.id_producto;");

$cat = mysqli_query($conn,"SELECT * FROM categoria_producto");

?>

<!DOCTYPE html>
   <html lang="es">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Carrusel de Ejemplo</title>
   </head>
   <body>
    <div id="carouselExample" class="carousel slide" style="background: #e3d4d4;" data-ride="carousel">
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

       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </body>
   </html>