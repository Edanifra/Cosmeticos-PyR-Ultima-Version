<?php
include_once "conexion.php";
include_once "global/funciones.php";
session_start();

$alert = "";
$id = $_SESSION['cliente']['id_usuario'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Pedidos</title>
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

    <h2 style="display: contents;">Pedidos</h2>
    <a href="facturas.php" class="btn btn-secondary">Facturas</a>
    <hr>

    <div style="display: flex; gap: 10px; justify-content: center;">
        <button class="btn btn-success" cliente="<?php echo $id; ?>" id="btn_retiros">Retiros en tienda física</button>
        <button class="btn btn-success" cliente="<?php echo $id; ?>" id="btn_domicilio">Pedidos a domicilio</button>
    </div><br>

    <div id="miDataTable" class="table-responsive">

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
</body>
</html>