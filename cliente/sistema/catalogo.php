<?php
session_start();
include_once "conexion.php"; // Para la conexión a la BD
include_once "global/config.php"; // Tus configuraciones globales
include_once "global/funciones.php"; // Tus funciones globales

// Consulta inicial de productos
$sql_productos = mysqli_query($conn, "SELECT * FROM producto WHERE id_producto != 115005451 LIMIT 20"); // Tu consulta original

// Alerta (si la usas desde la sesión)
$alert = isset($_SESSION['page_alert']) ? $_SESSION['page_alert'] : "";
if (isset($_SESSION['page_alert'])) {
    unset($_SESSION['page_alert']); // Limpiar alerta después de mostrarla
}

// Conteo inicial de ítems en el carrito para la insignia
$initial_cart_item_count = 0;
if (isset($_SESSION['cliente']['id_usuario'])) {
    $token_user_header = md5($_SESSION['cliente']['id_usuario']);
    $query_count_header = mysqli_prepare($conn, "SELECT SUM(cantidad) as total_items FROM detalle_carrito WHERE token_user = ?");
    if ($query_count_header) {
        mysqli_stmt_bind_param($query_count_header, "s", $token_user_header);
        mysqli_stmt_execute($query_count_header);
        $result_count_header = mysqli_stmt_get_result($query_count_header);
        $data_count_header = mysqli_fetch_assoc($result_count_header);
        $initial_cart_item_count = $data_count_header['total_items'] ? intval($data_count_header['total_items']) : 0;
        mysqli_stmt_close($query_count_header);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require "global/cabecera.php"; // Contiene metas, Bootstrap CSS, Font Awesome CSS, etc. ?>
    <title>Catálogo de Productos</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container { /* Contenedor principal */
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .page-title {
            color: #343a40;
            margin-bottom: 1rem;
        }
        .buscador-form {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.075);
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap; /* Para que se ajuste en pantallas pequeñas */
            align-items: center;
            gap: 1rem; /* Espacio entre elementos del buscador */
        }
        .buscador-form input[type="text"],
        .buscador-form select {
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            min-width: 180px; /* Ancho mínimo para los selects e input */
            flex-grow: 1; /* Para que ocupen espacio disponible */
        }
        .buscador-form button {
            padding: 0.5rem 1rem;
        }

        .product-card {
            transition: transform .2s ease-out, box-shadow .2s ease-out;
            border: 1px solid #e9ecef;
            border-radius: 0.5rem; /* Bordes redondeados consistentes */
            background-color: #fff;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12) !important;
        }
        .product-image-container { /* Contenedor para la imagen */
            overflow: hidden;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            max-height: 220px; /* Altura de la imagen */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff; /* Fondo blanco si la imagen es transparente */
        }
        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: 10px; /* Pequeño padding alrededor de la imagen */
        }
        .product-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: #333;
            min-height: 44px; /* Para 2 líneas de texto aprox. */
            line-height: 1.4;
            margin-bottom: 0.5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Limitar a 2 líneas */
            -webkit-box-orient: vertical;
        }
        .product-name a {
            color: inherit;
            text-decoration: none;
        }
        .product-name a:hover {
            color: #0056b3;
        }
        .product-price .fw-bold {
            font-size: 1.25rem;
            color: #007bff; /* Precio destacado */
        }
        .product-price del {
            font-size: 0.9rem;
        }
        .quantity-input {
            text-align: center;
            box-shadow: none !important;
            border-radius: 0.25rem;
        }
        .card-body {
            padding: 1rem; /* Padding consistente */
        }
        .card-footer {
            background-color: transparent;
            border-top: 1px solid #f1f1f1; /* Borde sutil */
            padding: 0.75rem 1rem;
        }
        .badge-oferta { /* Etiqueta de oferta */
            font-size: 0.85em;
            padding: 0.6em 0.8em;
            letter-spacing: 0.5px;
            z-index: 10;
        }
        .btn-add-to-cart i {
            margin-right: 0.4em;
        }
        .toast-container { /* Contenedor para notificaciones */
            z-index: 1090; /* Encima de la mayoría de los elementos */
        }
        /* Estilos para la insignia del carrito en el header */
        #cart-item-count {
            font-size: 0.65em;
            padding: 0.25em 0.5em;
            vertical-align: top;
            margin-left: 2px;
        }
        #cart-item-count:empty,
        #cart-item-count.is-empty { /* Clase para ocultar si está vacío */
            display: none !important;
        }
        /* Para que el buscador sea más compacto en móviles */
        @media (max-width: 768px) {
            .buscador-form {
                flex-direction: column;
                gap: 0.75rem;
            }
            .buscador-form > div, .buscador-form input[type="text"], .buscador-form select, .buscador-form button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<?php require "global/header.php"; // Tu cabecera de navegación ?>

<div class="container main-container">
    <br>

    <?php if (!empty($alert) && is_array($alert)) : ?>
        <div class="alert alert-<?php echo htmlspecialchars($alert['type']); ?> alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($alert['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (!empty($alert)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"> 
            <?php echo htmlspecialchars($alert); ?>
            <a href="carrito.php" class="badge bg-primary ms-2 text-decoration-none">Ver carrito</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2 class="page-title"><i class="fas fa-store me-2"></i>Catálogo de Productos</h2>
    
    <div class="buscador-form mb-4">
        <form action="buscar_productos.php" method="POST" class="w-100 d-flex flex-wrap align-items-center" style="gap: 1rem;">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar productos..." style="flex-basis: 250px; flex-grow:2;">
            <select name="categoria" id="categoria" class="form-select" style="flex-basis: 200px; flex-grow:1;">
                <option value="" selected>Todas las categorías</option>
                <?php 
                $sql_cat_prod = mysqli_query($conn,"SELECT * FROM categoria_producto WHERE id_categoria != 6"); // Tu consulta
                while($result_cat = mysqli_fetch_assoc($sql_cat_prod)){
                    echo '<option value="'.htmlspecialchars($result_cat['id_categoria']).'">'.htmlspecialchars($result_cat['nombre_categoria']).'</option>';
                }
                ?>
            </select>
            <select name="marca" id="marca" class="form-select" style="flex-basis: 200px; flex-grow:1;">
                <option value="" selected>Todas las marcas</option>
                <?php 
                $sql_marca_query = mysqli_query($conn,"SELECT DISTINCT marca FROM producto WHERE id_producto != 115005451 AND marca IS NOT NULL AND marca != '' ORDER BY marca ASC");
                while($resultado_marca = mysqli_fetch_assoc($sql_marca_query)){
                    echo '<option value="'.htmlspecialchars($resultado_marca['marca']).'">'.htmlspecialchars($resultado_marca['marca']).'</option>';
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> 
        <?php
        if (mysqli_num_rows($sql_productos) > 0) {
            while($data = mysqli_fetch_array($sql_productos)){
                $idProducto = $data['id_producto'];
                $nombreProducto = htmlspecialchars($data['nombre']);
                $precioActual = floatval($data['precio']); // Asumimos que este es el precio final (con oferta si aplica)
                $stockProducto = intval($data['stock']);

                $esOferta = verificarOferta($idProducto, $conn); // Tu función global
                $precioViejo = null;
                $porcentajeDescuento = null;

                if ($esOferta) {
                    $porcentajeDescuento = obtenerOferta($idProducto, $conn); // ej. "25"
                    $precioViejo = obtenerPrecioViejo($idProducto, $conn); // Tu función global
                    // Si $data['precio'] NO es el precio con descuento, deberías calcularlo aquí.
                    // Por ejemplo: $precioActual = $precioViejo * (1 - ($porcentajeDescuento / 100));
                }

                $imagenUrl = (!empty($data['imagen'])) ? "../../sistema/imagenes/productos/".htmlspecialchars($data['imagen']) : "img/imagen_no_disponible.jpeg";
                // Verificar si la imagen existe, si no, usar la de placeholder
                // Esta verificación de file_exists puede ser costosa si tienes muchas imágenes o acceso lento al FS.
                // $rutaCompletaImagen = $_SERVER['DOCUMENT_ROOT'] . "/tu_proyecto/sistema/imagenes/productos/" . $data['imagen']; // Ajusta esta ruta!
                // if (!empty($data['imagen']) && file_exists($rutaCompletaImagen)) {
                //    $imagenUrl = "../../sistema/imagenes/productos/".htmlspecialchars($data['imagen']);
                // } else {
                //    $imagenUrl = "img/imagen_no_disponible.jpeg";
                // }

        ?>
        <div class="col">
            <div class="card product-card h-100">
                <?php if ($esOferta && $porcentajeDescuento) : ?>
                    <span class="badge bg-danger position-absolute top-0 end-0 m-2 badge-oferta">
                        <?php echo htmlspecialchars($porcentajeDescuento); ?>% OFF
                    </span>
                <?php endif; ?>

                <a href="detalle_producto.php?id_producto=<?php echo $idProducto; ?>" class="text-decoration-none product-image-container">
                    <img loading="lazy" class="product-image" src="<?php echo $imagenUrl; ?>" alt="<?php echo $nombreProducto; ?>">
                </a>
                
                <div class="card-body d-flex flex-column">
                    <h5 class="product-name">
                        <a href="detalle_producto.php?id_producto=<?php echo $idProducto; ?>">
                            <?php echo $nombreProducto; ?>
                        </a>
                    </h5>
                    
                    <div class="product-price mt-auto">
                        <span class="fw-bold fs-5 text-primary">Bs. <?php echo number_format($precioActual, 2); ?></span>
                        <?php if ($esOferta && $precioViejo && floatval($precioViejo) > $precioActual) : ?>
                            <del class="text-muted ms-2">Bs. <?php echo number_format(floatval($precioViejo), 2); ?></del>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-footer">
                    <form id="form_add_to_cart_<?php echo $idProducto; ?>" class="form_add_to_cart" method="post" onsubmit="agregarAlCarrito(event, '<?php echo $idProducto; ?>');">
                        <input type="hidden" name="id_producto_form" value="<?php echo $idProducto; ?>"> 
                        <div class="input-group mb-2">
                            <input type="number" class="form-control form-control-sm quantity-input" 
                                   name="cant_prod" value="1" min="1" max="<?php echo $stockProducto > 0 ? $stockProducto : 1; ?>"
                                   id="cant_prod_<?php echo $idProducto; ?>" 
                                   aria-label="Cantidad"
                                   oninput="validarCantidadCatalogo(this)" required
                                   <?php if ($stockProducto <= 0) echo 'disabled'; ?> >
                            <button type="submit" name="boton_accion_submit" 
                                    class="btn btn-sm <?php echo ($stockProducto <= 0 || empty($_SESSION['cliente']['activo'])) ? 'btn-secondary' : 'btn-success'; ?> btn-add-to-cart flex-grow-1" 
                                    value="Agregar"
                                    <?php if ($stockProducto <= 0 || empty($_SESSION['cliente']['activo'])) echo 'disabled'; ?>>
                                <i class="fas fa-cart-plus"></i>
                                <?php 
                                    if ($stockProducto <= 0) { echo "Agotado"; }
                                    elseif (empty($_SESSION['cliente']['activo'])) { echo "Agregar"; } // Se manejará con JS para login
                                    else { echo "Agregar"; }
                                ?>
                            </button>
                        </div>
                        
                        <?php if ($stockProducto > 0 && empty($_SESSION['cliente']['activo'])) : ?>
                            <button type="button" class="btn btn-outline-primary w-100 btn-sm mt-1 btn_iniciar_sesion_catalogo" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="fas fa-sign-in-alt"></i> Inicia sesión para comprar
                            </button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <?php
            } // Fin while
        } else {
            echo '<div class="col-12"><p class="text-center lead mt-5">No se encontraron productos en esta categoría o que coincidan con tu búsqueda.</p></div>';
        }
        ?>
    </div>
</div>


<div class="toast-container position-fixed bottom-0 end-0 p-3">
 
</div>


<?php if (!isset($_SESSION['cliente']['activo']) || empty($_SESSION['cliente']['activo'])) : ?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form id="formLoginModal">
          <div class="mb-3">
            <label for="loginUserModal" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="loginUserModal" name="user" required>
          </div>
          <div class="mb-3">
            <label for="loginClaveModal" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="loginClaveModal" name="clave" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Ingresar</button>
          <div id="loginModalError" class="text-danger mt-2"></div>
        </form>
        <p class="mt-3 text-center">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script> 
{/* <script src="js/popper.min.js"></script> 
{/* <script src="js/functions.js"></script> 

<script type="text/javascript">
    const IS_CLIENTE_ACTIVO = <?php echo json_encode(!empty($_SESSION['cliente']['activo'])); ?>;
    let initialCartCount = <?php echo $initial_cart_item_count; ?>;

    function updateCartBadge(count) {
        const badge = $('#cart-item-count');
        if (badge.length) {
            badge.text(count);
            if (count > 0) {
                badge.removeClass('is-empty').addClass('show-count'); // 'show-count' puede ser una clase tuya para hacerlo visible
            } else {
                badge.addClass('is-empty').removeClass('show-count');
            }
        }
    }

    function validarCantidadCatalogo(input) {
        let value = parseInt(input.value);
        let min = parseInt(input.min) || 1;
        let max = parseInt(input.max) || Infinity; // Leer el max (stock) del input si se define

        if (isNaN(value) || value < min) {
            input.value = min;
        } else if (value > max) {
            input.value = max;
            mostrarNotificacionToast('Stock limitado', 'Solo quedan ' + max + ' unidades disponibles.', 'warning');
        }
    }

    function agregarAlCarrito(event, idProducto) {
        event.preventDefault();

        if (!IS_CLIENTE_ACTIVO) {
            var loginModalElement = document.getElementById('loginModal');
            if (loginModalElement) {
                var loginModal = new bootstrap.Modal(loginModalElement);
                loginModal.show();
            } else {
                alert("Por favor, inicia sesión para agregar productos al carrito.");
            }
            return;
        }

        const form = $('#form_add_to_cart_' + idProducto);
        const cantidadInput = form.find('input[name="cant_prod"]');
        const cantidad = parseInt(cantidadInput.val());
        const submitButton = form.find('button[type="submit"]');
        const originalButtonHtml = submitButton.html();

        if (isNaN(cantidad) || cantidad < 1) {
            mostrarNotificacionToast('Error', 'Por favor, ingresa una cantidad válida.', 'danger');
            cantidadInput.val(1).focus();
            return;
        }

        submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Agregando...');

        $.ajax({
            url: 'AJAX/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'addProductDetalle',
                producto: idProducto,
                cantidad: cantidad
            },
            success: function(response) {
                if (response.error) {
                    mostrarNotificacionToast('Error', response.message || 'No se pudo agregar el producto.', 'danger');
                    submitButton.prop('disabled', false).html(originalButtonHtml);
                } else if (response.success) {
                    mostrarNotificacionToast('¡Éxito!', response.message || 'Producto agregado al carrito.', 'success');
                    if (typeof response.total_items !== 'undefined') {
                        updateCartBadge(response.total_items);
                    }
                    submitButton.html('<i class="fas fa-check"></i> Añadido').addClass('btn-outline-success').removeClass('btn-success');
                    setTimeout(function() {
                        submitButton.prop('disabled', false).html(originalButtonHtml).removeClass('btn-outline-success').addClass('btn-success');
                        cantidadInput.val(1);
                    }, 2500);
                } else {
                    mostrarNotificacionToast('Atención', 'Respuesta inesperada del servidor.', 'warning');
                    submitButton.prop('disabled', false).html(originalButtonHtml);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX (addProductDetalle): ", textStatus, errorThrown, jqXHR.responseText);
                mostrarNotificacionToast('Error de Red', 'No se pudo conectar con el servidor. Intenta de nuevo.', 'danger');
                submitButton.prop('disabled', false).html(originalButtonHtml);
            }
        });
    }

    function mostrarNotificacionToast(titulo, mensaje, tipo = 'info') {
        const toastId = 'toast-' + new Date().getTime();
        const icono = {
            success: '<i class="fas fa-check-circle me-2"></i>',
            danger: '<i class="fas fa-times-circle me-2"></i>',
            warning: '<i class="fas fa-exclamation-triangle me-2"></i>',
            info: '<i class="fas fa-info-circle me-2"></i>'
        };
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${tipo} border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
                <div class="d-flex">
                    <div class="toast-body">
                        ${icono[tipo] || ''}<strong>${titulo}</strong> ${mensaje}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        if ($('.toast-container').length === 0) {
            $('body').append('<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>');
        }
        $('.toast-container').append(toastHtml);
        const toastElement = new bootstrap.Toast(document.getElementById(toastId));
        toastElement.show();
        document.getElementById(toastId).addEventListener('hidden.bs.toast', function () {
            this.remove();
        });
    }

    $(document).ready(function() {
        updateCartBadge(initialCartCount); // Inicializar la insignia del carrito

        // Manejo del formulario de login en el modal (ejemplo)
        $('#formLoginModal').on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var user = form.find('input[name="user"]').val();
            var clave = form.find('input[name="clave"]').val();
            var errorDiv = $('#loginModalError');
            errorDiv.text('');

            $.ajax({
                url: 'AJAX/ajax.php', // Tu script AJAX que maneja el login
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'login',
                    user: user,
                    clave: clave
                },
                success: function(response){
                    if(response.success){
                        // Cerrar modal y recargar página o actualizar UI
                        var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                        loginModal.hide();
                        mostrarNotificacionToast('¡Bienvenido!', 'Has iniciado sesión correctamente.', 'success');
                        // Recargar la página para que PHP actualice el estado de sesión en toda la UI
                        setTimeout(function(){ window.location.reload(); }, 1500);
                    } else {
                        errorDiv.text(response.message || "Error al iniciar sesión.");
                    }
                },
                error: function(){
                    errorDiv.text("Error de conexión al intentar iniciar sesión.");
                }
            });
        });
    });
</script>

</body>
</html>