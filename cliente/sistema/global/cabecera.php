<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap-grid.css">
<link rel="stylesheet" href="css/bootstrap-grid.css.map">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-reboot.css.map">
<link rel="stylesheet" href="css/bootstrap-reboot.css">
<link rel="stylesheet" href="css/bootstrap-grid.rtl.min.css">
<link rel="stylesheet" href="css/bootstrap-grid.rtl.min.css">
<link rel="stylesheet" href="css/estilazo.css">
<link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
<?php 
session_start();
if (isset($_SESSION['cliente']) && isset($_SESSION['cliente']['activo']) && $_SESSION['cliente']['activo'] == true) {
?>
<script>
    $(document).ready(function() {
        var tiempoMaximoInactividad = 10 * 60 * 1000; // 10 minutos en milisegundos
        var tiempoModal = 5 * 60 * 1000; // 5 minutos en milisegundos
        var tiempoInactividad;
        function cerrarSesion() {
            window.location.href = 'logout.php'; // Cambia esto a tu página de cierre de sesión
            closeModal();
        }
        // Función para reiniciar el temporizador
        function reiniciarTemporizador() {
            clearTimeout(tiempoInactividad);
            closeModal(); // Ocultar el modal si estaba visible
            tiempoInactividad = setTimeout(cerrarSesion, tiempoMaximoInactividad); // Cerrar sesión después de 10 minutos
            setTimeout(showModal, tiempoModal); // Mostrar el modal después de 5 minutos
        }
        $('.bodyModal').css({
            'display': 'grid',
            'grid-template-columns': '1fr',
            'align-content': 'center',
            'grid-gap': '3em',
            'align-items': 'center',
            'justify-items': 'center',
            'height': '45%'
        });
        // Generar el HTML del modal
        $('.bodyModal').html(
            '<div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">'+
                '<h2>¿Estás ahí?</h2>'+
                '<p>¿Sigues activo? ¿Deseas seguir conectado?</p>'+
                '<div>'+
                    '<button id="btnSeguir" class="btn btn-success" style="margin:0.5em;">Sí, seguir conectado</button>'+
                    '<button id="btnCerrarSesion" class="btn btn-danger" style="margin:0.5em;">No, cerrar sesión</button>'+
                '</div>'+
            '</div>'
        );
        // Evento de clic en 'Sí, seguir logeado'
        $(document).on('click', '#btnSeguir', function() {
            closeModal(); // Ocultar el modal
            reiniciarTemporizador(); // Reiniciar el temporizador
            // Aquí puedes hacer una llamada AJAX para actualizar la sesión si es necesario
        });
        // Evento de clic en 'No, cerrar sesión'
        $(document).on('click', '#btnCerrarSesion', function() {
            // Redirigir a la página de cierre de sesión
            window.location.href = 'logout.php'; // Cambia esto a tu página de cierre de sesión
        });
        // Iniciar el temporizador
        reiniciarTemporizador();
    });
</script>
<?php
}
?>