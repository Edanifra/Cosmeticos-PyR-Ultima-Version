<?php
session_start();

if (empty($_GET)) {
    header("location: pedidos.php");
}else {
    if (empty($_GET['id_pedido']) || !is_numeric($_GET['id_pedido'])) {
        header("location: pedidos.php");
    }else {
        include_once "conexion.php";

        $id_pedido = $_GET['id_pedido'];
        $estado_pedido = '';

        $alert = "";

        $sql = mysqli_query($conn,"SELECT dp.codproducto, dp.precio_venta, dp.cantidad,
                                            p.nombre, p.descripcion
                                    FROM detalle_pedido dp
                                    INNER JOIN producto p
                                    ON p.id_producto = dp.codproducto
                                    WHERE nopedido = $id_pedido;");
        $result = mysqli_num_rows($sql);

        $info_pedido = mysqli_query($conn,"SELECT estado_pedido FROM pedido WHERE id_pedido = $id_pedido");
        $resultao = mysqli_fetch_assoc($info_pedido);

        $getDomiciliario = @mysqli_query($conn,"SELECT e.nombre, e.apellido, e.telefono
                                                            FROM detalle_pedido d
                                                            INNER JOIN empleado e
                                                            ON d.domiciliario = e.id_empleado
                                                            WHERE nopedido = $id_pedido
                                                            LIMIT 0,1");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "global/cabecera.php"; ?>
    <title>Ver Pedido</title>
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


    <h2 style="display: contents;">Pedido #<?php echo $id_pedido; ?></h2>

    <?php 
        $estatus = $resultao['estado_pedido'];
        if ($estatus == 1 || $estatus == 0) {
            $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_pendiente">Pendiente</span>';
        }else if($estatus == 3){
            $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_aprobado">Aprobado</span>';
        }else if($estatus == 2){
            $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_cancelado">Cancelado</span>';
        }else if ($estatus == 4) {
            $estado_pedido = '<span style="margin-left:1.5em;" class="pedido_pendiente">Pendiente</span><span style="margin-left:1em;" class="pedido_pendiente">Reportado como pagado</span>';
        }

        echo $estado_pedido;
    ?>
    
    <hr>

    <h3 class="text-secondary">Información</h3>

    <div class="table-responsive">
        <table class="table table-info table-bordered tbl_venta">
            <thead>
                <tr>
                    <th width="70px">Cod. Producto</th>
                    <th width="100px">Nombre</th>
                    <th width="200px">Descripcion</th>
                    <th width="70px">Cantidad</th>
                    <th  width="70px">Precio</th>
                    <th  width="70px">Precio Total</th>
                </tr>
            </thead>
            <?php

            $detalleTabla   = '';
            $sub_total      = 0;
            $iva            = 16;
            $total          = 0;
            $arrayData      = array();
            
            while ($data = mysqli_fetch_assoc($sql)) {

            $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
            $sub_total      = round($sub_total + $precioTotal, 2);
            $total          = $precioTotal;
            
            $total_producto = ($data['precio_venta'] * $data['cantidad']);

            ?>
            <tbody id="detalle_venta">
                <tr>
                    <td style="text-align: center;"><?php echo $data['codproducto']; ?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['descripcion']; ?></td>
                    <td style="text-align: center;"><?php echo $data['cantidad']; ?></td>
                    <td><?php echo $data['precio_venta']; ?></td>
                    <td><?php echo $total_producto ?></td>
                </tr>
            <?php } 
            
            $impuesto   = round($sub_total * ($iva / 100), 2);
            $tl_sniva   = round($sub_total - $impuesto, 2);
            $total      = round($tl_sniva + $impuesto, 2);
            ?>
            </tbody>
            <tfoot id="detalle_totales">
                <tr>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="5" style="font-weight:bold;">SUBTOTAL Bs.</td>
                    <td class="textright" id="sin_iva"><?php echo $tl_sniva; ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="textright" style="font-weight:bold;">IVA (<?php echo $iva; ?>%)</td>
                    <td class="textright" id="impuesto"><?php echo $impuesto; ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="textright" style="font-weight:bold;">TOTAL Bs.</td>
                    <td class="textright" id="total"><?php echo $total; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php

    // VERIFICAR SI EL PEDIDO TIENE UN DOMICILIO CARGADO
    $deliv = @mysqli_query($conn,"SELECT COUNT(*) as num_reg FROM 
                                                detalle_pedido WHERE nopedido = $id_pedido AND codproducto = 115005451");
    $num_reg = mysqli_fetch_assoc($deliv);
    
    if($num_reg['num_reg']){
    ?>
        <br>
        <h3 class="text-secondary"><i class="fa fa-car" aria-hidden="true"></i> Domiciliario asignado</h3>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead style="text-align:center; font-weight:900;">
                    <tr>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Teléfono</td>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <?php
                        $resultado_domi = mysqli_num_rows($getDomiciliario);
                        if($resultado_domi > 0){
                            while ($datos_domiciliario = mysqli_fetch_assoc($getDomiciliario)) {
                        ?>
                            <td><?php echo $datos_domiciliario['nombre']; ?></td>
                            <td><?php echo $datos_domiciliario['apellido']; ?></td>
                            <td><?php echo $datos_domiciliario['telefono']; ?></td>
                        <?php
                            }
                        }else{?>
                            <td colspan="3">Aún no hay un domiciliario asignado a este pedido.</td>
                        <?php 
                        }?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>

    <br>
    <h3 class="text-secondary">Acciones</h3>
    <div class="table-responsive">
        <table class="table table-primary">
            <tbody>
                <tr style="text-align: center;">
                    <?php
                    if ($resultao['estado_pedido'] == 1) {?>
                        <td><button class="btn btn-success" pedido="<?php echo $id_pedido; ?>" id="btn_reportar_pedido">Reportar como pagado</button></td>
                        <td><button class="btn btn-danger" pedido="<?php echo $id_pedido; ?>" id="btn_cancelar_pedido">Cancelar pedido</button></td>
                    <?php
                    }else {?>
                        <td><span>Acciones no disponibles para este pedido</span></td>
                    <?php
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>

    <br>
    <h3 class="text-secondary">Comprobante de pago</h3>
    <div class="table-responsive">
        <table class="table table-primary">
            <tbody>
                <tr style="text-align: center;">
                    <?php 
                        $query_foto = mysqli_query($conn,"SELECT comprobante FROM pedido WHERE id_pedido = $id_pedido");
                        $foto = mysqli_fetch_assoc($query_foto);

                        if (!empty($foto['comprobante'])) {
                    ?>
                        <td><img src="img/comprobantes/usuario-<?php echo $_SESSION['cliente']['id_usuario']; ?>/pedido-<?php echo $id_pedido; ?>/<?php echo $foto['comprobante']; ?>"></td>
                    <?php }else{?>
                        <td colspan="2"><span>No hay comprobante de pago cargado para este pedido</span></td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>