<?php
session_start();

if (isset($_SESSION['cliente']['activo'])) {
    include_once "conexion.php";
    include_once "global/funciones.php";

    $alert = "";
    $id = $_SESSION['cliente']['id_usuario'];

    $sql = @mysqli_query($conn, "SELECT f.nro_factura, f.fecha, f.total_factura, f.cliente, f.estado,
                                     u.nombre as vendedor,
                                     cl.id_cliente, cl.nombre as cliente
                                     FROM factura f
                                     INNER JOIN empleado u ON f.empleado = u.id_empleado
                                     INNER JOIN cliente cl ON f.cliente = cl.id_cliente
                                     WHERE cl.id_cliente = $id
                                     ORDER BY f.fecha DESC");

}else {
    header("location:catalogo.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Facturas</title>
</head>
<body>

<?php require "global/header.php"; ?>

<br>
<br>

<div class="container">
    <br>

    <?php
        if($alert != '') {
    ?>

    <div class="alert alert-success">
        <a href="#" class="badge bg-secondary">Ver carrito</a>
    </div>

    <?php } ?>

    <h2 style="display: contents;">Facturas</h2>
    <a href="catalogo.php" class="btn btn-secondary">Catálogo de productos</a>
    <hr>

    <div id="miDataTable" class="table-responsive">
        <table id="tablaFacturas" class="display">
            <thead>
                <tr>
                    <th>Número de Factura</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($sql)): 
                    
                ?>
                    <tr>
                        <td><?php echo $row['nro_factura']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['total_factura']; ?></td>
                        <td><?php echo $row['cliente']; ?></td>
                        <td><?php echo $row['vendedor']; ?></td>
                        <td>
                            <button class="btn boton_formato view_factura" style="color:white;"
                            cl="<?php echo $id; ?>" f="<?php echo $row['nro_factura']; ?>">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/functions.js"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<script>
    $('#tablaFacturas').DataTable({
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
    $(document).ready(function() {
       if (!$.fn.DataTable.isDataTable('#tablaFacturas')) {
           $('#tablaFacturas').DataTable({
               "language": {
                   "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
               }
           });
       }
   });
</script>
</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conn);
?>