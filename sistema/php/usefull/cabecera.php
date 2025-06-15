<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

<!-- Bootstrap core CSS -->
<link href="../../assets/css/bootstrap.css" rel="stylesheet">

<!--external css-->
<link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../../assets/css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="../../assets/js/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="../../assets/lineicons/style.css">    
<link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/estilazo.css">
<link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="../../assets/css/style.css" rel="stylesheet">
<link href="../../assets/css/style-responsive.css" rel="stylesheet">

<!-- Scripts -->
<script src="../../assets/js/chart-master/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/helpers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/helpers.min.js"></script>
<script src="../../assets/js/chart-master/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/d369b98639.js" crossorigin="anonymous"></script>
<script src="../../js/functions.js"></script>
<script src="../../js/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php 

if ($_SESSION['admin']['activo'] == true){

?>

<script>
    $(document).ready(function() {
        var tiempoMaximoInactividad = 110 * 60 * 1000; // 10 minutos en milisegundos
        var tiempoModal = 55 * 60 * 1000; // 5 minutos en milisegundos
        var tiempoInactividad;

        function cerrarSesion() {
            window.location.href = '../../salir.php'; // Cambia esto a tu página de cierre de sesión
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
            'height': '30%',
            'width': '35%'
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