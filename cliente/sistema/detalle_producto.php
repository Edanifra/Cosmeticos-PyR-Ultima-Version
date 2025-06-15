<?php
session_start();
include_once "conexion.php";
include_once "global/funciones.php";

if (!empty($_GET['id_producto'])) {
    if(is_numeric($_GET['id_producto'])){

        $id = $_GET['id_producto'];

        $sql = mysqli_query($conn,"SELECT  * FROM producto WHERE id_producto = $id");
        $result = mysqli_num_rows($sql);

        $pv = mysqli_query($conn,"SELECT precio_anterior FROM descuentos WHERE id_producto = '$id'");
        $p_v = mysqli_fetch_assoc($pv);

        if ($result <= 0) {
            header("location:index.php");
        }
    }else {
        header("location:index.php");
    }
}else {
    header("location:index.php");
}

$alert = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Producto</title>
</head>
<body>

<?php require "global/header.php"; ?>


<div class="container d-grid gap-5" style="margin-top: 6%;">
    <!-- *********** FOTO, DATOS, PRECIO, DESCRIPCION Y AGREGAR AL CARRITO *********** -->
    <div class="row">
        <div class="d-flex" style="justify-content: space-evenly;">
            <?php
                while($data = mysqli_fetch_array($sql)){

                    $iva = 16;
                    $sub_total = 0;
                    $precioTotal = 0;
                    $total = 0;

                    $precioTotal    = 1 * $data['precio'];
                    $sub_total      = $sub_total + $precioTotal;
                    $total          = $precioTotal;

                    $impuesto   = $sub_total * ($iva / 100);
                    $tl_sniva   = $sub_total - $impuesto;
                    $total      = $tl_sniva + $impuesto;
            ?>
            <div class="col-3" style="width: 45em;">
                <h2><?php echo $data['nombre']; ?></h2>
                <div class="card" style="align-items:center; padding-bottom: 10px;">
                    <img 
                        class="card-img-top" 
                        style="height: 26em; width: auto;"
                        src="<?php 
                            if (!empty($data['imagen'])) {
                                echo "../../sistema/imagenes/productos/".$data['imagen'];
                            }else {
                                echo "img/imagen_no_disponible.jpeg";
                            }
                        ?>" 
                        alt="Homo?"
                        />
                    <div class="card-body d-flex" style="width:100%; justify-content: space-evenly;">
                        <div class="row">
                            <?php if (verificarOferta($id, $conn)) {
                            ?>
                            <h6 class="card-title"><?php echo "Bs. ".number_format($tl_sniva,2); ?></h6>
                            <h5 style="color:grey;"><?php echo "I.V.A. ".number_format($impuesto,2); ?></h5>
                            <h5 style="color:grey;"><?php echo "<del>Bs. ".number_format($p_v['precio_anterior'],2)."</del>"; ?></h5>
                            <h4 class="card-title"><?php echo "Bs. ".number_format($total,2); ?></h4>
                            <?php
                            }else{ ?>
                            <h6 class="card-title"><?php echo "Bs. ".number_format($tl_sniva,2); ?></h6>
                            <h5 style="color:grey;"><?php echo "I.V.A. ".number_format($impuesto,2); ?></h5>
                            <h4 class="card-title"><?php echo "Bs. ".number_format($total,2); ?></h4>
                            <?php }?>
                        </div>
                        <div class="row d-block">
                            <form id="form_carrito_<?php echo $data['id_producto']; ?>" class="form_carrito" method="post" onsubmit="alertaBoton(event, '<?php echo $data['id_producto']; ?>');">
                                <input type="hidden" class="id_producto" name="id_producto" id="id_producto_<?php echo $data['id_producto']; ?>" value="<?php echo $data['id_producto']; ?>">

                                <?php
                                    if ($data['stock'] > 0) {
                                        if (empty($_SESSION['cliente']['activo'])) {
                                ?>      
                                        <label for="cant_prod" class="label_cantidad d-block" id="label_cantidad_<?php echo $data['id_producto']; ?>">Añadir cantidad:</label>
                                        <input type="number" pattern="[1-9][0-9]*" min="1" class="cant_prod d-block" name="cant_prod" value="1" id="cant_prod_<?php echo $data['id_producto']; ?>" required oninput="validarCantidad(this)">
                                        <a href="#" id="btn_iniciar_sesion" style="color:white;" class="btn boton_formato btn_iniciar_sesion">Agregar producto</a>
                                <?php
                                        }else {
                                ?>
                                        <label for="cant_prod" class="label_cantidad d-block" id="label_cantidad_<?php echo $data['id_producto']; ?>">Añadir cantidad:</label>
                                        <input type="number" pattern="[1-9][0-9]*" min="1" class="cant_prod d-block" name="cant_prod" value="1" id="cant_prod_<?php echo $data['id_producto']; ?>" required oninput="validarCantidad(this)">
                                        <button type="submit" name="boton_accion" style="color:white;" id="boton_accion_<?php echo $data['id_producto']; ?>" class="btn boton_formato boton_accion" value="Agregar">Agregar al carrito</button>
                                <?php
                                        }
                                    }else {
                                ?>
                                    <div class="producto_agotado">
                                        <span>Producto Agotado</span>
                                    </div>
                                <?php
                                    }
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
                            
            <div class="col-3" style="height: 32.5em;">
                <h3 class="text-secondary">Información</h3>
                <div class="card" style="align-items:center; padding-bottom: 10px; height: 50%; overflow: auto;">
                    <div class="card-body">
                        <h4 style="color: #868c95;"><?php echo $data['descripcion']; ?></h4>
                    </div>
                </div><br>

                <h3 class="text-secondary">Publicidad</h3>
                <div class="card">
                    <a href="#">
                        <img 
                        class="card-img-top" 
                        style="height: 15em;"
                        src="img/pyrcosmetics.png" 
                        alt="Homo?"
                        />
                    </a>
                </div>
            </div>
                            
            <?php
                }
            ?>
        </div>
    </div>

        <!-- *********** TABLA CON INFORMACIÓN ESPECÍFICA DEL PRODUCTO *********** -->
    <div class="row">
        <h2 class="text-secondary">Información del producto</h2>
        <div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-info">
                        <thead>
                            <tr>
                                <th scope="col">Disponibilidad en tienda</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $consulta = mysqli_query($conn,"SELECT p.marca, p.stock,
                                                            c.nombre_categoria
                                                            FROM producto p
                                                            INNER JOIN categoria_producto c
                                                            ON p.id_categoria = c.id_categoria
                                                            WHERE id_producto = $id");

                                if ($result > 0) {
                                    while($datos = mysqli_fetch_assoc($consulta)){
                            ?>
                            <tr>
                                <td><?php echo $datos['stock']; ?> Unidades</td>
                                <td><?php echo $datos['nombre_categoria']; ?></td>
                                <td><?php echo $datos['marca']; ?></td>
                            </tr>
                            <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No hay datos disponibles</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <!-- *********** CARRUSEL CON ARTÍCULOS DE POSIBLE INTERÉS PARA EL CLIENTE *********** -->
    <div class="row">
        

    </div>
</div>

<br>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/functions.js"></script>
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

    //MOSTRAR CANTIDAD DEL PRODUCTO (CATÁLOGO)
function mostrarCantidad(id){
    $('#label_cantidad_'+id).css('display','block');
    $('#cant_prod_'+id).css('display','block');
}

//OCULTAR CANTIDAD DEL PRODUCTO (CATÁLOGO)
function quitarCantidad(id){
    $('#label_cantidad_'+id).css('display','none');
    $('#cant_prod_'+id).css('display','none');
}

function validarCantidad(input) {
    // Si el valor de la cantidad es menor a 1, lo restablecemos a 1
    if (input.value < 1) {
        input.value = 1;
    }
}
</script>
</body>
</html>