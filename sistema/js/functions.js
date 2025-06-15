$(document).ready(function () {

    // ACTIVA CAMPOS PARA REGISTRAR CLIENTE
    $('.btn_new_cliente').click(function (e) {
        e.preventDefault();
        $('#nom_cliente').removeAttr('disabled');
        $('#tel_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');

        $('#div_registro_cliente').slideDown();
    });

    // BUSCAR CLIENTE
    $('#cedula_cliente').keyup(function (e) {
        e.preventDefault();

        var cl = $(this).val();
        var action = 'searchCliente';

        $.ajax({
            url: '../../AJAX/ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, cliente: cl },

            success: function (response) {
                if (response == 0) {
                    $('#idCliente').val('');
                    $('#nom_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    // MOSTRAR BOTÓN AGREGAR
                    $('.btn_new_cliente').slideDown('');
                } else {
                    var data = $.parseJSON(response);
                    $('#idCliente').val(data.id_cliente);
                    $('#nom_cliente').val(data.nombre);
                    $('#tel_cliente').val(data.telefono);
                    $('#dir_cliente').val(data.direccion);
                    // OCULTAR BOTÓN AGREGAR
                    $('.btn_new_cliente').slideUp();

                    // BLOQUE CAMPOS
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');

                    // OCULTA BOTÓN GUARDAR
                    $('.div_registro_cliente').slideUp();
                }
            },

            error: function (error) {
            }
        });
    });

    // CREAR CLIENTE - VENTAS
    $('#form_new_cliente_venta').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '../../AJAX/ajax.php',
            type: 'POST',
            async: true,
            data: $('#form_new_cliente_venta').serialize(),

            success: function (response) {
                if (response != 'error') {
                    // AGREGAR ID A INPUT HIDDEN
                    $('#idCliente').val(response);
                    // BLOQUEAR CAMPOS
                    $('#nom_cliente').removeAttr('disabled', 'disabled');
                    $('#tel_cliente').removeAttr('disabled', 'disabled');
                    $('#dir_cliente').removeAttr('disabled', 'disabled');
                    // OCULTAR BOTÓN AGREGAR
                    $('#btn_new_cliente').slideUp();
                    // OCULAR BOTÓN GUARDAR
                    $('#div_registro_cliente').slideUp();
                }
            },

            error: function (error) {
            }
        });
    });

    // BUSCAR PRODUCTO
    $('#txt_cod_producto').keyup(function (e) {
        e.preventDefault();

        var producto = $(this).val();
        var action = 'infoProducto'

        if (producto != '') {
            $.ajax({
                url: '../../AJAX/ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, producto: producto },

                success: function (response) {

                    if (response != 'error') {
                        var info = JSON.parse(response);
                        $('#txt_descripcion').html(info.descripcion);
                        $('#txt_existencia').html(info.stock);
                        $('#txt_cant_producto').val('1');
                        $('#txt_precio').html(info.precio);
                        $('#txt_precio_total').html(info.precio);

                        // ACTIVAR CANTIDAD
                        $('#txt_cant_producto').removeAttr('disabled');

                        // MOSTRAR BOTÓN AGREGAR
                        $('#add_product_venta').slideDown();
                    } else {
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_cant_producto').val('0');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');

                        // BLOQUEAR CANTIDAD
                        $('#txt_cant_producto').attr('disabled', 'disabled');

                        // OCULTAR BOTÓN AGREGAR
                        $('#add_product_venta').slideUp();
                    }
                },

                error: function (error) {
                }
            });
        }
    });

    // BUSCAR PRODUCTO DESCUENTO
    $('#txt_cod_producto').keyup(function (e) {
        e.preventDefault();
        var producto = $(this).val();
        var action = 'infoProducto';
        if (producto != '') {
            $.ajax({
                url: '../../AJAX/ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, producto: producto },
                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        var precio = parseFloat(info.precio);
                        var descuento = ($('#porcentaje_descuento').val() * precio) / 100;
                        var total_con_descuento = precio - descuento;

                        $('#txt_descripcion').html(info.descripcion);
                        $('#txt_precio').html(precio.toFixed(2));
                        $('#txt_precio_total').html(total_con_descuento.toFixed(2));

                        // ACTIVAR PORCENTAJE DESCUENTO
                        $('#porcentaje_descuento').removeAttr('disabled');
                        // MOSTRAR BOTÓN AGREGAR
                        $('#add_product_desc').slideDown();

                        // Agregar evento change al select de descuento
                        $('#porcentaje_descuento').off('change').on('change', function () {
                            var nuevo_descuento = $(this).val();
                            var nuevo_descuento_calculado = (nuevo_descuento * precio) / 100;
                            var nuevo_total_con_descuento = precio - nuevo_descuento_calculado;

                            $('#txt_precio_total').html(nuevo_total_con_descuento.toFixed(2));
                        });
                    } else {
                        $('#txt_descripcion').html('-');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');
                        // BLOQUEAR CANTIDAD
                        $('#porcentaje_descuento').attr('disabled', 'disabled');
                        // OCULTAR BOTÓN AGREGAR
                        $('#add_product_desc').slideUp();
                    }
                },
                error: function (error) {
                    console.error("Error en la llamada AJAX:", error);
                }
            });
        }
    });

    // VALIDAR CANTIDAD DEL PRODUCTO ANTES DE AGREGAR
    $('#txt_cant_producto').keyup(function (e) {
        e.preventDefault();
        var precio_total = $(this).val() * $('#txt_precio').html();
        var existencia = parseInt($('#txt_existencia').html());
        $('#txt_precio_total').html(precio_total);

        // QUITA EL BOTÓN AGREGAR SI LA CANTIDAD ES MENOR QUE 1
        if (($(this).val() < 1 || isNaN($(this).val())) || $(this).val() > existencia) {
            $('#add_product_venta').slideUp();
        } else {
            $('#add_product_venta').slideDown();
        }
    });

    // AGREGAR PRODUCTO AL DETALLE
    $('#add_product_venta').click(function (e) {
        e.preventDefault();
        if ($('#txt_cant_producto').val() > 0) {
            var codproducto = $('#txt_cod_producto').val();
            var cantidad = $('#txt_cant_producto').val();
            var action = 'addProductDetalle';

            $.ajax({
                url: '../../AJAX/ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, producto: codproducto, cantidad: cantidad },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        $('#detalle_venta').html(info.detalle);
                        $('#detalle_totales').html(info.totales);

                        $('#txt_cod_producto').val('');
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_cant_producto').val('0');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');

                        //BLOQUEAR CANTIDAD
                        $('#txt_cant_producto').attr('disabled', 'disabled');

                        //OCULTAR BOTÓN AGREGAR
                        $('#add_product_venta').slideUp();
                    } else {
                        console.log('no data');
                    }
                    viewProcesar();
                },

                error: function (error) {
                }
            })
        }
    });

    // ANULAR VENTA
    $('#btn_anular_venta').click(function (e) {
        e.preventDefault();

        var rows = $('#detalle_venta tr').length;
        if (rows > 0) {
            var action = 'anularVenta';

            $.ajax({
                url: '../../AJAX/ajax.php',
                type: 'POST',
                async: true,
                data: { action: action },

                success: function (response) {
                    if (response != 'error') {
                        location.reload();
                    }
                },

                error: function (response) {
                }
            })
        }
    })

    // PROCESAR VENTA
    $('#btn_facturar_venta').click(function (e) {
        e.preventDefault();

        var rows = $('#detalle_venta').length;
        if (rows > 0) {
            var action = 'procesarVenta';
            var codcliente = $('#idCliente').val();

            $.ajax({
                url: '../../AJAX/ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, codcliente: codcliente },

                success: function (response) {
                    if (response != 'error') {
                        //var info = JSON.parse(response)
                        //console.log(info)

                        //generarPDF(info.id_cliente,info.nro_factura)
                        location.reload()
                    } else {
                        console.log('no data');
                    }
                },

                error: function (response) {
                }
            })
        }
    })

    // MODAL FORM DELETE PRODUCT
    $('.del_product').click(function (e) {
        e.preventDefault();
        var producto = $(this).attr('product');
        var action = 'infoProducto';

        $.ajax({
            url: '../../AJAX/ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, producto: producto },

            success: function (response) {
                if (response != 'error') {

                    var info = JSON.parse(response)

                    showModal();
                    $('.bodyModal').html(
                        '<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delProduct();">' +
                        '<h3 class="modalTitle"><i class="fas fa-cubes"></i> Eliminar producto</h3>' +

                        '<h4 class="nameProducto">' + info.descripcion + '</h4>' +

                        '<input type="hidden" name="id_producto" id="id_producto" value="' + info.id_producto + '">' +
                        '<input type="hidden" name="action" value="delProduct">' +
                        '<div class="alert alertDelProduct"></div>' +
                        '<button type="submit" class="btn_borrar"><i class="fas fa-trash-alt"></i> Eliminar</button>' +
                        '<a href="#" class="btn btn-primary" onclick="closeModal();">Cerrar</a>' +
                        '</form>'
                    )

                } else {
                    alert("Hubo un problema obteniendo la info del producto")
                }
            },

            error: function (error) {
            }
        });
    })

    // MODAL FORM ANULAR FACTURA
    $('#listaVentas tbody').on('click', '.anular_factura', function (e) {
        e.preventDefault();
        var nro_factura = $(this).attr('fac');
        var action = 'infoFactura';
        $.ajax({
            url: '../../AJAX/ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, nro_factura: nro_factura },
            success: function (response) {
                if (response != 'error') {
                    var info = JSON.parse(response);
                    console.log(info);
                    showModal();
                    $('.bodyModal').html(
                        '<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">' +
                        '<h3 class="modalTitle"><i class="fas fa-cubes"></i> Anular Factura</h3>' +
                        '<div class="modalContent">' +
                        '<p>¿Está seguro de anular la siguiente factura?</p>' +
                        '<p style="color:black;"><strong>Nro. ' + info.nro_factura + '</strong></p>' +
                        '<p style="color:black;"><strong>Monto Bs. ' + info.total_factura + '</strong></p>' +
                        '<p style="color:black;"><strong>Fecha. ' + info.fecha + '</strong></p>' +
                        '<input type="hidden" name="action" value="anularFactura"></input>' +
                        '<input type="hidden" name="nro_factura" id="nro_factura" value="' + info.nro_factura + '"></input>' +
                        '<div class="alert alertDelProduct"></div>' +
                        '</div>' +
                        '<div class="modalButtons">' +
                        '<button type="submit" name="boton_anular" class="btn_borrar"><i class="fas fa-trash-alt"></i> Anular</button>' +
                        '<button class="btn_cerrar" onclick="closeModal();">Cerrar</button>' +
                        '</div>' +
                        '</form>'
                    );
                } else {
                    alert("Hubo un problema obteniendo la info de la factura");
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    });

    // VER FACTURA
    $('#listaVentas tbody').on('click', '.view_factura', function (e) {
        e.preventDefault();
        var id_cliente = $(this).attr('cl');
        var nro_factura = $(this).attr('f');
        generarPDF(id_cliente, nro_factura);
    });

    // Función para manejar la carga de imágenes
    function cargarImagen(buttonId, inputId, tipoImagen) {
        $(buttonId).off('click').click(function () {
            var formData = new FormData();
            var fileInput = $(inputId)[0];
            var directorio = $(inputId).siblings('input[type="hidden"][id="directorio"]').val();
            var id = $(inputId).siblings('input[type="hidden"][id="id"]').val();

            if (fileInput.files.length > 0) {
                formData.append('imagen', fileInput.files[0]);
                formData.append('tipo_imagen', tipoImagen);
                formData.append('id', id);
                formData.append('directorio', directorio);

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert(res.message);
                            location.reload(); // Recargar la página para ver los cambios
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function () {
                        alert('Error en la carga');
                    }
                });
            } else {
                alert('Por favor, selecciona una imagen.');
            }
        });
    }

    // Llamar a la función para cada botón de carga
    cargarImagen('#cargar_logo', '#imagen_logo', 'logo');
    cargarImagen('#cargar_landing_1', '#imagen_landing_1', 'img_landing_1');
    cargarImagen('#cargar_landing_2', '#imagen_landing_2', 'img_landing_2');
    cargarImagen('#cargar_landing_3', '#imagen_landing_3', 'img_landing_3');
    cargarImagen('#cargar_publicidad', '#imagen_publicidad', 'publicidad_detalle');

    $(document).on('click', '#btn_cancelar_pedido', cancelarPedidoHandler);
    $(document).on('click', '#btn_aprobar_pedido', aprobarPedidoHandler);
    $(document).on('click', '#aprobar_solicitud', aprobarSolicitudHandler);
    $(document).on('click', '#denegar_solicitud', denegarSolicitudHandler);
    $(document).on('keyup', '#txt_producto', buscarProductoHandler);
    $(document).on('click', '#btn_cat_prod', buscarCategoriaHandler);
    $(document).on('submit', '#form_ajuste_inv', ajusteStockaHandler);
    $(document).on('click', '#add_product_desc', enviarDescuentoaHandler);
    $(document).on('click', '#btn_eliminar_usuario', eliminarUsuarioHandler);
    $(document).on('click', '#btn_restablecer_usuario', restablecerUsuarioHandler);
    $(document).on('click', '#modal_excel', modalExcelHandler);
    $(document).on('click', '#modal_excel_usu', modalExcelUsuHandler);

}); // FIN DEL READY







// MANEJADOR DE EVENTOS

/*CARGAR IMÁGENES EN EL LANDING*/

function cargarLanding1Handler() {
    var formData = new FormData();
    var fileInput = $('#imagen_landing_1')[0];
    var tipoImagen = $('#landing_1').val();
    var directorio = $('#directorio').val();
    var id = $('#id').val();

    if (fileInput.files.length > 0) {
        formData.append('imagen', fileInput.files[0]);
        formData.append('tipo_imagen', tipoImagen);
        formData.append('directorio', directorio);
        formData.append('id', id);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert(res.message);
                }
            },
            error: function () {
                alert('Error en la carga');
            }
        });
    } else {
        alert('Por favor, selecciona una imagen.');
    }
}

/*CARGAR IMÁGENES EN EL LANDING*/

// CARGAR NUEVA IMAGEN DE LOGO
function cargarLogoHandler() {
    var formData = new FormData();
    var fileInput = $('#imagen_logo')[0];
    var tipoImagen = $('#tipo_imagen').val();
    var directorio = $('#directorio').val();
    var id = $('#id').val();

    if (fileInput.files.length > 0) {
        formData.append('imagen', fileInput.files[0]);
        formData.append('tipo_imagen', tipoImagen);
        formData.append('directorio', directorio)
        formData.append('id', id);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert(res.message);
                }
            },
            error: function () {
                alert('Error en la carga');
            }
        });
    } else {
        alert('Por favor, selecciona una imagen.');
    }
}

// MODAL DE CARGAR USUARIOS POR EXCEL
function modalExcelUsuHandler() {
    showModal();
    $('.bodyModal').html(
        '<div class="orderForm" style="padding: 15px;">' +
        '<h2><i class="fa fa-table"></i> Cargar archivo CSV (Excel)</h2>' +
        '<div class="contSeparar">' +
        '<h5>¿Desea obtener la plantilla para cargar usuarios? <a href="../plantillas/usuariosCSV.php" class="btn btn-info">Descargar plantilla</a></h5>' +
        '</div>' +
        '<div class="modalButtons">' +
        '<a href="cargarCSV.php" class="btn btn_excel"><i class="fa fa-table"></i> Cargar archivo</a>' +
        '<a href="#" onclick="closeModal();" class="btn btn-danger">Cancelar</a>' +
        '</div>' +
        '</div>'
    )
}

// MODAL DE CARGAR ARCHIVO EXCEL
function modalExcelHandler() {
    showModal();
    $('.bodyModal').html(
        '<div class="orderForm" style="padding: 15px;">' +
        '<h2><i class="fa fa-table"></i> Cargar archivo CSV (Excel)</h2>' +
        '<div class="contSeparar">' +
        '<h5>¿Desea obtener la plantilla para cargar productos? <a href="../plantillas/productosCSV.php" class="btn btn-info">Descargar plantilla</a></h5>' +
        '</div>' +
        '<div class="modalButtons">' +
        '<a href="cargarCSV.php" class="btn btn_excel"><i class="fa fa-table"></i> Cargar archivo</a>' +
        '<a href="#" onclick="closeModal();" class="btn btn-danger">Cancelar</a>' +
        '</div>' +
        '</div>'
    )
}

// REVERSAR LA ELIMINACIÓN DE UN USUARIO
function restablecerUsuarioHandler() {
    var id_usuario = $(this).attr('id_usuario');

    showModal();
    $('.bodyModal').html(
        '<div class="orderForm">' +
        '<h2>Eliminar usuario</h2>' +
        '<h5>¿Desea restablecer al usuario #' + id_usuario + '?</h5>' +
        '<form onsubmit="event.preventDefault(); restablecerUsuario(' + id_usuario + ')">' +
        '<div class="alert alertUsuario"></div>' +
        '<button type="submit" class="btn btn-info" id="conf_rest_usuario">Restablecer</button>' +
        '<a href="#" onclick="closeModal();" class="btn btn-danger">Cancelar</a>' +
        '</form>' +
        '</div>'
    )
}

// ELIMINAR UN USUARIO
function eliminarUsuarioHandler() {
    var id_usuario = $(this).attr('id_usuario');

    showModal();
    $('.bodyModal').html(
        '<div class="orderForm">' +
        '<h2>Eliminar usuario</h2>' +
        '<h5>¿Está seguro de eliminar al usuario #' + id_usuario + '?</h5>' +
        '<form onsubmit="event.preventDefault(); eliminarUsuario(' + id_usuario + ')">' +
        '<div class="alert alertUsuario"></div>' +
        '<button type="submit" class="btn btn-primary" id="conf_eli_usuario">Eliminar</button>' +
        '<a href="#" onclick="closeModal();" class="btn btn-danger">Cerrar</a>' +
        '</form>' +
        '</div>'
    )
}

// LANZAR DESCUENTO DE UN PRODUCTO
function enviarDescuentoaHandler() {
    var id_producto = $('#txt_cod_producto').val(); // ID del producto
    var porcentaje_descuento = $('#porcentaje_descuento').val(); // Porcentaje de descuento

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        data: {
            action: 'insertarDescuento',
            id_producto: id_producto,
            porcentaje_descuento: porcentaje_descuento
        },
        success: function (response) {
            if (response != 'error') {
                alert(response);
                location.reload();
            } else {
                console.log('no data');
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la llamada AJAX:", error);
        }
    });
}

// AJUSTAR STOCK DE UN INVENTARIO
function ajusteStockaHandler() {
    var formData = $(this).serialize(); // Serializar los datos del formulario

    // Realizar la llamada AJAX para enviar los datos de ajuste
    $.ajax({
        url: '../../AJAX/ajax.php', // Cambia esto a la ruta de tu archivo PHP
        type: 'POST',
        data: { action: 'ajustarStock', formData: formData },
        success: function (response) {
            // Manejar la respuesta del servidor
            alert(response); // Puedes mostrar un mensaje de éxito o manejar la respuesta como desees
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error("Error en la llamada AJAX:", error);
        }
    });
}

// BUSCAR PRODUCTOS POR CATEGORÍA AL PRESIONAR EL BOTÓN CORRESPONDIENTE
function buscarCategoriaHandler() {
    var categoriaId = $(this).attr("id_categoria"); // Obtener el ID de la categoría
    var action = "buscarCategoria";

    // Realizar la llamada AJAX
    $.ajax({
        url: '../../AJAX/ajax.php', // Cambia esto a la ruta de tu archivo PHP
        type: 'POST',
        data: { action: action, id_categoria: categoriaId },
        success: function (response) {
            // Aquí se espera que el servidor devuelva una tabla HTML
            $("#productos_cat").html(response); // Insertar la respuesta en el segundo panel
        },
        error: function (xhr, status, error) {
            console.error("Error en la llamada AJAX:", error);
        }
    });
}

// BUSCAR PRODUCTO
function buscarProductoHandler() {
    producto = $(this).val();
    var action = 'infoProducto2'

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, producto: producto },
        success: function (response) {

            if (response != 'error') {
                var info = JSON.parse(response);
                $('#txt_nom_prod').html(info.nombre);
                $('#txt_desc_prod').html(info.descripcion);
                $('#txt_stock_prod').html(info.stock);
                $('#txt_smin_prod').html(info.stock_min);
                $('#txt_smax_prod').html(info.stock_max);
                $('#cant_prod').removeAttr('disabled');
            } else {
                $('#txt_nom_prod').html('');
                $('#txt_desc_prod').html('');
                $('#txt_stock_prod').html('');
                $('#txt_smin_prod').html('');
                $('#txt_smax_prod').html('');
                $('#cant_prod').attr('disabled', 'disabled');
            }
        },
        error: function (error) {
        }
    });
}

// MODAL PARA APROBAR PEDIDOS
function aprobarPedidoHandler() {
    var id_pedido = $(this).attr('pedido');

    showModal();
    $('.bodyModal').html(
        '<div>' +
        '<h2>Aprobar pedido</h2>' +
        '<h5>¿Está seguro de aprobar el pedido #' + id_pedido + '?</h5>' +
        '<form enctype="multipart/form-data" onsubmit="event.preventDefault(); aprobarPedido(' + id_pedido + ');">' +
        '<div class="alert alertPedido"></div>' +
        '<button type="submit" class="btn btn-primary" id="confirmar_procesar">Aprobar</button>' +
        '<a href="#" style="margin-left:1em;" onclick="closeModal();" class="btn btn-danger">Cerrar</a>' +
        '</form>' +
        '</div>'
    )
}

// MODAL PARA CANCELAR PEDIDOS
function cancelarPedidoHandler() {
    var id_pedido = $(this).attr('pedido');

    showModal();
    $('.bodyModal').html(
        '<div>' +
        '<h2>Cancelar pedido</h2>' +
        '<h5>¿Está seguro de eliminar el pedido #' + id_pedido + '?</h5>' +
        '<form enctype="multipart/form-data" onsubmit="event.preventDefault(); cancelarPedido(' + id_pedido + ');">' +
        '<div class="alert alertPedido"></div>' +
        '<button type="submit" class="btn btn-primary" id="confirmar_procesar">Confirmar</button>' +
        '<a href="#" style="margin-left:1em;" onclick="closeModal();" class="btn btn-danger">Cerrar</a>' +
        '</form>' +
        '</div>'
    )
}

// MODAL APROBAR SOLICITUD 
function aprobarSolicitudHandler() {
    var id_solicitud = $(this).attr('solicitud');
    var soli_cedula = $('#soli_cedula').html();

    showModal();
    $('.bodyModal').html(
        '<div>' +
        '<h2>Cancelar pedido</h2>' +
        '<h5>¿Está seguro de aprobar la solicitud #' + id_solicitud + '?</h5>' +
        '<form enctype="multipart/form-data" onsubmit="event.preventDefault(); aprobarSolicitud(' + id_solicitud + ',' + soli_cedula + ');">' +
        '<div class="alert alertPedido"></div>' +
        '<button type="submit" class="btn btn-primary" id="ap_soli">Aprobar</button>' +
        '<a href="#" style="margin-left:1em;" onclick="closeModal();" class="btn btn-danger">Cerrar</a>' +
        '</form>' +
        '</div>'
    )
}

// MODAL DENEGAR SOLICITUD
function denegarSolicitudHandler() {
    var id_solicitud = $(this).attr('solicitud');

    showModal();
    $('.bodyModal').html(
        '<div>' +
        '<h2>Cancelar pedido</h2>' +
        '<h5>¿Está seguro de denegar la solicitud #' + id_solicitud + '?</h5>' +
        '<form enctype="multipart/form-data" onsubmit="event.preventDefault(); denegarSolicitud(' + id_solicitud + ');">' +
        '<div class="alert alertPedido"></div>' +
        '<button type="submit" class="btn btn-primary" id="ap_soli">Denegar solicitud</button>' +
        '<a href="#" style="margin-left:1em;" onclick="closeModal();" class="btn btn-danger">Cerrar</a>' +
        '</form>' +
        '</div>'
    )
}

// MANEJADOR DE EVENTOS










// FUNCIÓN PARA RESTABLECER UN USUARIO
function restablecerUsuario(id_usuario) {
    var action = "restablecerUsuario";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_usuario: id_usuario },

        success: function (response) {
            if (response != 'Usuario restablecido correctamente.') {
                $('.alertUsuario').html('');
                $('.alertUsuario').html('<p>' + response + '</p>');
            } else {
                $('.alertUsuario').html('');
                $('.alertUsuario').html('<p>' + response + '</p>');
                $('#conf_rest_usuario').remove();

                // Esperar 2 segundos antes de cerrar el modal y recargar la página
                setTimeout(function () {
                    closeModal(); // Cerrar el modal
                    location.reload(); // Recargar la página
                }, 700); // 2000 milisegundos = 2 segundos
            }
        },

        error: function (error) {
        }
    })
}

// FUNCIÓN PARA ELIMINAR UN USUARIO
function eliminarUsuario(id_usuario) {
    var action = "eliminarUsuario";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_usuario: id_usuario },

        success: function (response) {
            if (response != 'Usuario eliminado correctamente.') {
                $('.alertUsuario').html('');
                $('.alertUsuario').html('<p>' + response + '</p>');
            } else {
                $('.alertUsuario').html('');
                $('.alertUsuario').html('<p>' + response + '</p>');
                $('#conf_eli_usuario').remove();

                // Esperar 2 segundos antes de cerrar el modal y recargar la página
                setTimeout(function () {
                    closeModal(); // Cerrar el modal
                    location.reload(); // Recargar la página
                }, 700); // 2000 milisegundos = 2 segundos
            }
        },

        error: function (error) {
        }
    })
}

// FUNCIÓN APROBAR SOLICITUD DE CAMBIO DE CÉDULA
function aprobarSolicitud(id_solicitud, soli_cedula) {
    var action = "aprobarSolicitud";
    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_solicitud: id_solicitud, soli_cedula: soli_cedula },

        success: function (response) {
            if (response == 'error') {
                $('.alertPedido').html('<p>Error al aprobar la solicitud</p>');
            } else {
                $('.alertPedido').html('<p>Solicitud aprobada con éxito</p>');
                $('#ap_soli').remove();
                closeModal();
                location.reload();
            }
        },

        error: function (error) {
        }
    })
}

// FUNCIÓN DENEGAR SOLICITUD DE CAMBIO DE CÉDULA
function denegarSolicitud(id_solicitud) {
    var action = "cancelarSolicitud";
    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_solicitud: id_solicitud },

        success: function (response) {
            if (response == 'error') {
                $('.alertPedido').html('<p>Error al aprobar la solicitud</p>');
            } else {
                $('#ap_soli').remove();
                closeModal();
                location.reload();
            }
        },

        error: function (error) {
        }
    })
}

// FUNCIÓN APROBAR PEDIDOS
function aprobarPedido(id_pedido) {
    var action = "aprobarPedido";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_pedido: id_pedido },

        success: function (response) {
            if (response == 'error') {
                $('.alertPedido').html('<p>Error al aprobar el pedido</p>');
            } else {
                $('.alertPedido').html('<p>Pedido aprobado con éxito</p>');
                $('#confirmar_procesar').remove();
                location.reload();
            }
        },

        error: function (error) {
        }
    })
}

// FUNCIÓN CANCELAR PEDIDOS
function cancelarPedido(id_pedido) {
    var action = "cancelarPedido";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_pedido: id_pedido },

        success: function (response) {
            if (response == 'error') {
                $('.alertPedido').html('<p>Error al cancelar el pedido</p>');
            } else {
                $('.alertPedido').html('<p>Pedido cancelado con éxito</p>');
                $('#confirmar_procesar').remove();
                location.reload();
            }
        },

        error: function (error) {
        }
    })
}

// GENERAR PDF
function generarPDF(cliente, factura) {
    console.log(cliente, factura);

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width / 2) - (ancho / 2))
    var y = parseInt((window.screen.height / 2) - (alto / 2))

    var direccion = "../..";

    $url = direccion + '/factura/generaFactura.php?cl=' + cliente + '&f=' + factura;
    window.open($url, "Factura", "left=" + x + ",top=" + y + ",height=" + alto + ",width=" + ancho + ",scrollbar=si,location=no,resizable=si,menubar=si")

}

// GENERAR REPORTE PDF
function generarReportePDF(f_inicio, f_fin) {
    console.log(f_inicio, f_fin);

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width / 2) - (ancho / 2))
    var y = parseInt((window.screen.height / 2) - (alto / 2))

    var direccion = "../..";

    $url = direccion + '/reporte/generarReporte.php?fecha_inicio=' + f_inicio + '&fecha_fin=' + f_fin;
    window.open($url, "Factura", "left=" + x + ",top=" + y + ",height=" + alto + ",width=" + ancho + ",scrollbar=si,location=no,resizable=si,menubar=si")

}

//ELIMINAR PRODUCTOS DEL DETALLE
function del_product_detalle(correlativo) {

    var action = 'delProductoDetalle';
    var id_detalle = correlativo;

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_detalle: id_detalle },

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales);

                $('#txt_cod_producto').val('');
                $('#txt_descripcion').html('-');
                $('#txt_existencia').html('-');
                $('#txt_cant_producto').val('0');
                $('#txt_precio').html('0.00');
                $('#txt_precio_total').html('0.00');

                //BLOQUEAR CANTIDAD
                $('#txt_cant_producto').attr('disabled', 'disabled');

                //OCULTAR BOTÓN AGREGAR
                $('#add_product_venta').slideUp();
            } else {
                $('#detalle_venta').html("");
                $('#detalle_totales').html("");
            }
            viewProcesar();
        },

        error: function (error) {
        }
    })

}

// MOSTRAR/OCULTAR BOTÓN PROCESAR
function viewProcesar() {
    if ($('#detalle_venta tr').length >= 0) {
        $('#btn_facturar_venta').show();
    } else {
        $('#btn_facturar_venta').hide();
    }
}

// SI YA HAY UNA FACTURA MONTADA, LA BUSCA Y LA MUESTRA,
// PORQUE CADA VENDEDOR SOLO PUEDE PROCESAR UNA VENTA A LA VEZ
function searchForDetalle(id) {
    var action = 'searchForDetalle';
    var user = id;

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, user: user },

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales);
            } else {
                console.log('no data');
            }
            viewProcesar();
        },

        error: function (error) {
        }
    })
}

// ELIMINAR PRODUCTO (MODAL)
function delProduct() {
    $('.alertDelProduct').html('');
    var pr = $('#id_producto').val();

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: $('#form_del_product').serialize(),

        success: function (response) {
            if (response == 'error') {
                $('.alertDelProduct').html('<p>Error al eliminar el producto</p>');
            } else {
                $('.row_' + pr).remove();
                $('#form_del_product .btn_borrar').remove();
                $('.alertDelProduct').html('<p>Producto eliminado correctamente</p>');
            }
        },

        error: function (error) {
        }
    })
}

// ANULAR FACTURA (MODAL)
function anularFactura() {
    var nro_factura = $('#nro_factura').val();
    var action = 'anularFactura';

    $('.alertDelProduct').html('');

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, nro_factura: nro_factura },

        success: function (response) {
            if (response == 'error') {
                $('.alertDelProduct').html('<p>Error al anular la factura</p>');
            } else {
                $('#row_' + nro_factura + ' .estado').html('<span class="anulada">Anulada</span>');
                $('#form_anular_factura .btn_borrar').remove();
                $('#row_' + nro_factura + ' .div_acciones').html('<button class="btn btn-danger btn-xs btn-anulada"><i class="fa-solid fa-ban"></i></button>');
                $('.alertDelProduct').html('<p>Factura anulada correctamente</p>');
            }
        },

        error: function (error) {
        }
    })
}

// CERRAR MODAL
function closeModal() {
    $('.modal').fadeOut();
}

// MOSTRAR MODAL
function showModal() {
    var flex = "display:flex;"

    $('.modal').fadeIn();
    $('.modal').attr('style', flex)
}

// BORRAR UN DESCUENTO
function borrarDescuento(id_producto) {

    var action = "borrarDescuento";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_producto: id_producto },

        success: function (response) {
            if (response != 'error') {
                alert(response);
                location.reload();
            } else {
                alert("Error al eliminar el descuento");
            }
        },

        error: function (error) {
        }
    })

}

// FUNCIÓN PARA ACTUALIZAR LA CONFIGURACIÓN GENERAL
function conf_general() {
    var nombre = $('#nom_comp').val();
    var rif = $('#rif').val();
    var correo = $('#correo').val();
    var telefono = $('#telefono').val();
    var direccion = $('#direccion').val();

    var action = "actualizarConfigGeneral";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {
            action: action, nombre: nombre, rif: rif, correo: correo,
            direccion: direccion, telefono: telefono
        },

        success: function (response) {
            if (response != 'exito') {
                info = JSON.parse(response);
                Swal.fire({
                    title: '¡Oh no!',
                    text: info,
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                })
            } else {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios guardados',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                });
                $('#txt_boton_config').fadeOut();
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error: " + textStatus + " - " + errorThrown);
        }
    })
}

// FUNCIÓN PARA ACTUALIZAR LA CONFIGURACIÓN DEL PANEL DE ADMINISTRACIÓN
function conf_admin() {
    var principal = $('#color_principal').val();
    var secundario = $('#color_secundario').val();
    var complementario = $('#color_complementario').val();
    var lateral = $('#fuente_lateral').val();

    var action = "actualizarConfigAdmin";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {
            action: action, principal: principal,
            secundario: secundario, complementario: complementario,
            lateral: lateral
        },

        success: function (response) {
            if (response != 'exito') {
                info = JSON.parse(response);
                Swal.fire({
                    title: '¡Oh no!',
                    text: info,
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                });
            } else {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios guardados',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                }).then(() => {
                    location.reload(); // Recargar la página después de cerrar el alert
                });

                $('#txt_boton_admin').fadeOut();
            }
        },


        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error: " + textStatus + " - " + errorThrown);
        }
    })
}

// FUNCIÓN PARA ACTUALIZAR LA CONFIGURACIÓN DE LA TIENDA
function conf_tienda() {
    var txt_lnd_1 = $('#txt_landing_1').val();
    var txt_lnd_2 = $('#txt_landing_2').val();
    var txt_lnd_3 = $('#txt_landing_3').val();
    var instagram = $('#instagram').val();
    var facebook = $('#facebook').val();
    var whatsapp = $('#whatsapp').val();

    var action = "actualizarConfigTienda";

    $.ajax({
        url: '../../AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {
            action: action, landing_1: txt_lnd_1, landing_2: txt_lnd_2, landing_3: txt_lnd_3,
            instagram: instagram, facebook: facebook, whatsapp: whatsapp
        },

        success: function (response) {
            if (response != 'exito') {
                info = JSON.parse(response);
                Swal.fire({
                    title: '¡Oh no!',
                    text: info,
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                })
            } else {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios guardados',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                });
                $('#txt_boton_tienda').fadeOut();
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error: " + textStatus + " - " + errorThrown);
        }
    })
}