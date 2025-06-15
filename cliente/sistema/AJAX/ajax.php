<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../conexion.php"; // Incluye tu archivo de conexión

// Verificar la conexión a la base de datos después de incluir el archivo.
if (!isset($conn) || (is_object($conn) && $conn->connect_error)) {
    $error_message = 'Error crítico: Fallo en la conexión a la base de datos.';
    if (is_object($conn) && $conn->connect_error) {
        $error_message .= ' Error: ' . $conn->connect_error;
    } elseif (!isset($conn)) {
        $error_message .= ' La variable $conn no fue definida por conexion.php.';
    }
    echo json_encode(['error' => true, 'message' => $error_message]);
    exit;
} elseif (!is_object($conn) || !($conn instanceof mysqli)) {
     echo json_encode(['error' => true, 'message' => 'Error crítico: conexion.php no estableció un objeto de conexión mysqli válido en $conn.']);
    exit;
}

// --- FUNCIÓN AUXILIAR PARA GENERAR LA VISTA DEL CARRITO ---
function generarVistaCarritoHTML(&$conn_param, $token) {
    $arrayVista = array('detalle' => '', 'totales' => '', 'error' => false, 'message' => '');
    
    $query_str = "SELECT tmp.correlativo, tmp.cantidad, tmp.precio_venta, 
                         p.id_producto, p.descripcion, p.nombre
                  FROM detalle_carrito tmp
                  INNER JOIN producto p ON tmp.id_producto = p.id_producto
                  WHERE tmp.token_user = ?";
    
    $stmt = mysqli_prepare($conn_param, $query_str);
    if (!$stmt) {
        $arrayVista['error'] = true;
        $arrayVista['message'] = "Error al preparar la consulta del carrito: " . mysqli_error($conn_param);
        return $arrayVista;
    }
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);

    if (!$query_result) {
        $arrayVista['error'] = true;
        $arrayVista['message'] = "Error al obtener los resultados del carrito: " . mysqli_error($conn_param);
        mysqli_stmt_close($stmt);
        return $arrayVista;
    }

    $result_count = mysqli_num_rows($query_result);
    $detalleTabla  = '';
    $sub_total_calc = 0;
    $iva_porcentaje = 16; 

    if ($result_count > 0) {
        while ($data = mysqli_fetch_assoc($query_result)) {
            // Este tmp.precio_venta es de la tabla detalle_carrito
            $precio_venta_item_carrito = floatval($data['precio_venta']); 
            $cantidad_item     = intval($data['cantidad']);
            $precioTotalItem   = round($cantidad_item * $precio_venta_item_carrito, 2);
            $sub_total_calc    = round($sub_total_calc + $precioTotalItem, 2);

            $detalleTabla  .= '
            <tr>
                <td>'.htmlspecialchars($data['id_producto']).'</td>
                <td>'.htmlspecialchars($data['nombre']).'</td>
                <td>'.htmlspecialchars($data['descripcion']).'</td>
                <td class="text-center">
                    <input type="number"
                           id="txt_cant_producto_'.htmlspecialchars($data['correlativo']).'"
                           class="form-control form-control-sm text-center product-quantity"
                           value="'.$cantidad_item.'"
                           min="1"
                           data-correlativo="'.htmlspecialchars($data['correlativo']).'"
                           onchange="handleQuantityChange(this)"
                           oninput="validarCantidadInput(this)"
                           style="width: 70px; margin: auto;">
                </td>
                <td class="text-end">'.number_format($precio_venta_item_carrito, 2).'</td>
                <td class="text-end">'.number_format($precioTotalItem, 2).'</td>
                <td class="text-center">
                    <button class="btn btn-danger btn-sm" onclick="event.preventDefault(); delProduct(\''.htmlspecialchars($data['correlativo']).'\');"><i class="fas fa-trash-alt"></i> Borrar</button>
                </td>
            </tr>';
        }

        $impuesto_calc  = round($sub_total_calc * ($iva_porcentaje / 100), 2);
        $total_general_calc = round($sub_total_calc + $impuesto_calc, 2);

        $detalleTotales = '
        <tr><td colspan="7" class="py-1"></td></tr>
        <tr>
            <td colspan="5" class="text-end">SUBTOTAL Bs.</td>
            <td class="text-end">'.number_format($sub_total_calc, 2).'</td>
            <td><input type="hidden" id="subtotal_carrito_val" value="' . htmlspecialchars($sub_total_calc) . '"></td>
        </tr>
        <tr>
            <td colspan="5" class="text-end">IVA ('.$iva_porcentaje.'%) Bs.</td>
            <td class="text-end">'.number_format($impuesto_calc, 2).'</td>
            <td><input type="hidden" id="iva_carrito_val" value="' . htmlspecialchars($impuesto_calc) . '"></td>
        </tr>
        <tr>
            <td colspan="5" class="text-end"><strong>TOTAL Bs.</strong></td>
            <td class="text-end"><strong>'.number_format($total_general_calc, 2).'</strong></td>
            <td><input type="hidden" id="total_carrito_final_val" value="'.htmlspecialchars($total_general_calc).'"></td>
        </tr>';
        
        $arrayVista['detalle'] = $detalleTabla;
        $arrayVista['totales'] = $detalleTotales;
    }
    mysqli_stmt_close($stmt);
    return $arrayVista;
}

// --- MANEJO CENTRAL DE ACCIONES ---
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'searchForDetalle':
            if (empty($_POST['user'])) { echo json_encode(['error' => true, 'message' => 'Usuario no especificado.']); exit; }
            if (!isset($_SESSION['cliente']['id_usuario'])) { echo json_encode(['error' => true, 'message' => 'Sesión no iniciada.']); exit; }
            $token = md5($_SESSION['cliente']['id_usuario']);
            $vistaCarrito = generarVistaCarritoHTML($conn, $token);
            echo json_encode($vistaCarrito, JSON_UNESCAPED_UNICODE);
            break;

        case 'delProductCarrito':
            if (empty($_POST['id_detalle'])) { echo json_encode(['error' => true, 'message' => 'ID de detalle no especificado.']); exit; }
            if (!isset($_SESSION['cliente']['id_usuario'])) { echo json_encode(['error' => true, 'message' => 'Sesión no iniciada.']); exit; }
            $id_detalle_esc = mysqli_real_escape_string($conn, $_POST['id_detalle']); 
            $token_esc = md5($_SESSION['cliente']['id_usuario']);
            
            $stmt_call = mysqli_prepare($conn, "CALL del_detalle_carrito(?, ?)");
            if ($stmt_call) {
                mysqli_stmt_bind_param($stmt_call, "is", $id_detalle_esc, $token_esc);
                mysqli_stmt_execute($stmt_call);
                mysqli_stmt_close($stmt_call);
                while(mysqli_next_result($conn)){ if($res = mysqli_store_result($conn)) { mysqli_free_result($res); } }
                $vistaCarrito = generarVistaCarritoHTML($conn, $token_esc);
                echo json_encode($vistaCarrito, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['error' => true, 'message' => 'Error al preparar SP para eliminar: ' . mysqli_error($conn)]);
            }
            break;

        case 'updateCantidad':
            updateProductQuantity();
            break;

        case 'addProductDetalle':
            addProduct();
            break;

        case 'login':
            login();
            break;
        
        default:
            echo json_encode(['error' => true, 'message' => 'Acción no reconocida o no manejada: ' . htmlspecialchars($action)]);
            break;
    }
    exit; 
} else {
    echo json_encode(['error' => true, 'message' => 'No se especificó ninguna acción.']);
    exit;
}

// --- DEFINICIONES DE FUNCIONES ESPECÍFICAS DE ACCIÓN ---

function updateProductQuantity() {
    global $conn; 

    if (empty($_POST['id_detalle']) || !isset($_POST['cantidad'])) { echo json_encode(['error' => true, 'message' => 'Datos incompletos (update).']); exit; }
    if (!isset($_SESSION['cliente']['id_usuario'])) { echo json_encode(['error' => true, 'message' => 'Sesión no iniciada (update).']); exit; }

    $id_detalle     = mysqli_real_escape_string($conn, $_POST['id_detalle']);
    $cantidad_nueva = intval($_POST['cantidad']);
    $token          = md5($_SESSION['cliente']['id_usuario']);

    if ($cantidad_nueva < 1) { $cantidad_nueva = 1; }

    $stmt_update = mysqli_prepare($conn, "UPDATE detalle_carrito SET cantidad = ? WHERE correlativo = ? AND token_user = ?");
    if (!$stmt_update) { echo json_encode(['error' => true, 'message' => 'Error preparación (update): ' . mysqli_error($conn)]); exit; }
    mysqli_stmt_bind_param($stmt_update, "iis", $cantidad_nueva, $id_detalle, $token);
    $updated = mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);

    if ($updated) {
        $vistaCarrito = generarVistaCarritoHTML($conn, $token);
        echo json_encode($vistaCarrito, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['error' => true, 'message' => "Error al actualizar BD (update): " . mysqli_error($conn)]);
    }
    exit;
}

function addProduct() {
    global $conn; 

    if (empty($_POST['producto']) || !isset($_POST['cantidad'])) { echo json_encode(['error' => true, 'message' => 'Producto o cantidad no especificados (add).']); exit; }
    if (!isset($_SESSION['cliente']['id_usuario'])) { echo json_encode(['error' => true, 'message' => 'Usuario no autenticado (add).']); exit; }

    $codproducto_esc = mysqli_real_escape_string($conn, $_POST['producto']);
    $cantidad_a_anadir = intval($_POST['cantidad']);
    $token_esc = md5($_SESSION['cliente']['id_usuario']);

    if ($cantidad_a_anadir <= 0) { echo json_encode(['error' => true, 'message' => 'Cantidad debe ser > 0 (add).']); exit; }

    // 1. Verificar stock y obtener el PRECIO del producto de la tabla 'producto'
    $stmt_stock = mysqli_prepare($conn, "SELECT stock, precio FROM producto WHERE id_producto = ?"); // <-- CORRECCIÓN AQUÍ
    if (!$stmt_stock) { echo json_encode(['error' => true, 'message' => 'Error preparación stock (add): ' . mysqli_error($conn)]); exit; }
    mysqli_stmt_bind_param($stmt_stock, "s", $codproducto_esc);
    mysqli_stmt_execute($stmt_stock);
    $result_stock_query = mysqli_stmt_get_result($stmt_stock);
    $product_data = mysqli_fetch_assoc($result_stock_query);
    mysqli_stmt_close($stmt_stock);

    if (!$product_data) { echo json_encode(['error' => true, 'message' => 'Producto no encontrado (add).']); exit; }
    
    $stock_disponible = intval($product_data['stock']);
    // Usar la columna correcta 'precio' para obtener el valor del producto
    $precio_actual_del_producto = floatval($product_data['precio']); // <-- CORRECCIÓN AQUÍ

    // 2. Verificar si el producto ya está en el carrito para este token
    $stmt_check = mysqli_prepare($conn, "SELECT cantidad, correlativo FROM detalle_carrito WHERE id_producto = ? AND token_user = ?");
    if (!$stmt_check) { echo json_encode(['error' => true, 'message' => 'Error preparación check (add): ' . mysqli_error($conn)]); exit; }
    mysqli_stmt_bind_param($stmt_check, "ss", $codproducto_esc, $token_esc);
    mysqli_stmt_execute($stmt_check);
    $result_check_query = mysqli_stmt_get_result($stmt_check);
    $affected_rows_op = 0;

    if ($result_check_query && mysqli_num_rows($result_check_query) > 0) { // Producto ya en carrito
        $row = mysqli_fetch_assoc($result_check_query);
        $cantidad_existente = intval($row['cantidad']);
        $nueva_cantidad_total = $cantidad_existente + $cantidad_a_anadir;
        
        if ($stock_disponible < $nueva_cantidad_total) { // Verificar contra stock total necesario
             echo json_encode(['error' => true, 'message' => 'Stock insuficiente para la cantidad total solicitada (add). Quedan: '.$stock_disponible]);
             if(is_object($result_check_query)) mysqli_stmt_close($stmt_check); // Cerrar antes del exit
             exit;
        }
        $correlativo_existente = $row['correlativo'];
        $stmt_update_cart = mysqli_prepare($conn, "UPDATE detalle_carrito SET cantidad = ? WHERE correlativo = ?");
        if (!$stmt_update_cart) { echo json_encode(['error' => true, 'message' => 'Error preparación update cart (add): ' . mysqli_error($conn)]); exit; }
        mysqli_stmt_bind_param($stmt_update_cart, "ii", $nueva_cantidad_total, $correlativo_existente);
        mysqli_stmt_execute($stmt_update_cart);
        $affected_rows_op = mysqli_stmt_affected_rows($stmt_update_cart);
        mysqli_stmt_close($stmt_update_cart);
    } else { // Producto no está en carrito, insertar nuevo
        if ($stock_disponible < $cantidad_a_anadir) {
            echo json_encode(['error' => true, 'message' => 'Stock insuficiente para agregar (add). Quedan: '.$stock_disponible]);
            if(is_object($result_check_query)) mysqli_stmt_close($stmt_check);
            exit;
       }
        // La columna en detalle_carrito para el precio es 'precio_venta'
        $stmt_insert_cart = mysqli_prepare($conn, "INSERT INTO detalle_carrito (id_producto, cantidad, token_user, precio_venta) VALUES (?, ?, ?, ?)");
        if (!$stmt_insert_cart) { echo json_encode(['error' => true, 'message' => 'Error preparación insert cart (add): ' . mysqli_error($conn)]); exit; }
        mysqli_stmt_bind_param($stmt_insert_cart, "sisd", $codproducto_esc, $cantidad_a_anadir, $token_esc, $precio_actual_del_producto); // Usar el precio obtenido de la tabla producto
        mysqli_stmt_execute($stmt_insert_cart);
        $affected_rows_op = mysqli_stmt_affected_rows($stmt_insert_cart);
        mysqli_stmt_close($stmt_insert_cart);
    }
    if(is_object($result_check_query) && mysqli_stmt_num_rows($stmt_check)>0) mysqli_free_result($result_check_query); // Liberar resultado si no fue un objeto statement
    elseif(is_object($stmt_check)) mysqli_stmt_close($stmt_check);


    if ($affected_rows_op > 0) {
        $stmt_total_items = mysqli_prepare($conn, "SELECT SUM(cantidad) as total_items FROM detalle_carrito WHERE token_user = ?");
        if (!$stmt_total_items) { echo json_encode(['error' => true, 'message' => 'Error preparación total items (add): ' . mysqli_error($conn)]); exit; }
        mysqli_stmt_bind_param($stmt_total_items, "s", $token_esc);
        mysqli_stmt_execute($stmt_total_items);
        $result_total_items_query = mysqli_stmt_get_result($stmt_total_items);
        $total_items_data = mysqli_fetch_assoc($result_total_items_query);
        mysqli_stmt_close($stmt_total_items);
        echo json_encode(['success' => true, 'message' => 'Producto agregado/actualizado.', 'total_items' => ($total_items_data && isset($total_items_data['total_items'])) ? intval($total_items_data['total_items']) : 0]);
    } else {
        echo json_encode(['error' => true, 'message' => 'No se pudo agregar o actualizar el producto (add): ' . mysqli_error($conn)]);
    }
    exit; 
}

function login() {
    global $conn; 

    if (empty($_POST['user']) || empty($_POST['clave'])) { echo json_encode(['error' => true, 'message' => 'Usuario o clave vacíos (login).']); exit; }
    
    $user_esc = mysqli_real_escape_string($conn, $_POST['user']);
    $clave_recibida = $_POST['clave'];

    $stmt = mysqli_prepare($conn, "SELECT id_cliente, nombre, apellido, correo, usuario, clave /* ASUME QUE 'clave' ES LA HASHEADA EN BD */, foto FROM cliente WHERE usuario = ?");
    if(!$stmt) { echo json_encode(['error' => true, 'message' => 'Error preparación login: ' . mysqli_error($conn)]); exit; }
    mysqli_stmt_bind_param($stmt, "s", $user_esc);
    mysqli_stmt_execute($stmt);
    $sql_result = mysqli_stmt_get_result($stmt);

    if ($sql_result && mysqli_num_rows($sql_result) > 0) {
        $data = mysqli_fetch_assoc($sql_result);
        // ¡¡IMPORTANTE!! Debes usar password_verify si tus contraseñas están hasheadas
        // if (password_verify($clave_recibida, $data['clave'])) {
        if ($clave_recibida == $data['clave']) { // ESTO SOLO ES SEGURO SI $data['clave'] ES UN HASH Y $clave_recibida SE COMPARA CON password_verify
            $_SESSION['cliente']['activo'] = true;
            $_SESSION['cliente']['id_usuario'] = $data['id_cliente'];
            $_SESSION['cliente']['nombre'] = $data['nombre'];
            $_SESSION['cliente']['apellido'] = $data['apellido'];
            $_SESSION['cliente']['correo'] = $data['correo'];
            $_SESSION['cliente']['usuario'] = $data['usuario'];
            $_SESSION['cliente']['foto'] = $data['foto'];
            echo json_encode(['success' => true, 'message' => 'Login exitoso']);
        } else {
            echo json_encode(['error' => true, 'message' => 'Usuario o contraseña incorrectos (clave no coincide).']);
        }
    } else {
        echo json_encode(['error' => true, 'message' => 'Usuario o contraseña incorrectos (usuario no encontrado).']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

// Aquí irían el resto de tus funciones y acciones (actualizarPerfil, etc.)
// cada una usando `global $conn;` y terminando con `echo json_encode(...)` y `exit;`.

?>