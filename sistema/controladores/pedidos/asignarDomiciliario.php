<?php 

if (!empty($_POST)) {
    if (!empty($_POST['id_empleado']) && !empty($_POST['id_pedido']) && !empty($_POST['id_cliente'])) {
        if (is_numeric($_POST['id_empleado']) && is_numeric($_POST['id_pedido']) && is_numeric($_POST['id_cliente'])) {
            
            include "../../conexion.php";
            include "../../php/funciones/CRUDS.php";
            session_start();
            
            $id_empleado = $_POST['id_empleado'];
            $id_pedido = $_POST['id_pedido'];
            $id_cliente = $_POST['id_cliente'];

            $verificacion = @mysqli_query($conn,"SELECT * FROM empleado WHERE id_empleado = $id_empleado");
            $result = mysqli_num_rows($verificacion);

            // SI EL RESULTADO ES MAYOR QUE 0, SIGNIFICA QUE, EN EFECTO, EXISTE UN EMPLEADO CON ESE ID
            if ($result > 0) {
                
                $result_2 = mysqli_fetch_assoc($verificacion);

                // SOLAMENTE SE LLEVA A CABO LA INSERCIÓN SI, Y SOLO SI EL EMPLEADO TIENE ROL DE TIPO 3 (DOMICILIARIO)
                if ($result_2['rol'] == 3) {
                    
                    $query = @mysqli_query($conn,"UPDATE detalle_pedido SET domiciliario = $id_empleado WHERE nopedido = $id_pedido");

                    if ($query) {
                        header("location:../../vistas/pedidos/detalle_pedido.php?id_pedido=$id_pedido&id_cliente=$id_cliente");
                    }else {
                        header("location:../../vistas/dashboard/index.php");
                    }

                }else {
                    header("location:../../vistas/dashboard/index.php");
                }

            }else {
                header("location:../../vistas/dashboard/index.php");
            }

        }else {
            header("location:../../vistas/dashboard/index.php");
        }
    }else {
        header("location:../../vistas/dashboard/index.php");
    }
}else {
    header("location:../../vistas/dashboard/index.php");
}

?>