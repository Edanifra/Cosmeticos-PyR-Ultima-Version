<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'conexion.php'; // Ensure your database connection is correct
include 'global/funciones.php';
session_start();
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alert = '';
    $busqueda = $_POST['buscar'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $marca = $_POST['marca'] ?? '';

    // Create the SQL query
    $query = "SELECT * FROM producto WHERE 1=1"; // 1=1 helps facilitate condition concatenation

    // Filter by text search
    if (!empty($busqueda)) {
        $busqueda = mysqli_real_escape_string($conn, $busqueda);
        $query .= " AND nombre LIKE '%$busqueda%'";
    }

    // Filter by category
    if (!empty($categoria)) {
        $categoria = mysqli_real_escape_string($conn, $categoria);
        $query .= " AND id_categoria = '$categoria'";
    }

    // Filter by brand
    if (!empty($marca)) {
        $marca = mysqli_real_escape_string($conn, $marca);
        $query .= " AND marca = '$marca'";
    }

    // Execute the query
    $resultado = mysqli_query($conn, $query);

    // Debugging: Check if query execution was successful
    if (!$resultado) {
        die("Error in query execution: " . mysqli_error($conn));
    }

    // Check if $resultado is a valid mysqli_result
    if ($resultado instanceof mysqli_result) {
        ?>
        <div class="container">

            <h2 style="margin-top:5em;"><i class="bi bi-card-list"></i> Resultados de búsqueda</h2>
            <hr>

            <div>
                <div class="buscador">
                    <form action="buscar_productos.php" method="POST" style="display: flex; align-items: center; gap:2em;">
                        <div>
                            <input type="text" name="buscar" placeholder="Buscar productos">
                        </div>
                        <div>
                            <select name="categoria" id="categoria" class="formato_select">
                            <option value="" selected>Buscar categoría</option>
                            <?php 
                                $sql_cat_prod = mysqli_query($conn,"SELECT * FROM categoria_producto");
                                while($result = mysqli_fetch_assoc($sql_cat_prod)){
                            ?>
                                <option value="<?php echo $result['id_categoria']; ?>"><?php echo $result['nombre_categoria']; ?></option>
                            <?php 
                                }
                            ?>
                            </select>
                        </div>
                        <div>
                            <select name="marca" id="marca" class="formato_select">
                                <option value="" selected>Buscar marca</option>
                                <?php 
                                    $sql_marca = mysqli_query($conn,"SELECT marca FROM producto WHERE id_producto != 115005451");
                                    $marcas = []; // Arreglo para almacenar marcas únicas

                                    while($resultao = mysqli_fetch_assoc($sql_marca)){
                                        $marca = $resultao['marca'];
                                        // Verificar si la marca ya está en el arreglo
                                        if (!in_array($marca, $marcas)) {
                                            // Si no está, agregarla al arreglo
                                            $marcas[] = $marca;
                                            // Mostrar la opción en el select
                                            echo '<option value="' . htmlspecialchars($marca) . '">' . htmlspecialchars($marca) . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn boton_formato" style="margin:5px; color:white;"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
            <hr>

            <div class="row">
            <?php
            while ($data = mysqli_fetch_array($resultado)) {
                // Check if there is an offer
                if (verificarOferta($data['id_producto'], $conn)) {
                    ?>
                    <div class="col-3 carta_<?php echo $data['id_producto']; ?>">
                        <div class="card cartita position-relative">
                            <a href="detalle_producto.php?id_producto=<?php echo $data['id_producto']; ?>">
                                <?php $porcentaje = obtenerOferta($data['id_producto'], $conn); ?>
                                <div class="posicion_desc"><span class="descuento"><?php echo $porcentaje; ?>% descuento</span></div>
                                <img 
                                    loading="lazy"
                                    class="card-img-top" 
                                    src="<?php 
                                        if (!empty($data['imagen'])) {
                                            echo "../../sistema/imagenes/productos/" . $data['imagen'];
                                        } else {
                                            echo "img/imagen_no_disponible.jpeg";
                                        }
                                    ?>"
                                    style="max-height: 10em;"
                                />
                            </a>
                            <div class="cuerpo_carta">
                                <div class="card-body">
                                    <h4 class="card-title titulo_de_carta">
                                        Bs. <?php
                                            echo $data['precio'];
                                            echo "<del class='text-secondary precio_viejo'>Bs." . number_format(obtenerPrecioViejo($data['id_producto'], $conn), 2) . "</del>";
                                        ?>
                                    </h4>
                                    <p class="card-text"><?php echo $data['nombre']; ?></p>
                                </div>
                                <form id="form_carrito_<?php echo $data['id_producto']; ?>" class="form_carrito" method="post" onsubmit="alertaBoton(event, '<?php echo $data['id_producto']; ?>');">
                                    <input type="hidden" class="id_producto" name="id_producto" id="id_producto_<?php echo $data['id_producto']; ?>" value="<?php echo $data['id_producto']; ?>">
                                    <label for="cant_prod" class="label_cantidad" id="label_cantidad_<?php echo $data['id_producto']; ?>"><i class="bi bi-plus-circle"></i> Añadir cantidad:</label>
                                    <input type="number" pattern="[1-9][0-9]*" min="1" class="cant_prod" name="cant_prod" value="1" id="cant_prod_<?php echo $data['id_producto']; ?>" oninput="validarCantidad(this)" required>
                                    <?php
                                    if ($data['stock'] <= 0) {
                                        echo "<span class='text-danger'>Producto agotado</span>";
                                    } else {
                                        if (empty($_SESSION['cliente']['activo'])) {
                                            echo '<a href="#" id="btn_iniciar_sesion" style="color:white;width: 93%;border-radius: 4px;" class="btn boton_formato btn_iniciar_sesion"><i class="bi bi-cart-plus"></i> Agregar producto</a>';
                                        } else {
                                            echo '<button type="submit" name="boton_accion" style="color:white;width: 93%;border-radius: 4px;" id="boton_accion_' . $data['id_producto'] . '" class="btn boton_formato boton_accion" value="Agregar"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>';
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <!-- If the product does not have a discount, show a normal card -->
                    <div class="col-3 carta_<?php echo $data['id_producto']; ?>">
                        <div class="card cartita">
                            <a href="detalle_producto.php?id_producto=<?php echo $data['id_producto']; ?>">
                                <img 
                                    loading="lazy"
                                    class="card-img-top" 
                                    src="<?php 
                                        if (!empty($data['imagen'])) {
                                            echo "../../sistema/imagenes/productos/" . $data['imagen'];
                                        } else {
                                            echo "img/imagen_no_disponible.jpeg";
                                        }
                                    ?>"
                                    style="max-height: 10em;"
                                />
                            </a>
                            <div class="cuerpo_carta">
                                <div class="card-body">
                                    <h4 class="card-title titulo_de_carta">
                                        Bs. <?php echo $data['precio']; ?>
                                    </h4>
                                    <p class="card-text"><?php echo $data['nombre']; ?></p>
                                </div>
                                <form id="form_carrito_<?php echo $data['id_producto']; ?>" class="form_carrito" method="post" onsubmit="alertaBoton(event, '<?php echo $data['id_producto']; ?>');">
                                    <input type="hidden" class="id_producto" name="id_producto" id="id_producto_<?php echo $data['id_producto']; ?>" value="<?php echo $data['id_producto']; ?>">
                                    <label for="cant_prod" class="label_cantidad" id="label_cantidad_<?php echo $data['id_producto']; ?>"><i class="bi bi-plus-circle"></i> Añadir cantidad:</label>
                                    <input type="number" pattern="[1-9][0-9]*" min="1" class="cant_prod" name="cant_prod" value="1" id="cant_prod_<?php echo $data['id_producto']; ?>" oninput="validarCantidad(this)" required>
                                    <?php
                                    if ($data['stock'] <= 0) {
                                        echo "<span class='text-danger'>Producto agotado</span>";
                                    } else {
                                        if (empty($_SESSION['cliente']['activo'])) {
                                            echo '<a href="#" id="btn_iniciar_sesion" style="color:white;width: 93%;border-radius: 4px;" class="btn boton_formato btn_iniciar_sesion"><i class="bi bi-cart-plus"></i> Agregar producto</a>';
                                        } else {
                                            echo '<button type="submit" style="color:white;width: 93%;border-radius: 4px;" name="boton_accion" id="boton_accion_' . $data['id_producto'] . '" class="btn boton_formato boton_accion" value="Agregar"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>';
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        </div>
        <?php
    } else {
        echo "No se encontraron resultados.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Sistema</title>
</head>
<body style="position: relative; bottom: 90;">

<?php require "global/header.php"; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/functions.js"></script>
<script>

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
</script>
</body>
</html>