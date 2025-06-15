<?php
// Iniciar sesión para acceder a $_SESSION['cliente']['id_usuario']
// y para pasar variables de alerta si es necesario.
session_start();
include_once "conexion.php"; // Aunque la conexión principal se usa en ajax.php, puede ser útil aquí para otras cosas.

$alert = isset($_SESSION['cart_alert']) ? $_SESSION['cart_alert'] : ""; // Ejemplo de cómo podrías pasar alertas
if (isset($_SESSION['cart_alert'])) {
    unset($_SESSION['cart_alert']); // Limpiar alerta después de mostrarla
}

// Variable para verificar si el usuario está logueado (para JS)
$isUserLoggedIn = isset($_SESSION['cliente']['id_usuario']);
$currentUserId = $isUserLoggedIn ? $_SESSION['cliente']['id_usuario'] : null;

?>
<!DOCTYPE html>
<html lang="es"> {/* Cambiado a español */}
<head>
    <?php require "global/cabecera.php"; // Contiene tus metas, links CSS de Bootstrap, etc. ?>
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente más moderna */
        }
        .container.main-content { /* Clase para el contenedor principal */
            margin-top: 30px; 
            margin-bottom: 30px;
            background-color: #ffffff; 
            padding: 30px;
            border-radius: 12px; /* Bordes más redondeados */
            box-shadow: 0 8px 16px rgba(0,0,0,0.1); /* Sombra más pronunciada */
        }
        .tbl_venta thead { 
            background-color: #007bff; /* Cabecera de tabla más destacada */
            color: white;
        }
        .tbl_venta tbody tr:hover {
            background-color: #f1f1f1; /* Efecto hover en filas */
        }
        .btn-custom-pago { 
            margin-top: 15px; 
            margin-left: 10px; /* Cambiado a margin-left para espaciado uniforme */
            padding: 10px 20px; /* Botones más grandes */
            font-size: 1rem;
        }
        .modal-header-custom { 
            background-color: #0069d9; /* Header del modal */
            color: white;
            border-bottom: none; /* Sin borde inferior en header */
        }
        .modal-title-custom { 
            font-weight: 500;
            font-size: 1.5rem;
        }
        .datos-pago-movil p { 
            margin-bottom: 0.75rem; /* Más espaciado en datos de pago */
            font-size: 1.1rem; 
            line-height: 1.6;
        }
        .datos-pago-movil strong { 
            display: inline-block; 
            width: 120px; /* Ancho ajustado para etiquetas */
            color: #495057;
        }
        .qr-code-placeholder { 
            width: 180px; /* QR más grande */
            height: 180px; 
            background-color: #e9ecef; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin: 20px auto; 
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1em; 
            color: #6c757d; 
            flex-direction: column; 
        }
        .product-quantity {
            box-shadow: none !important; /* Quitar sombra de focus en input cantidad */
            border-radius: 0.25rem;
        }
        .table th, .table td {
            vertical-align: middle; /* Alineación vertical centrada */
        }
        .alert-custom { /* Estilo para alertas personalizadas */
            border-left-width: 5px;
        }
        .total-final-strong { /* Para destacar el total final */
            font-size: 1.2em;
            color: #28a745; /* Verde para el total */
        }
    </style>
</head>
<body>

<?php require "global/header.php"; // Tu cabecera de navegación ?>

<div class="container main-content">
    <br>

    <?php if(!empty($alert)) : ?>
    <div class="alert alert-<?php echo htmlspecialchars($alert['type']); ?> alert-dismissible fade show alert-custom" role="alert">
        <?php echo htmlspecialchars($alert['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4"> 
        <h2 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Carrito de Compras</h2>
        <a href="pedidos.php" class="btn btn-outline-primary"> 
            <i class="fas fa-receipt me-2"></i>Mis Pedidos
        </a>
    </div>
    <hr class="mb-4"> 

    <div class="table-responsive">
        <table id="tabla_carrito" class="table table-hover tbl_venta"> 
            <thead>
                <tr>
                    <th width="100px">Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th width="120px" class="text-center">Cantidad</th> 
                    <th class="text-end" width="120px">Precio Unit.</th> 
                    <th class="text-end" width="120px">Precio Total</th> 
                    <th class="text-center" width="100px">Acción</th>
                </tr>
            </thead>
            <tbody id="detalle_venta">
                
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-3 lead">Cargando productos del carrito...</p>
                    </td>
                </tr>
            </tbody>
            <tfoot id="detalle_totales">
                
            </tfoot>
        </table>
    </div>

  
    <div id="acciones_carrito" class="text-end mt-4 py-3 border-top" style="display: none;">
      
        <button type="button" class="btn btn-info btn-custom-pago">
             <i class="fas fa-truck me-2"></i>Pedir a Domicilio
        </button>
        <button type="button" class="btn btn-primary btn-custom-pago">
            <i class="fas fa-store me-2"></i>Retirar en Tienda
        </button>
        <button type="button" class="btn btn-success btn-custom-pago" data-bs-toggle="modal" data-bs-target="#pagoMovilModal">
            <i class="fas fa-mobile-alt me-2"></i>Pagar con Pago Móvil
        </button>
    </div>
</div>


<div class="modal fade" id="pagoMovilModal" tabindex="-1" aria-labelledby="pagoMovilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title modal-title-custom" id="pagoMovilModalLabel">
                    <i class="fas fa-money-bill-wave me-2"></i>Datos para Pago Móvil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4"> 
                <p class="text-center lead mb-4">Por favor, realiza el pago a la siguiente cuenta y luego reporta tu pago:</p>
                <div class="datos-pago-movil my-3 p-3 bg-light border rounded"> 
                    <p><strong>Banco:</strong> <span>Banco Ejemplo, C.A.</span></p>
                    <p><strong>Teléfono:</strong> <span>0412-1234567</span></p>
                    <p><strong>Cédula/RIF:</strong> <span>J-123456789</span></p>
                    <p><strong>Monto a Pagar:</strong> <span id="montoPagoMovil" class="fw-bold text-success fs-5">Bs. 0.00</span></p>
                    <p><strong>Concepto:</strong> <span>Pago del Pedido</span></p>
                </div>
                <div class="qr-code-placeholder text-center">
                    <i class="fas fa-qrcode fa-7x text-muted"></i> 
                    <span class="mt-2">Escanea para pagar (si aplica)</span>
                </div>
                <p class="text-center mt-4 text-muted">
                    <small><strong>Importante:</strong> Una vez realizado el pago, por favor envía el comprobante a nuestro WhatsApp o correo electrónico para confirmar tu pedido.</small>
                </p>
            </div>
            <div class="modal-footer bg-light border-top-0"> 
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="https://wa.me/TUNUMERODEWHATSAPP?text=Hola,%20he%20realizado%20un%20pago%20móvil%20por%20mi%20pedido." target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp me-2"></i>Reportar Pago por WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

{/* Scripts JS */}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script> 
{/* <script src="js/popper.min.js"></script>  
{/* <script src="js/functions.js"></script>  
{/* <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script> 

<script type="text/javascript">
    const IS_USER_LOGGED_IN = <?php echo json_encode($isUserLoggedIn); ?>;
    const USER_ID = <?php echo json_encode($currentUserId); ?>;

    function showLoadingMessage() {
        $('#detalle_venta').html('<tr><td colspan="7" class="text-center py-5"><div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Cargando...</span></div><p class="mt-3 lead">Cargando productos del carrito...</p></td></tr>');
        $('#detalle_totales').html('');
        $('#acciones_carrito').hide();
    }

    function showEmptyCartMessage() {
        $('#detalle_venta').html('<tr><td colspan="7" class="text-center py-5"><i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i><br><p class="lead">Tu carrito de compras está vacío.</p><a href="index.php" class="btn btn-primary mt-2">Ver Productos</a></td></tr>');
        $('#detalle_totales').html('');
        $('#acciones_carrito').hide();
        $('#montoPagoMovil').text('Bs. 0.00');
    }

    function showErrorLoadingCart(message = "Error al cargar el carrito. Por favor, intenta de nuevo.") {
        $('#detalle_venta').html('<tr><td colspan="7" class="text-center py-5"><i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i><br><p class="lead">' + message + '</p><button class="btn btn-warning mt-2" onclick="attemptReloadCart()">Reintentar</button></td></tr>');
        $('#detalle_totales').html('');
        $('#acciones_carrito').hide();
    }
    function attemptReloadCart(){
      if (IS_USER_LOGGED_IN && USER_ID) {
          searchForDetalle(USER_ID);
      } else {
          showErrorLoadingCart("No se puede recargar el carrito: Usuario no identificado.");
      }
    }


    function updateCartView(info) {
        if (info.error) {
            showErrorLoadingCart(info.message || "Ocurrió un error desconocido.");
            return;
        }

        if (info.detalle && info.detalle.trim() !== "") {
            $('#detalle_venta').html(info.detalle);
            $('#acciones_carrito').slideDown(); // Efecto al mostrar
        } else {
            showEmptyCartMessage();
        }

        if (info.totales && info.totales.trim() !== "") {
            $('#detalle_totales').html(info.totales);
            // Actualizar el monto en el modal de Pago Móvil
            // El input hidden #total_carrito_final_val es generado por ajax.php
            var totalPagar = parseFloat($('#total_carrito_final_val').val()).toFixed(2); 
            if (!isNaN(totalPagar) && totalPagar >= 0) {
                $('#montoPagoMovil').text('Bs. ' + totalPagar);
            } else {
                 // Fallback si el input no existe o es inválido
                let totalTextElement = $('#detalle_totales').find('td > strong').last();
                if(totalTextElement.length) {
                    let totalFromText = parseFloat(totalTextElement.text().replace(/[^0-9.,]/g, '').replace(',', '.')).toFixed(2);
                    if(!isNaN(totalFromText) && totalFromText >= 0) {
                         $('#montoPagoMovil').text('Bs. ' + totalFromText);
                    } else {
                        $('#montoPagoMovil').text('Bs. 0.00'); // Default si no se puede obtener
                    }
                } else {
                    $('#montoPagoMovil').text('Bs. 0.00');
                }
            }
        } else {
            // Si no hay totales (ej. carrito vacío), limpiar.
            $('#detalle_totales').html('');
            $('#montoPagoMovil').text('Bs. 0.00');
        }
    }

    function searchForDetalle(usuarioId) {
        showLoadingMessage();
        $.ajax({
            url: 'AJAX/ajax.php', // Asegúrate que la RUTA a tu archivo ajax.php es correcta
            type: 'POST',
            dataType: 'json', // Esperamos una respuesta JSON
            data: { 
                action: 'searchForDetalle', 
                user: usuarioId // 'user' es como lo espera tu ajax.php
            },
            success: function(response) {
                updateCartView(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX (searchForDetalle): ", textStatus, errorThrown, jqXHR.responseText);
                showErrorLoadingCart("No se pudo conectar con el servidor. Verifica tu conexión (" + textStatus + ").");
            }
        });
    }

    function delProduct(correlativo) {
        // Considera añadir una confirmación aquí (ej. SweetAlert)
        // if (!confirm("¿Seguro que quieres eliminar este producto del carrito?")) return;

        // Mostrar algún indicador de carga sobre la fila o el botón (opcional)
        $('button[onclick*="delProduct(\'' + correlativo + '\')"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: 'AJAX/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delProductCarrito',
                id_detalle: correlativo 
            },
            success: function(response) {
                updateCartView(response);
                // Podrías añadir una notificación de éxito aquí (ej. un toast de Bootstrap)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX (delProductCarrito): ", textStatus, errorThrown, jqXHR.responseText);
                alert("No se pudo eliminar el producto del carrito. Por favor, intenta de nuevo.");
                // Habilitar botón de nuevo si falló
                $('button[onclick*="delProduct(\'' + correlativo + '\')"]').prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Borrar');
            }
        });
    }
    
    function validarCantidadInput(inputElement) {
        // Validación ligera mientras se escribe. min="1" en el input ayuda.
        // Si el valor es temporalmente inválido (ej. vacío), no hacer nada drástico.
        // La validación fuerte ocurre en handleQuantityChange.
        if (inputElement.value !== "" && parseInt(inputElement.value) < 1) {
             // Podrías añadir una clase de error visual al input
             // $(inputElement).addClass('is-invalid');
        } else {
             // $(inputElement).removeClass('is-invalid');
        }
    }

    function handleQuantityChange(inputElement) {
        var nuevaCantidad = parseInt(inputElement.value);
        var correlativo = $(inputElement).data('correlativo');

        if (isNaN(nuevaCantidad) || nuevaCantidad < 1) {
            nuevaCantidad = 1;
            inputElement.value = nuevaCantidad; // Corregir en la UI inmediatamente
        }
        // $(inputElement).removeClass('is-invalid'); // Limpiar clase de error si la hubo

        $(inputElement).prop('disabled', true); // Deshabilitar input durante la llamada

        $.ajax({
            url: 'AJAX/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'updateCantidad',    // Acción que tienes en tu PHP
                id_detalle: correlativo,     // 'id_detalle' es como lo espera tu ajax.php
                cantidad: nuevaCantidad
            },
            success: function(response) {
                updateCartView(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX (updateCantidad): ", textStatus, errorThrown, jqXHR.responseText);
                alert("No se pudo actualizar la cantidad. Por favor, recarga la página.");
                // Podrías intentar recargar el carrito completo si falla la actualización de cantidad
                 if (IS_USER_LOGGED_IN && USER_ID) searchForDetalle(USER_ID);
            },
            complete: function() {
                // No es necesario rehabilitar el input aquí explícitamente si updateCartView
                // siempre redibuja la tabla, ya que el input original será reemplazado.
                // Si no se redibuja por alguna razón, entonces sí sería necesario:
                // $('#txt_cant_producto_' + correlativo).prop('disabled', false);
            }
        });
    }

    $(document).ready(function(){
        if (IS_USER_LOGGED_IN && USER_ID) {
            searchForDetalle(USER_ID);
        } else {
            // Usuario no logueado, mostrar mensaje apropiado.
            showErrorLoadingCart("Debes iniciar sesión para ver tu carrito de compras.");
            // O redirigir a la página de login:
            // window.location.href = 'login.php'; 
        }
    });
</script>

</body>
</html>