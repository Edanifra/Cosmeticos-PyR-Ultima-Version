$(document).ready(function(){

    $(document).on('click', '#btn_iniciar_sesion', iniciarSesionHandler);
    $(document).on('click', '#btn_procesar_pedido', procesarPedidoHandler);
    $(document).on('click', '#btn_reportar_pedido', reportarPedidoHandler);
    $(document).on('click', '#btn_cancelar_pedido', cancelarPedidoHandler);
    $(document).on('click', '#cambio_cedula', cambioCedulaHandler);
    $(document).on('click', '#btn_editar_foto', modalPerfilHandler);
    $(document).on('click', '#btn_borrar_foto', borrarPerfilHandler);
    $(document).on('change', '#foto', cambiar);
    $(document).on('click', '.delPhoto', borrar);
    $(document).off('click', '#marcar_leido').on('click', '#marcar_leido', marcarUnLeidoHandler);
    $(document).off('click', '#todo_leido').on('click', '#todo_leido', marcarTodoLeidoHandler);
    $(document).off('click', '#eli_noti').on('click', '#eli_noti', eliminarNotificacionHandler);
    $(document).off('click', '#add_dir').on('click', '#add_dir', agregarDireccionHandler);
    $(document).off('click', '#edit_dir').on('click', '#edit_dir', editarDireccionHandler);
    $(document).off('click', '#delete_dir').on('click', '#delete_dir', eliminarDireccionHandler);
    $(document).off('click', '#btn_delivery').on('click', '#btn_delivery', modalDelivery);
    $(document).off('click', '#btn_retiros').on('click', '#btn_retiros', cargarPedidos);
    $(document).off('click', '#btn_domicilio').on('click', '#btn_domicilio', cargarDelivery);
    $(document).off('click', '.view_factura').on('click', '.view_factura', verFacturaHandler);

})






// MANEJADOR DE EVENTOS

function verFacturaHandler(e){
    e.preventDefault();
    var id_cliente = $(this).attr('cl');
    var nro_factura = $(this).attr('f');

    generarPDF(id_cliente,nro_factura);
}

// CARGAR PEDIDOS A DOMICILIO
function cargarDelivery(e){
    e.preventDefault();
    let cliente = $(this).attr('cliente');
    
    $.ajax({
        type: "POST",
        url: "AJAX/ajax.php",
        data: {
            action: 'mostrarDelivery',
            cliente: cliente
        },
        dataType: "json",
        success: function(response) {
            // Verifica si hay datos
            if(response.data && response.data.length > 0) {
                $('#miDataTable').html(response.tabla);
                $('#tabla_delivery').DataTable({
                    data: response.data,
                    columns: [
                        { data: 'id_pedido' },
                        { data: 'fecha_pedido' },
                        { data: 'estado_pedido' },
                        { data: 'direccion' },
                        { data: 'monto_total' },
                        { data: 'tipo_pago' },
                        { data: 'acciones' }
                    ],
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
            } else {
                Swal.fire({
                    title: 'Ups...',
                    text: 'No hay pedidos a domicilios cargados',
                    icon: 'error',
                    confirmButtonText: 'Vale'
                })
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            console.error("Response:", jqXHR.responseText);
            Swal.fire({
                title: 'Ups...',
                text: 'Ha ocurrido un error al cargar los pedidos.',
                icon: 'error',
                confirmButtonText: 'Vale'
            })
        }
    });
}

// CARGAR PEDIDOS PARA RETIRAR EN TIENDA
function cargarPedidos(e) {
    e.preventDefault();
    let pagina = 1;
    let id_cliente = $(this).attr('cliente');
    $.ajax({
        type: "POST",
        url: "AJAX/ajax.php",
        data: {
            action: 'mostrarPedidos',
            cliente: id_cliente,
            pagina: pagina
        },
        dataType: "json",
        success: function(response) {
            // Verifica si hay datos
            if(response.data && response.data.length > 0) {
                $('#miDataTable').html(response.tabla);
                $('#tabla_pedidos').DataTable({
                    data: response.data,
                    columns: [
                        { data: 'id_pedido' },
                        { data: 'fecha_pedido' },
                        { data: 'estado_pedido' },
                        { data: 'monto_total' },
                        { data: 'tipo_pago' },
                        { data: 'acciones' }
                    ],
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
            } else {
                Swal.fire({
                    title: 'Ups...',
                    text: 'No hay pedidos de retiro cargados.',
                    icon: 'error',
                    confirmButtonText: 'Vale'
                })
            }
        },
        error: function() {
            Swal.fire({
                title: 'Ups...',
                text: 'Ha ocurrido un error al cargar los pedidos.',
                icon: 'error',
                confirmButtonText: 'Vale'
            })
        }
    });
}

// ELIMINAR UNA DIRECCIÓN
function eliminarDireccionHandler(e){
    e.preventDefault();

    let id_direccion = $(this).attr('direccion')
    let id_cliente = $(this).attr('id_client')
    let action = "eliminarDireccion"

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_direccion: id_direccion, id_cliente: id_cliente },

        success: function(response) {
            if (response == 'exito') {
                
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Dirección eliminada',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                })
                closeModal();
                setTimeout(function() {
                    window.location.reload();
                }, 500);

            } else{
                console.log(response);
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
        }
    });
}

// EDITAR UNA DIRECCIÓN
function editarDireccionHandler(e) {
    e.preventDefault();
    id_direccion = $(this).attr('id_dir');
    cliente = $(this).attr('cliente');

    obtenerDireccionPorId(id_direccion, function(direccion) {
        $('.bodyModal').css({
            'display': 'grid',
            'grid-template-columns': '1fr',
            'align-content': 'center',
            'grid-gap': '3em',
            'align-items': 'center',
            'justify-items': 'center'
        });
        showModal();
        $('.bodyModal').html(
            '<h3><i class="bi bi-pencil-fill"></i> Editar dirección</h3>' +
            '<form onsubmit="event.preventDefault();editarDireccion(' + cliente + ','+id_direccion+');" style="display: grid;grid-gap: 20%;justify-items: center;">' +
                '<input type="text" style="height: 100px;width: 190%;" id="direccion" value="' + direccion + '">' + // Aquí se añade el valor
                '<div style="display: flex;justify-content: center;gap: 5px;">' +
                    '<button type="submit" class="btn boton_formato" style="color:white;">Guardar cambios</button>' +
                    '<a class="btn btn-danger" onclick="closeModal()">Cerrar</a>' +
                '</div>' +
            '</form>'
        );
    });
}

// AÑADIR UNA DIRECCIÓN
function agregarDireccionHandler(e){
    e.preventDefault();
    id_cliente = $(this).attr('id_cliente');

    $('.bodyModal').css({
        'display': 'grid',
        'grid-template-columns': '1fr',
        'align-content': 'center',
        'grid-gap': '3em',
        'align-items': 'center',
        'justify-items': 'center',
        'height': '50%'
    });

    showModal();
    $('.bodyModal').html(
        '<div class="orientacion">'+
            '<h3><i class="bi bi-pencil-fill"></i> Añadir dirección</h3>'+
            '<form onsubmit="event.preventDefault();registrarDireccion('+id_cliente+');" style="display: grid;grid-gap: 20%;">'+
                '<input type="text" style="width: 100%;" id="avenida" placeholder="avenida" required>'+
                '<input type="text" style="width: 100%;" id="calle" placeholder="calle" required>'+
                '<input type="text" style="width: 100%;" id="vereda" placeholder="vereda" required>'+
                '<div style="display: flex;justify-content: center;gap: 5px;">'+
                    '<button type="submit" class="btn boton_formato" style="color:white;">Agregar</button>'+
                    '<a class="btn btn-danger" onclick="closeModal()">Cerrar</a>'+
                '</div>'+
            '</form>'+
        '</div>'
    );

    $('.orientacion').css({
        'position': 'relative',
        'bottom': '20%'
    });
}

// ELIMINAR UNA NOTIFICACION
function eliminarNotificacionHandler(e){
    e.preventDefault();
    id_noti = $(this).attr('id_noti');
    action = "borrarNotificacion";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,id_noti:id_noti},

        success: function(response){
            if (response === 'exito') {
                
                if (response === 'exito') {
                    
                    $('#noti_'+id_noti).remove();
                    
                }

            }else{
                console.log(response);
            }
        },

        error: function(error){
        }
    })
}

// MARCAR TODAS LAS NOTIFICACIONES COMO LEÍDAS
function marcarTodoLeidoHandler(e){
    e.preventDefault();
    action = "todoLeido";
    id_cliente = $(this).attr('cliente');

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,cliente:id_cliente},

        success: function(response){
            if (response === 'exito') {

                // Obtener el número actual de notificaciones
                let currentCount = parseInt($('#notificaciones').text().match(/\d+/)[0]);
                    
                $('#notificaciones').html(`<i class="bi bi-bell"></i> (0)`);
                $('#todo_leido').attr('disabled','disabled');
                $(".boton_noti").attr('disabled','disabled');
                
                console.log('Notificación marcada como leída. Cantidad actual: ' + (currentCount - 1));

            }else{
                console.log(response);
            }
        },

        error: function(error){
        }
    })
}

//MARCAR UNA NOTIFICACION COMO LEÍDA
function marcarUnLeidoHandler(e){
    e.preventDefault();
    var noti = $(this).attr('id_noti');
    action = "marcarLeida";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,id_noti:noti},

        success: function(response){
            if (response === 'exito') {
                
                if (response === 'exito') {
                    // Obtener el número actual de notificaciones
                    let currentCount = parseInt($('#notificaciones').text().match(/\d+/)[0]);
                    
                    // Actualizar el número de notificaciones
                    if (currentCount > 0) {
                        $('#notificaciones').html(`<i class="bi bi-bell"></i> (${currentCount - 1})`);
                    }

                    if (currentCount <= 0) {
                        $('#todo_leido').attr('disabled','disabled');
                    }

                    $(".noti_"+noti).attr('disabled','disabled');
                    
                    console.log('Notificación marcada como leída. Cantidad actual: ' + (currentCount - 1));
                }

            }else{
                console.log(response);
            }
        },

        error: function(error){
        }
    })
}

function borrar(){
    $('#foto').val('');
    $(".delPhoto").addClass('notBlock');
    $("#img").remove();
}

function cambiar(){
    var uploadFoto = document.getElementById("foto").value;
    var foto       = document.getElementById("foto").files;
    var nav = window.URL || window.webkitURL;
    var contactAlert = document.getElementById('form_alert');
    
        if(uploadFoto !=''){
            var type = foto[0].type;
            var name = foto[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
            {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                $("#img").remove();
                $(".delPhoto").addClass('notBlock');
                $('#foto').val('');
                return false;
            }else{  
                    contactAlert.innerHTML='';
                    $("#img").remove();
                    $(".delPhoto").removeClass('notBlock');
                    var objeto_url = nav.createObjectURL(this.files[0]);
                    $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                    $(".upimg label").remove();
                    
                }
        }else{
        	alert("No selecciono foto");
          $("#img").remove();
        }              
}

// MODAL DE FOTO DE PERFIL
function modalPerfilHandler(){
    var cliente = $(this).attr('cliente');
    showModal();
    $('.bodyModal').html(
        '<form action="" enctype="multipart/form-data" method="post" name="form_perfil" id="form_perfil" onsubmit="event.preventDefault(); cambioPerfil();">'+
        '<h3 class="modalTitle"><i class="bi bi-person"></i> Cambiar foto de perfil</h3>'+
        '<span class="text-secondary"> Seleccione la foto de perfil que desee asignar a su usuario</span>'+
        '<div class="photo">'+
            '<div class="prevPhoto">'+
                '<span class="delPhoto notBlock">X</span>'+
                '<label for="foto"></label>'+
            '</div>'+
            '<div class="upimg">'+
                '<input type="file" name="foto" id="foto">'+
            '</div>'+
            '<div id="form_alert"></div>'+
        '</div>'+
        '<input type="hidden" name="id_cliente" value="'+cliente+'" required>'+
        '<div class="alert alertFoto"></div>'+
        '<button type="submit" class="btn-primary" style="padding: 10px;border-radius: 5px;border: none;" id="cambio_perfil"><i class="fas fa-trash-alt"></i> Guardar</button>'+
        '<a href="#" class="btn-danger" style="margin-left:1em;padding: 10px; text-decoration:none;border-radius: 5px;border: none;" onclick="closeModal();">Cerrar</a>'+
        '</form>'
    );
}

// BORRAR FOTO DE PERFIL
function borrarPerfilHandler(){
    // Crear un objeto FormData para enviar los datos del formulario
    var action = "borrarFoto";
    var id_cliente = $(this).attr('cliente');

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,id_cliente:id_cliente},
        success: function(response){
            if (response == 'error') {
                Swal.fire({
                    title: '¡Oh no!',
                    text: 'Ha ocurrido un error al borrar la foto de perfil',
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                })
            }else{
                closeModal();
                location.reload();
            }
        },
        error: function(error){
        }
    })
}

// MODAL DE CAMBIO DE CÉDULA
function cambioCedulaHandler() {
    var cliente = $(this).attr('cliente');
    showModal();
    $('.bodyModal').html(
        '<form action="" method="post" name="form_cambio_cedula" id="form_cambio_cedula" onsubmit="event.preventDefault(); cambioCedula('+cliente+');">'+
        '<h3 class="modalTitle"><i class="fas fa-cubes"></i> Solicitud de cambio de cédula</h3>'+
        '<span class="text-secondary"> Escriba el nuevo número de cédula que desea asignar a su usuario</span>'+
        '<input type="number" name="cedula" required>'+
        '<div class="alert alertCedula"></div>'+
        '<button type="submit" id="solicitar_cambio"><i class="fas fa-trash-alt"></i> Solicitar</button>'+
        '<a href="#" onclick="closeModal();">Cerrar</a>'+
        '</form>'
    );
}

//MODAL INICIAR SESIÓN 
function iniciarSesionHandler(e) {
    e.preventDefault();
    showModal();
    $('.bodyModal').html(
        '<form action="" method="post" name="form_login" id="form_login" onsubmit="event.preventDefault(); login();">'+
        '<h3 class="modalTitle" style="text-align: center;"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</h3>'+
        '<div class="login d-grid">'+
        '<div class="input-container">'+
        '<input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" required>'+
        '<span class="required">*</span>'+
        '</div>'+
        '<div class="input-container">'+
        '<input type="password" name="clave" id="clave" placeholder="Contraseña" required>'+
        '<span class="required">*</span>'+
        '</div>'+
        '</div>'+
        '<div style="margin:10px;">'+
        '<span>¿No tienes una cuenta? <a href="registro.php" class="registro-link">Regístrate</a></span>'+
        '</div>'+
        '<div class="modalBotones">'+
        '<button type="submit" class="btn_login btn btn-primary"><i class="fas fa-trash-alt"></i> Iniciar Sesión</button>'+
        '<a href="#" class="btn btn-danger" onclick="closeModal();">Cerrar</a>'+
        '</div>'+
        '<br><br>'+
        '<p class="text-danger">CAMPOS OBLIGATORIOS (*)</p>'+
        '</form>'
    );
}

//MODAL DE PROCESAR PEDIDO
function procesarPedidoHandler(e){
    e.preventDefault();
    var id_usuario = $(this).attr('user_id')
    var action = "buscarDetalleCarrito"
    
    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,id_usuario:id_usuario},

        success: function(response){
            if (response == 'error') {
                $('.alertPedido').html('<p>Error</p>');
            } else {
                info = JSON.parse(response);
                showModal();
                // Crear un string para almacenar las filas de la tabla
                let rows = '';
                let totalGeneral = 0;

                // Iterar sobre el array para obtener cada id_producto
                info.forEach(function(item) {
                    const totalPorProducto = item.precio_venta * item.cantidad; // Calcula el total por producto
                    totalGeneral += totalPorProducto; // Suma al total general

                    rows += '<tr>'+
                                '<td>' + item.id_producto + '</td>'+
                                '<td>' + item.cantidad + '</td>'+
                                '<td>' + item.precio_venta + '</td>'+
                                '<td>' + totalPorProducto + '</td>'+  
                            '</tr>'; // Cada ID en su propia fila
                });

                $('.bodyModal').html(
                    '<form action="" method="post" name="form_pedidos" id="form_pedidos" onsubmit="event.preventDefault(); procesarPed('+id_usuario+');">' +
                    '<h3><i class="fas fa-cubes"></i> Procesar pedido</h3>' +
                    '<h5 class="text-secondary">¿Desea procesar el siguiente pedido?</h5>' +
                        '<div class="table-responsive">'+
                            '<table class="table table-info">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th>ID producto</th>' +
                                        '<th>Cantidad</th>' +
                                        '<th>Precio</th>' +
                                        '<th>Total</th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody>' + // Asegúrate de abrir el tbody aquí
                                    rows + // Inserta las filas aquí
                                '</tbody>' + // Cierra el tbody aquí
                                '</tfoot>' +
                                    '<tr>' +
                                        '<td colspan="3">Total</td>' +
                                        '<td>'+ totalGeneral +'</td>' +
                                    '</tr>' +
                                '</tfoot>' +
                            '</table>' +
                        '</div>'+
                        '<div class="d-flex" style="justify-content: center;gap: 10px;">'+
                            '<button id="btn_procesar_pedidos" class="btn btn-success" type="submit">Procesar</button>' +
                            '<a class="btn btn-danger" onclick="closeModal()">Cerrar</a>' +
                        '</div>'+
                    '</form>'
                );
            }
        },

        error: function(error){
        }
    })
}

// MODAL DE SOLICITUD DE DELIVERY
function modalDelivery(e) {
    e.preventDefault();
    let id_cliente = $(this).attr('id_cliente'); // Asumiendo que tienes el id_cliente en el botón

    obtenerDirecciones(id_cliente, function(direcciones) {
        showModal();
        let contenidoModal;

        $('.bodyModal').css({
            'display': 'grid',
            'height': '50%',
            'grid-template-columns': '1fr',
            'align-content': 'center',
            'grid-gap': '3em',
            'align-items': 'center',
            'padding': '1em',
            'justify-items': 'center'
        });

        if (direcciones.length > 0) {
            contenidoModal = `
                <h3>Direcciones registradas</h3>
                <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Dirección</th>
                            </tr>
                        </thead>
                    <tbody>
            `;
            
            // Inicializa el contador
            let i = 1;

            direcciones.forEach(function(direccion) {
                contenidoModal += `
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            ${i}
                        </td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            <button onclick="seleccionarDireccion(${direccion.id},${id_cliente})">${direccion.direccion}</button>
                        </td>
                    </tr>
                `; // Muestra cada dirección en una fila de la tabla
                i++; // Incrementa el contador
            });

            contenidoModal += `
                    </tbody>
                </table>

                <a href="#" onclick="closeModal();" class="btn btn-danger">Cerrar</a>
            `;
        } else {
            contenidoModal = `
                <h3>Aún no posee direcciones registradas.</h3>
                <a href="perfil.php">Agregar dirección</a>
            `; // Mensaje si no hay direcciones
        }

        $('.bodyModal').html(contenidoModal);
    });
}

//MODAL PARA REPORTAR EL PEDIDO COMO PAGADO
function reportarPedidoHandler(e){
    e.preventDefault();
        var id_pedido = $(this).attr('pedido');
        
        showModal();
        $('.bodyModal').html(
            '<div>'+
                '<h2>Subir Comprobante de Pago</h2>'+
                '<form id="formularioSubida" enctype="multipart/form-data" onsubmit="event.preventDefault(); subirComprobante();">'+
                    '<input type="file" name="comprobante" required>'+
                    '<input type="hidden" name="id_pedido" value="'+id_pedido+'" required>'+
                    '<button type="submit" class="btn btn-primary" id="confirmar_procesar">Confirmar</button>'+
                    '<a href="#" onclick="closeModal();" class="btn btn-danger">Cancelar</a>'+
                '</form>'+
            '</div>'
        )
}

// MODAL PARA CANCELAR PEDIDOS
function cancelarPedidoHandler(){
    var id_pedido = $(this).attr('pedido');

    showModal();
    $('.bodyModal').html(
        '<div>'+
            '<h2>Cancelar pedido</h2>'+
            '<h5>¿Está seguro de eliminar el pedido #'+id_pedido+'?</h5>'+
            '<form enctype="multipart/form-data" onsubmit="event.preventDefault(); cancelarPedido('+id_pedido+');">'+
                '<div class="alert alertPedido"></div>'+
                '<button type="submit" class="btn btn-primary" id="confirmar_procesar">Confirmar</button>'+
                '<a href="#" onclick="closeModal();" class="btn btn-danger">Cerrar</a>'+
            '</form>'+
        '</div>'
    )
}

// FIN MANEJADOR DE EVENTOS












// FUNCIONES

// GENERAR UN PDF PARA DESCARGAR UNA FACTURA
function generarPDF(cliente, factura){
    console.log(cliente, factura);

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width / 2) - (ancho / 2))
    var y = parseInt((window.screen.height / 2) - (alto / 2))

    $url = '../../sistema/factura/generaFactura.php?cl='+cliente+'&f='+factura;
    window.open($url,"Factura","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=si")

}

// SELECCIONAR LA DIRECCIÓN PARA UN DELIVERY
function seleccionarDireccion(id_direccion, id_cliente) {
    // Aquí puedes agregar lógica adicional si es necesario
    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        data: {
            action: 'procesarDireccion',
            id_direccion: id_direccion, // Envía el ID de la dirección seleccionada
            id_cliente: id_cliente
        },
        success: function(response) {
            if (response === 'success') {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Dirección seleccionada con éxito',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                })
                closeModal(); // Cierra el modal después de seleccionar la dirección
                window.location.href = "pedidos.php";
            } else {
                alert(response);
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX', error);
            alert('Ocurrió un error. Intente nuevamente.');
        }
    });
}

// EDITAR LA DIRECCIÓN DE UN USUARIO
function editarDireccion(cliente,id_direccion){
    var direccion = $('input[id="direccion"]').val();
    var action = "editarDireccion";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, direccion: direccion, cliente: cliente, id_direccion: id_direccion },

        success: function(response) {
            if (response == 'exito') {
                
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Tu dirección ha sido actualizada',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                })
                closeModal();
                setTimeout(function() {
                    window.location.reload();
                }, 500);

            } else{
                console.log(response);
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
        }
    });
}

// OBTENER EL TEXTO DE UNA DIRECCIÓN ESPECÍFICA EN LA BD
function obtenerDireccionPorId(id_direccion, callback) {
    let action = "obtenerDireccion";
    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_direccion: id_direccion },
        success: function(response) {
            if (response != 'error') {
                callback(response); // Llama al callback con la respuesta
            } else {
                console.log('Error al obtener la dirección');
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
        }
    });
}

// REGISTRAR UNA DIRECCIÓN DE UN USUARIO
function registrarDireccion(id_cliente){
    avenida = $('input[id="avenida"]').val();
    calle = $('input[id="calle"]').val();
    vereda = $('input[id="vereda"]').val();

    var direccion = ""+avenida+", "+calle+", "+vereda+".";
    var action = "registrarDireccion";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, direccion: direccion, id_cliente: id_cliente },

        success: function(response) {
            if (response == 'exito') {
                
                closeModal();
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Dirección registrada con éxito',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                })
                setTimeout(function() {
                    window.location.reload();
                }, 500);

            } else{
                console.log(response);
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
        }
    });
}

// CAMBIO DE FOTO DE PERFIL
function cambioPerfil(id_usuario){
    // Crear un objeto FormData para enviar los datos del formulario
    var formData = new FormData($('#form_perfil')[0]);

    $.ajax({
        url: 'AJAX/perfil.php', // URL del archivo PHP
        type: 'POST', // Método de envío
        data: formData, // Datos a enviar
        contentType: false, // No establecer el tipo de contenido
        processData: false, // No procesar los datos
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log(response); // Puedes ver la respuesta en la consola
            // Cerrar el modal antes de recargar la página
            closeModal();
            // Recargar la página al recibir la respuesta
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Manejar errores
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            $('#form_alert').text('Error al subir la foto.'); // Mostrar un mensaje de error
        }
    });
}

// LO PROPIO
function cancelarPedido(id_pedido){
    var action = "cancelarPedido";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,id_pedido:id_pedido},

        success: function(response){
            if (response == 'error') {
                $('.alertPedido').html('<p>Error al cancelar el pedido</p>');
            }else{
                $('.alertPedido').html('<p>Pedido cancelado con éxito</p>');
                $('#confirmar_procesar').remove();
                location.reload();
            }
        },

        error: function(error){
        }
    })
}

// INICIAR SESIÓN (MODAL)
function login(){
   $('.alertLogin').html('');
   var user = $('#usuario').val();
   var clave = $('#clave').val();
   var action = "login";
   $.ajax({
       url: 'AJAX/ajax.php',
       type: 'POST',
       async: true,
       data: {action:action,user:user,clave:clave},
       success: function(response){
           if (response == 'error') {
               $('.alertLogin').html('<p>Error al iniciar sesión</p>');
           }else{
               $('.alertLogin').html('<p>Sesión iniciada exitosamente</p>');
               $('#form_login .btn_login').remove();
               closeModal();
               location.reload();
           }
       },
       error: function(error){
       }
   })
}

//AÑADIR PRODUCTOS AL CARRITO
function alertaBoton(e, id_producto) {
    e.preventDefault(); // Prevenir el envío del formulario

    // Seleccionar el campo de texto utilizando el identificador único
    var producto = $('#id_producto_' + id_producto).val();
    var cantidad = $('#cant_prod_' + id_producto).val();
    var action = "addProductDetalle";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, producto: producto, cantidad: cantidad },

        success: function(response) {
            if (response != 'error') {
                var info = JSON.parse(response); // Parsear la respuesta JSON
                console.log("Producto agregado al carrito");

                // Desactivar el botón "Agregar"
                //$('#boton_accion_' + id_producto).prop('disabled', true);
                
                // Actualizar cantidad en el botón del carrito o en la interfaz del carrito
                $('#carrito_compras').html('<i class="bi bi-cart"></i> (' + info.total_items + ')');
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Producto añadido al carrito',
                    icon: 'success',
                    confirmButtonText: 'Vale'
                })
            } else if(response == 'error'){
                Swal.fire({
                    title: '¡Oh no!',
                    text: 'Ha ocurrido un error al añadir el producto al carrito',
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                })
                console.log('Error al agregar el producto al carrito');
            }else if(response == 'stock'){
                Swal.fire({
                    title: '¡Oh no!',
                    text: 'El stock de este producto se encuentra agotado',
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                })
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
        }
    });
}

// SI HAY UN CARRITO CON PRODUCTOS, LO MUESTRA.
function searchForDetalle(id){
    var action = 'searchForDetalle';
    var user = id;

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,user:user},

        success: function(response){
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales);
            }else{
                console.log('no data');
            }
        },

        error: function(error){
        }
    })
}

// ACTUALIZAR CANTIDAD EN LA TABLA DEL DETALLE DEL CARRITO
function updateCantidad(id_producto) {
    var cantidad = $('#txt_cant_producto_' + id_producto).val();
    var action = "updateCantidad";
    var cant_actual = $('#carrito_compras').val();

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, producto: id_producto, cantidad: cantidad },

        success: function(response) {
            if (response != 'error') {
                var info = JSON.parse(response);

                // Actualizar el precio total en la tabla
                $('#txt_precio_total_'+id_producto).text(info.precio_total);

                // Actualizar el total del carrito si es necesario
                $('#sin_iva').text(info.sin_iva);
                $('#impuesto').text(info.impuesto);
                $('#total').text(info.total);
            } else {
                console.log('Error al actualizar la cantidad');
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
        }
    });
}

// CERRAR MODAL
function closeModal(){
    $('.Modal').fadeOut();
}

 // MOSTRAR MODAL
function showModal(){
    var flex = "display:flex;"

    $('.Modal').fadeIn();
    $('.Modal').attr('style',flex)
}

// ENVIAR DATOS DEL PEDIDO A AJAX
function procesarPed(id_usuario){
    var action = "procesarPedido"
    var user = id_usuario

    // Obtener el estado del checkbox "delivery"
    var delivery = $('input[name="delivery"]').is(':checked') ? 1 : 0;

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,user:user,delivery:delivery},

        success: function(response){
            if (response == 'error') {
                Swal.fire({
                    title: '¡Oh no!',
                    text: 'Ha ocurrido un error',
                    icon: 'error',
                    confirmButtonText: 'Está bien'
                })
            }else{
                location.reload();
            }
        },

        error: function(error){
        }
    })
}

// SUBIR COMPROBANTE DE PAGO Y ESTABLECER PEDIDO COMO PAGADO
function subirComprobante(){
    var formData = new FormData($('#formularioSubida')[0]);
    $.ajax({
        url: 'AJAX/subir_archivo.php', // Archivo PHP que procesará la carga
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            //alert(response); // Muestra la respuesta del servidor
            location.reload(); // Ocultar el modal
        },
        error: function() {
            Swal.fire({
                title: '¡Oh no!',
                text: 'Ha ocurrido un error al subir el archivo',
                icon: 'error',
                confirmButtonText: 'Está bien'
            })
        }
    });
}

function cambioCedula(cliente) {
    // Obtener el valor del campo "cedula" del formulario
    var cedula = $('input[name="cedula"]').val();

    // Realizar la solicitud AJAX para enviar el nuevo número de cédula
    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {
            action: 'cambiarCedula', // Asegúrate de que esta acción esté manejada en tu servidor
            cliente: cliente,
            cedula: cedula // Incluir el nuevo número de cédula
        },
        success: function(response) {
            if (response == 'error') {
                $('.alertLogin').html('<p>Error al cambiar la cédula</p>');
            } else {
                $('.alertCedula').html('<p>Solicitud procesada con éxito</p>');
                $('#solicitar_cambio').remove();
            }
        },
        error: function(error) {
            $('.alertLogin').html('<p>Error en la solicitud</p>');
        }
    });
}

function obtenerDirecciones(id_cliente, callback) {
    let action = "obtenerDirecciones"; // Acción para el AJAX
    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_cliente: id_cliente },
        success: function(response) {
            if (response != 'error') {
                callback(JSON.parse(response)); // Llama al callback con el array de direcciones
            } else {
                callback([]); // Si hay un error, pasamos un array vacío
            }
        },
        error: function(error) {
            console.log('Error en la petición AJAX');
            callback([]); // En caso de error, también pasamos un array vacío
        }
    });
}

// FUNCIONES
















// FUNCIONES DEL PERFIL DE USUARIO

function desbloquearBoton(){

    $('#txt_boton_perfil').fadeIn();
    
}

function actualizarPerfil(id_usuario){
    $('#alert_perfil').html('');
    var nombre = $('#perfil_nombre').val();
    var apellido = $('#perfil_apellido').val();
    var correo = $('#perfil_correo').val();
    var nacimiento = $('#perfil_nacimiento').val();
    var telefono = $('#perfil_telefono').val();

    var action = "actualizarPerfil";

    $.ajax({
        url: 'AJAX/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action, nombre:nombre, apellido:apellido, correo:correo, 
               nacimiento:nacimiento, telefono:telefono, id:id_usuario},

        success: function(response){
            if (response == 'error') {
                $('.alert_perfil').html('<span>Error al guardar los cambios</span>');
            }else{
                info = JSON.parse(response);
                $('.alert_perfil').html('<span>Cambios guardados exitosamente</span>').show();
                //$('.perfil_nombre_principal').html(info.nombre+" "+info.apellido);
                $('#perfil_nombre_principal').text(info.nombre + ' ' + info.apellido);
                $('#perfil_correo_principal').text(info.correo);
            }
        },

        error: function(jqXHR, textStatus, errorThrown){
            console.log("Error: " + textStatus + " - " + errorThrown);
        }
    })
}

// FUNCIONES DEL PERFIL DE USUARIO