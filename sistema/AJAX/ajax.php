<?php

// INFO PRODUCTO
if ($_POST['action'] == 'infoProducto') {
    
    require "../conexion.php";
    $id_producto = $_POST['producto'];

    $query = @mysqli_query($conn,"SELECT id_producto, descripcion, stock, precio
                            FROM producto WHERE id_producto = '$id_producto'");

    @mysqli_close($conn);

    $result = @mysqli_num_rows($query);
    if ($result > 0) {
        $data = @mysqli_fetch_assoc($query);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo "error";
    exit;
}

// INFO PRODUCTO 2, AHORA ES PERSONAL
if ($_POST['action'] == 'infoProducto2') {
    
    require "../conexion.php";
    $id_producto = $_POST['producto'];

    $query = @mysqli_query($conn,"SELECT *
                            FROM producto WHERE id_producto = '$id_producto'");

    @mysqli_close($conn);

    $result = @mysqli_num_rows($query);
    if ($result > 0) {
        $data = @mysqli_fetch_assoc($query);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo "error";
    exit;
}

// BUSCAR CLIENTE
if ($_POST['action'] == 'searchCliente' ) {
    if (!empty($_POST['cliente'])) {
        include "../conexion.php";

        $cedula = $_POST['cliente'];

        $query = @mysqli_query($conn,"SELECT * FROM cliente WHERE cedula LIKE '$cedula'");

        @mysqli_close($conn);
        $result = @mysqli_num_rows($query);

        $data = '';
        if ($result > 0) {
            $data = @mysqli_fetch_assoc($query);
        }else {
            $data = 0;
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// REGISTRAR CLIENTE - VENTAS
if ($_POST['action'] == 'addCliente' ) {
    require "../conexion.php";

    $cedula = $_POST['cedula_cliente'];
    $clave = $_POST['cedula_cliente'];
    
    $nombre = $_POST['nom_cliente'];
    $usuario = $_POST['nom_cliente'];

    $apellido = "si";
    $correo = "si";

    $telefono = $_POST['tel_cliente'];
    $direccion = $_POST['dir_cliente'];
    $id_cliente = $_POST['idCliente'];

    $query = @mysqli_query($conn,"INSERT INTO cliente 
                                (cedula,    usuario,    nombre,  apellido,  correo,     direccion,   telefono,      clave)
                        VALUES ('$cedula','$usuario','$nombre', '$apellido','$correo', '$direccion', '$telefono', '$clave')");

    if ($query) {
        $codCliente = @mysqli_insert_id($conn);
        $msg = $codCliente;
    }else {
        $msg = 'error';
    }

    @mysqli_close($conn);
    echo $msg;
    exit;
}

// AÑADIR PRODUCTO AL DETALLE
if ($_POST['action'] == 'addProductDetalle' ){
    
    if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
        echo 'error';
    }else {
        session_start();
        require "../conexion.php";

        $codproducto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $token = md5($_SESSION['admin']['id_empleado']);

        $query_iva = @mysqli_query($conn,"SELECT iva FROM configuracion");
        $result_iva = @mysqli_num_rows($query_iva);

        $query_detalle_temp = @mysqli_query($conn,"CALL add_detalle_temp($codproducto,$cantidad,'$token')");
        $result = @mysqli_num_rows($query_detalle_temp);

        $detalleTabla   = '';
        $sub_total      = 0;
        $iva            = 0;
        $total          = 0;
        $arrayData      = array();

        // SI ES MAYOR QUE 0, SIGNIFICA QUE VIENEN DATOS CARGADOS
        if ($result > 0) {
            if ($result_iva > 0) {
                $info_iva = @mysqli_fetch_assoc($query_iva);
                $iva = $info_iva['iva'];
            }

            // AQUÍ RECORREMOS LOS DATOS QUE VIENEN DEL PROCEDIMIENTO
            while ($data = mysqli_fetch_assoc($query_detalle_temp)) {                
                $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
                $sub_total      = round($sub_total + $precioTotal, 2);
                $total          = $precioTotal;

                $detalleTabla   .= '
                
                <tr>
                    <td>'.$data['cod_producto'].'</td>
                    <td colspan="2">'.$data['descripcion'].'</td>
                    <td class="textcenter">'.$data['cantidad'].'</td>
                    <td class="textright">'.$data['precio_venta'].'</td>
                    <td class="textright">'.$total.'</td>
                    <td class="">
                        <a href="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');">Borrar</a>
                    </td>
                </tr>';
            }

            $impuesto   = round($sub_total * ($iva / 100), 2);
            $tl_sniva   = round($sub_total - $impuesto, 2);
            $total      = round($tl_sniva + $impuesto, 2);

            $detalleTotales = '
            
            <tr>
                <td colspan="6" class="textright">SUBTOTAL Q.</td>
                <td class="textright">'.$tl_sniva.'</td>
            </tr>
            <tr>
                <td colspan="6" class="textright">IVA ('.$iva.'%)</td>
                <td class="textright">'.$impuesto.'</td>
            </tr>
            <tr>
                <td colspan="6" class="textright">TOTAL Q.</td>
                <td class="textright">'.$total.'</td>
            </tr>';

            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalleTotales;

            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        }else {
            echo 'error';
        }
        mysqli_close($conn);
    }

    exit;
}

// EXTRAER DATOS DEL DETALLE_TEMP
if ($_POST['action'] == 'searchForDetalle' ){
    session_start();
    require "../conexion.php";
    
    if (empty($_POST['user'])) {
        echo 'error';
    }else {

        $token = md5($_SESSION['admin']['id_empleado']);

        $query = mysqli_query($conn, "SELECT tmp.correlativo,
                                            tmp.token_empleado,
                                            tmp.cantidad,
                                            tmp.precio_venta,
                                            p.id_producto,
                                            p.descripcion
                                    FROM detalle_temp tmp
                                    INNER JOIN producto p
                                    ON tmp.cod_producto = p.id_producto
                                    WHERE token_empleado = '$token'");

        $result = @mysqli_num_rows($query);

        $query_iva = @mysqli_query($conn,"SELECT iva FROM configuracion");
        $result_iva = @mysqli_num_rows($query_iva);

        $detalleTabla   = '';
        $sub_total      = 0;
        $iva            = 0;
        $total          = 0;
        $arrayData      = array();

        // SI ES MAYOR QUE 0, SIGNIFICA QUE VIENEN DATOS CARGADOS
        if ($result > 0) {
            if ($result_iva > 0) {
                $info_iva = @mysqli_fetch_assoc($query_iva);
                $iva = $info_iva['iva'];
            }

            // AQUÍ RECORREMOS LOS DATOS QUE VIENEN DEL PROCEDIMIENTO
            while ($data = mysqli_fetch_assoc($query)) {                
                $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
                $sub_total      = round($sub_total + $precioTotal, 2);
                $total          = $precioTotal;

                $detalleTabla   .= '
                
                <tr>
                    <td>'.$data['id_producto'].'</td>
                    <td colspan="2">'.$data['descripcion'].'</td>
                    <td class="textcenter">'.$data['cantidad'].'</td>
                    <td class="textright">'.$data['precio_venta'].'</td>
                    <td class="textright">'.$total.'</td>
                    <td class="">
                        <a href="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');">Borrar</a>
                    </td>
                </tr>';
            }

            $impuesto   = round($sub_total * ($iva / 100), 2);
            $tl_sniva   = round($sub_total - $impuesto, 2);
            $total      = round($tl_sniva + $impuesto, 2);

            $detalleTotales = '
            
            <tr>
                <td colspan="5" class="textright">SUBTOTAL Q.</td>
                <td class="textright">'.$tl_sniva.'</td>
            </tr>
            <tr>
                <td colspan="5" class="textright">IVA ('.$iva.'%)</td>
                <td class="textright">'.$impuesto.'</td>
            </tr>
            <tr>
                <td colspan="5" class="textright">TOTAL Q.</td>
                <td class="textright">'.$total.'</td>
            </tr>';

            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalleTotales;

            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        }else {
            echo 'error';
        }
        mysqli_close($conn);
    }

    exit;
}

// BORRAR PRODUCTOS DEL DETALLE
if ($_POST['action'] == 'delProductoDetalle' ){

    session_start();
    require "../conexion.php";
    
    if (empty($_POST['id_detalle'])) {
        echo 'error';
        echo $_POST['id_detalle'];
    }else {

        $id_detalle = $_POST['id_detalle']; 
        $token = md5($_SESSION['admin']['id_empleado']);


        $query_iva = @mysqli_query($conn,"SELECT iva FROM configuracion");
        $result_iva = @mysqli_num_rows($query_iva);

        $query_detalle_temp = mysqli_query($conn,"CALL del_detalle_temp($id_detalle,'$token')");
        $result = mysqli_num_rows($query_detalle_temp);

        $detalleTabla   = '';
        $sub_total      = 0;
        $iva            = 0;
        $total          = 0;
        $arrayData      = array();

        // SI ES MAYOR QUE 0, SIGNIFICA QUE VIENEN DATOS CARGADOS
        if ($result > 0) {
            if ($result_iva > 0) {
                $info_iva = @mysqli_fetch_assoc($query_iva);
                $iva = $info_iva['iva'];
            }

            // AQUÍ RECORREMOS LOS DATOS QUE VIENEN DEL PROCEDIMIENTO
            while ($data = mysqli_fetch_assoc($query_detalle_temp)) {                
                $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
                $sub_total      = round($sub_total + $precioTotal, 2);
                $total          = $precioTotal;

                $detalleTabla   .= '
                
                <tr>
                    <td>'.$data['cod_producto'].'</td>
                    <td colspan="2">'.$data['descripcion'].'</td>
                    <td class="textcenter">'.$data['cantidad'].'</td>
                    <td class="textright">'.$data['precio_venta'].'</td>
                    <td class="textright">'.$total.'</td>
                    <td class="">
                        <a href="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle('.$data['correlativo'].');">Borrar</a>
                    </td>
                </tr>';
            }

            $impuesto   = round($sub_total * ($iva / 100), 2);
            $tl_sniva   = round($sub_total - $impuesto, 2);
            $total      = round($tl_sniva + $impuesto, 2);

            $detalleTotales = '
            
            <tr>
                <td colspan="5" class="textright">SUBTOTAL Q.</td>
                <td class="textright">'.$tl_sniva.'</td>
            </tr>
            <tr>
                <td colspan="5" class="textright">IVA ('.$iva.'%)</td>
                <td class="textright">'.$impuesto.'</td>
            </tr>
            <tr>
                <td colspan="5" class="textright">TOTAL Q.</td>
                <td class="textright">'.$total.'</td>
            </tr>';

            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalleTotales;

            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        }else {
            echo 'error';
        }
        mysqli_close($conn);
    }

    exit;

}

//  ANULAR VENTA
if ($_POST['action'] == 'anularVenta'){
    session_start();
    require "../conexion.php";

    $token = md5($_SESSION['admin']['id_empleado']);
    $query_del = mysqli_query($conn,"DELETE FROM detalle_temp 
                                    WHERE token_empleado = '$token'");
    mysqli_close($conn);
    if ($query_del) {
        echo 'ok';
    }else {
        echo 'error';
    }
    exit;
}

//  PROCESAR VENTA
if ($_POST['action'] == 'procesarVenta'){
    session_start();
    require "../conexion.php";
    include "../php/funciones/CRUDS.php";
    
    $codcliente = $_POST['codcliente'];
    $token = md5($_SESSION['admin']['id_empleado']);
    $empleado = $_SESSION['admin']['id_empleado'];

    $query = mysqli_query($conn,"SELECT * FROM detalle_temp WHERE token_empleado = '$token'");
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        $query_procesar = mysqli_query($conn, "CALL procesar_venta($empleado, $codcliente, '$token')");
        if ($query_procesar) {
            $result_detalle = mysqli_num_rows($query_procesar);

            if ($result_detalle > 0) {
                $data = mysqli_fetch_assoc($query_procesar);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);

                // Procesar todos los resultados del procedimiento almacenado
                while (mysqli_next_result($conn)) {
                    if ($result = mysqli_store_result($conn)) {
                        mysqli_free_result($result);
                    }
                }

                // Registrar en la bitácora
                if (registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha procesado una factura", "SALIDA", $conn)) {
                    echo json_encode(['status' => 'success', 'message' => 'Venta procesada y bitácora registrada']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Venta procesada pero no se pudo registrar en la bitácora']);
                }
            }
        }
    }

    mysqli_close($conn);
    exit;
}

// BORRAR PRODUCTO MODAL
if ($_POST['action'] == 'delProduct') {
    
    session_start();
    require "../conexion.php";
    require "../php/funciones/CRUDS.php";

    $id_producto = $_POST['id_producto'];

    if (!empty($id_producto)) {
        $query_delete = mysqli_query($conn,"UPDATE producto SET estado = 0 WHERE id_producto = $id_producto");

        if ($query_delete) {
            registrarBitacora($_SESSION['admin']['id_empleado'],$_SESSION['admin']['nombre'],"ha eliminado un producto","SALIDA",$conn);
            header("location: ../vistas/productos/listaProductos.php");
        }else {
            echo "error";
        }
    }else {
        echo "error";
    }
    exit;
}

// OBTENER INFORMACIÓN DE UNA FACTURA
if ($_POST['action'] == 'infoFactura') {
    if(!empty($_POST['nro_factura'])){

        session_start();
        require "../conexion.php";
        require "../php/funciones/CRUDS.php";

        $nro_factura = $_POST['nro_factura'];
        $query = mysqli_query($conn,"SELECT * FROM factura WHERE nro_factura = $nro_factura AND estado = 1");

        $result = mysqli_num_rows($query);
        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }

    }
    echo 'error';
    exit;
}

// ANULAR FACTURA
if ($_POST['action'] == 'anularFactura'){
    if (!empty($_POST['nro_factura'])) {
        session_start();
        require "../conexion.php";
        require "../php/funciones/CRUDS.php";

        $nro_factura = $_POST['nro_factura'];

        $query_anular = mysqli_query($conn,"CALL anular_factura($nro_factura)");
        $result = mysqli_num_rows($query_anular);

        if ($result > 0) {
            $data = mysqli_fetch_assoc($query_anular);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    echo "error";
    exit;
}

// CANCELAR UN PEDIDO
if ($_POST['action'] == 'cancelarPedido'){
    if (empty($_POST['id_pedido'])) {
        echo json_encode(['status' => 'error', 'message' => 'El ID está vacío']);
    }else {
        require "../conexion.php";

        $id_pedido = $_POST['id_pedido'];

        $sql = mysqli_query($conn,"UPDATE pedido SET estado_pedido = 2 WHERE id_pedido = $id_pedido");

        if ($sql) {
            echo json_encode(['status' => 'bien', 'message' => 'Pedido #$id_pedido cancelado']);
        }else {
            echo json_encode(['status' => 'error', 'message' => 'Error al cancelar el pedido']);
        }
    }
}

// LO CONTRARIO QUE EL DE ARRIBA PUES
if ($_POST['action'] == 'aprobarPedido'){
    if (empty($_POST['id_pedido']) || !is_numeric($_POST['id_pedido'])) {
        echo json_encode(['status' => 'error', 'message' => 'El ID tiene algún problema']);
    }else {
        session_start();
        require "../conexion.php";
        require "../php/funciones/CRUDS.php";
        
        $id_pedido = $_POST['id_pedido'];

        // HACEMOS LA CONSULTA A LA BD SOBRE EL PEDIDO
        $sql_pedido = mysqli_query($conn,"SELECT * FROM pedido WHERE id_pedido = $id_pedido");
        $result_pedido = mysqli_fetch_assoc($sql_pedido);

        // INICIALIZAMOS VARIABLES PARA EL PROCEDIMIENTO DE LA FACTURA
        $codcliente = $result_pedido['id_cliente'];
        $token = md5($_SESSION['admin']['id_empleado']);
        $empleado = $_SESSION['admin']['id_empleado'];

        // SELECCIONAMOS LOS PRODUCTOS (Y SUS CANTIDADES) EN EL DETALLE DEL PEDIDO EN CUESTIÓN
        $query = mysqli_query($conn,"SELECT * FROM detalle_pedido WHERE nopedido = $id_pedido");
        $result = mysqli_num_rows($query);

        // SI LA VARIABLE ES MAYOR QUE CERO, ES PORQUE HAY PRODUCTOS CARGADOS EN EL DETALLE
        if($result > 0){
            // PROCESAMOS LA FACTURA CON EL PROCEDIMIENTO ALMACENADO
            $query_procesar = mysqli_query($conn, "CALL procesar_venta_2($empleado, $codcliente, $id_pedido)");
            if ($query_procesar) {
                $result_detalle = mysqli_num_rows($query_procesar);

                if ($result_detalle > 0) {
                    $data = mysqli_fetch_assoc($query_procesar);
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);

                    // Procesar todos los resultados del procedimiento almacenado
                    while (mysqli_next_result($conn)) {
                        if ($result = mysqli_store_result($conn)) {
                            mysqli_free_result($result);
                        }
                    }

                    // Registrar en la bitácora
                    if (registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha aprobado el pedido #".$id_pedido."", "SALIDA", $conn)) {
                        echo json_encode(['status' => 'success', 'message' => 'Venta procesada y bitácora registrada']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Venta procesada pero no se pudo registrar en la bitácora']);
                    }
                }
            }
        }
    }
}

// APROBAR SOLICITUD DE CAMBIO DE CÉDULA
if ($_POST['action'] == 'aprobarSolicitud'){
    session_start();
    require "../conexion.php";
    require "../php/funciones/CRUDS.php";

    $id_soli = $_POST['id_solicitud'];
    $soli_cedula = $_POST['soli_cedula'];
    $info_cliente = mysqli_query($conn,"SELECT id_cliente FROM solicitud_cedula WHERE id_solicitud = $id_soli");
    $conversion = mysqli_fetch_assoc($info_cliente);
    $id_user = $conversion['id_cliente'];

    // ACTUALIZAR LA CÉDULA DEL CLIENTE A LA QUE PIDIÓ EN LA SOLICITUD
    $query = mysqli_query($conn,"UPDATE cliente SET cedula = '$soli_cedula' WHERE id_cliente = '$id_user'");

    //ACTUALIZAR EL ESTADO DE LA SOLICITUD A APROBADO
    $sql = mysqli_query($conn,"UPDATE solicitud_cedula SET estado = 1 WHERE id_solicitud = $id_soli");
    
    if ($sql && $query) {
        registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha aprobado la solicitud #".$id_soli."", "SALIDA", $conn);
        echo "Aprobado";
    }else {
        echo "No se pudo aprobar el beta";
    }
    exit;
}

// LO CONTRARIO QUE EL DE ARRIBA, OTRA VEZ PUES
if ($_POST['action'] == 'cancelarSolicitud'){
    session_start();
    require "../conexion.php";
    require "../php/funciones/CRUDS.php";

    $id_soli = $_POST['id_solicitud'];

    //ACTUALIZAR EL ESTADO DEL PEDIDO A CANCELADO
    $sql = mysqli_query($conn,"UPDATE solicitud_cedula SET estado = 2 WHERE id_solicitud = $id_soli");

    if ($sql) {
        registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha denegado la solicitud #".$id_soli."", "SALIDA", $conn);
        crearNotificacion($conn,"Se ha negado tu solicitud de cambio de cédula.",$id_user);
        echo "Aprobado papeh";
    }else {
        echo "No se pudo aprobar el beta";
    }
    exit;
}

// BUSCAR PRODUCTOS POR CATEGORÍA
if ($_POST['action'] == 'buscarCategoria'){
    if (!empty($_POST['id_categoria'])) {
        require "../conexion.php";
        
        $id_categoria = $_POST['id_categoria'];

        // Consulta para obtener los productos de la categoría seleccionada
        $query = "SELECT id_producto, nombre, descripcion, stock, precio FROM producto WHERE id_categoria = $id_categoria";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Generar la tabla
            echo '<form action="" id="form_ajuste_inv" method="POST" onsubmit="event.preventDefault();">'; // Cambia esto a tu archivo de envío
            echo '<table class="table table-bordered">';
            echo '<thead class="table_headers">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Descripción</th>';
            echo '<th>Ajuste</th>';
            echo '<th>Stock actual</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id_producto'] . '</td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['descripcion'] . '</td>';
                echo '<td><input type="number" name="stock[' . $row['id_producto'] . ']"></td>'; // Campo de entrada para stock
                echo '<td>' . $row['stock'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '<div style="display: flex;justify-content: center;">';
            echo '<input type="submit" id="ajuste_inv_btn" value="Ajustar" class="btn btn-primary" style="width: 30%;">';
            echo '</div>';
            echo '</form>';
        }

    }else {
        echo json_encode("id categoria vacio");
    }
}

// AJUSTAR STOCK
if ($_POST['action'] == 'ajustarStock') {
    session_start();
    require "../conexion.php";
    require "../php/funciones/CRUDS.php";

    parse_str($_POST['formData'], $data); // Parsear los datos del formulario

    // Recorrer cada producto para actualizar el stock
    foreach ($data['stock'] as $id_producto => $nuevo_stock) {
        // Aquí puedes realizar la lógica que necesites para ajustar el stock
        $sql = mysqli_query($conn,"SELECT stock FROM producto WHERE id_producto = $id_producto");
        $result = mysqli_fetch_assoc($sql);
        $stock_actual = intval($result['stock']); // Asegúrate de que sea un número entero
        $stock_insert = $stock_actual + intval($nuevo_stock); // Asegúrate de que nuevo_stock también sea un número

        $query = "UPDATE producto SET stock = $stock_insert WHERE id_producto = $id_producto";
        mysqli_query($conn, $query);

        if ($nuevo_stock > 0) {
            registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha hecho un ajuste en positivo (".$nuevo_stock.") del producto #".$id_producto, "AJUSTE", $conn);
        }else if ($nuevo_stock < 0){
            registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha hecho un ajuste en negativo (".$nuevo_stock.") del producto #".$id_producto, "AJUSTE", $conn);
        }
    }

    echo "Stock ajustado correctamente."; // Mensaje de éxito
}

// LANZAR DESCUENTO DE UN PRODUCTO
if ($_POST['action'] == 'insertarDescuento') {
    require '../conexion.php'; // Conectar a la base de datos
    require "../php/funciones/descuentos.php";
    require "../php/funciones/CRUDS.php";

    $id_producto = $_POST['id_producto'];
    $porcentaje_descuento = $_POST['porcentaje_descuento'];

    // Obtener el nombre del producto
    $nombre_producto = mysqli_query($conn, "SELECT nombre FROM producto WHERE id_producto = '$id_producto'");
    if (!$nombre_producto) {
        echo "Error al obtener el nombre del producto: " . mysqli_error($conn);
        exit;
    }
    $nom_prod = mysqli_fetch_assoc($nombre_producto);
    $producto = $nom_prod['nombre'];

    // Verificar si el producto ya tiene un descuento
    $sql = mysqli_query($conn, "SELECT * FROM descuentos WHERE id_producto = '$id_producto'");
    if (!$sql) {
        echo "Error al verificar descuentos: " . mysqli_error($conn);
        exit;
    }
    $result = mysqli_num_rows($sql);
    
    if ($result > 0) {
        echo "Producto ya incluído en los descuentos, no se puede añadir de nuevo";
    } else {
        // Obtener el precio anterior
        $obt_precio_viejo = mysqli_query($conn, "SELECT precio FROM producto WHERE id_producto = '$id_producto'");
        if (!$obt_precio_viejo) {
            echo "Error al obtener el precio: " . mysqli_error($conn);
            exit;
        }
        $p_viejo = mysqli_fetch_assoc($obt_precio_viejo);
        $precio_viejo = $p_viejo['precio'];

        // Calcular el nuevo precio
        $p_n = ($precio_viejo * $porcentaje_descuento) / 100;
        $precio_nuevo = $precio_viejo - $p_n;

        // Actualizar el precio del producto
        $query_precio = "UPDATE producto SET precio = '$precio_nuevo' WHERE id_producto = '$id_producto'";
        if (!mysqli_query($conn, $query_precio)) {
            echo "Error al actualizar el precio: " . mysqli_error($conn);
            exit;
        }

        // Insertar el descuento
        $query = "INSERT INTO descuentos (id_producto, porcentaje_descuento, precio_anterior) VALUES ('$id_producto', '$porcentaje_descuento', '$precio_viejo')";
        if (mysqli_query($conn, $query)) {
            $descripcion = "Se ha agregado un " . $porcentaje_descuento . "% de descuento al producto '" . $producto . "'";
            crearNotificacionGeneral($conn, $descripcion);
            echo "Descuento añadido satisfactoriamente";   
        } else {
            echo "Error al insertar descuento: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn); // Cerrar la conexión
    exit;
}

// LO CONTRARIO DEL DE ARRIBA POES.
if ($_POST['action'] == 'borrarDescuento'){
    if (!empty($_POST['id_producto'])) {
        if (is_numeric($_POST['id_producto'])) {
            session_start();
            require "../conexion.php";
            require "../php/funciones/CRUDS.php";

            $id_producto = $_POST['id_producto'];

            //SQL PARA OBTENER EL PRECIO ORIGINAL DEL PRODUCTO
            $orig = mysqli_query($conn,"SELECT precio_anterior FROM descuentos WHERE id_producto = '$id_producto'");
            $resultado = mysqli_fetch_assoc($orig);
            $precio_viejo = $resultado['precio_anterior'];

            // SQL PARA ACTUALIZAR EL PRECIO DEL PRODUCTO AL ANTERIOR
            mysqli_query($conn,"UPDATE producto SET precio = '$precio_viejo' WHERE id_producto = '$id_producto'");

            // SQL PARA ELIMINAR, AHORA SÍ, EL DESCUENTO DE SU RESPECTIVA TABLA
            $sql = mysqli_query($conn,"DELETE FROM descuentos WHERE id_producto = '$id_producto'");

            if ($sql) {
                echo "Descuento eliminado satisfactoriamente.";
                registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha eliminado el descuento del producto #".$id_producto, "SALIDA", $conn);
            }else {
                echo "Ocurrió algún error al eliminar el descuento.";
            }

        }else {
            echo "El ID debe ser un valor numérico, sé bien lo que intentas hacer...";
        }
    }else {
        echo "La ID del producto está vacía.";
    }
}

// ELIMINAR UN USUARIO
if ($_POST['action'] == 'eliminarUsuario') {

    if (!empty($_POST['id_usuario'])) {
        if (is_numeric($_POST['id_usuario'])) {
            session_start();
            require "../conexion.php";
            require "../php/funciones/CRUDS.php";
            $id_usuario = $_POST['id_usuario'];

            // Consulta a la base de datos
            $sql = @mysqli_query($conn, "SELECT * FROM empleado WHERE id_empleado = $id_usuario");
            $result = mysqli_num_rows($sql);

            // Verificación de la existencia del usuario
            if ($result > 0) {
                
                $sql_usuario = @mysqli_query($conn,"UPDATE empleado SET estado = 0 WHERE id_empleado = $id_usuario");

                if ($sql_usuario) {
                    registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha eliminado al usuario #".$id_usuario, "SALIDA", $conn);
                    echo "Usuario eliminado correctamente.";
                }else {
                    echo "Ha ocurrido un error al eliminar el usuario.";
                }

            } else {
                echo "ID de usuario inexistente."; // Mensaje de error
                exit(); // Detiene la ejecución aquí
            }
        } else {
            echo "El ID del usuario debe ser un valor numérico."; // Mensaje de error
            exit(); // Detiene la ejecución aquí
        }
    } else {
        echo "El ID del usuario no puede estar vacío."; // Mensaje de error
        exit(); // Detiene la ejecución aquí
    }
}

// RESTABLECER UN USUARIO
if ($_POST['action'] == 'restablecerUsuario') {

    if (!empty($_POST['id_usuario'])) {
        if (is_numeric($_POST['id_usuario'])) {
            session_start();
            require "../conexion.php";
            require "../php/funciones/CRUDS.php";
            $id_usuario = $_POST['id_usuario'];

            // Consulta a la base de datos
            $sql = @mysqli_query($conn, "SELECT * FROM empleado WHERE id_empleado = $id_usuario");
            $result = mysqli_num_rows($sql);

            // Verificación de la existencia del usuario
            if ($result > 0) {
                
                $sql_usuario = @mysqli_query($conn,"UPDATE empleado SET estado = 1 WHERE id_empleado = $id_usuario");

                if ($sql_usuario) {
                    registrarBitacora($_SESSION['admin']['id_empleado'], $_SESSION['admin']['nombre'], "ha restablecido al usuario #".$id_usuario, "SALIDA", $conn);
                    echo "Usuario restablecido correctamente.";
                }else {
                    echo "Ha ocurrido un error al restablecer el usuario.";
                }

            } else {
                echo "ID de usuario inexistente."; // Mensaje de error
                exit(); // Detiene la ejecución aquí
            }
        } else {
            echo "El ID del usuario debe ser un valor numérico."; // Mensaje de error
            exit(); // Detiene la ejecución aquí
        }
    } else {
        echo "El ID del usuario no puede estar vacío."; // Mensaje de error
        exit(); // Detiene la ejecución aquí
    }
}

// ACTUALIZAR CONFIG GENERAL
if ($_POST['action'] == 'actualizarConfigGeneral'){
    session_start();
    include "../conexion.php";
    include "../php/funciones/CRUDS.php";

    $nombre = $_POST['nombre'];
    $rif = $_POST['rif'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $query = @mysqli_query($conn,"UPDATE configuracion SET nombre='$nombre',rif='$rif',email='$correo',telefono='$telefono',direccion='$direccion'");

    if ($query) {
        echo "exito";
    }else {
        echo "Ocurrió un problema al actualizar los datos";
    }
}

// ACTUALIZAR CONFIG ADMIN
if ($_POST['action'] == 'actualizarConfigAdmin') {
    session_start();
    include "../conexion.php";
    include "../php/funciones/CRUDS.php";

    $principal = $_POST['principal'];
    $secundario = $_POST['secundario'];
    $complementario = $_POST['complementario'];
    $lateral = $_POST['lateral'];

    $query = @mysqli_query($conn,
    "UPDATE configuracion SET color_principal='$principal',
                                     color_secundario='$secundario',
                                     color_complementario='$complementario',
                                     fuente_b_lateral='$lateral'");

    if ($query) {
        echo "exito";
    }else {
        echo "Ocurrió un problema al actualizar los datos";
    }
}

// ACTUALIZAR CONFIG TIENDA
if ($_POST['action'] == 'actualizarConfigTienda') {
    session_start();
    include "../conexion.php";
    include "../php/funciones/CRUDS.php";

    $landing_1 = $_POST['landing_1'];
    $landing_2 = $_POST['landing_2'];
    $landing_3 = $_POST['landing_3'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $whatsapp = $_POST['whatsapp'];

    $query = @mysqli_query($conn,"UPDATE tienda SET txt_landing_1='$landing_1',txt_landing_2='$landing_2',txt_landing_3='$landing_3',
                                                instagram='$instagram', facebook='$facebook', whatsapp='$whatsapp'");

    if ($query) {
        echo "exito";
    }else {
        echo "Ocurrió un problema al actualizar los datos";
    }
}
?>