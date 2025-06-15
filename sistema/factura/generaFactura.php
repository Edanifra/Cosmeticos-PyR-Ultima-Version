<?php

	//print_r($_REQUEST);
	//exit;
	//echo base64_encode('2');
	//exit;

	include "../conexion.php";
	require_once '../pdf/vendor/autoload.php';
	use Dompdf\Dompdf;
	use Dompdf\Options;

	$options = new Options();
	$options->set('isRemoteEnabled', true);
	
	$nombre_anulado = "anulado.png";
	$anuladoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombre_anulado));

	$dompdf = new Dompdf($options);

	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		echo "No es posible generar la factura.";
		print_r($_REQUEST);
	}else{
		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];
		$anulada = '';

		$query_config   = mysqli_query($conn,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		if($result_config > 0){
			$configuracion = mysqli_fetch_assoc($query_config);
		}


		$query = mysqli_query($conn,"SELECT f.nro_factura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, 
														DATE_FORMAT(f.fecha,'%H:%i:%s') as  hora, 
														f.cliente, f.estado,
												 v.nombre as vendedor,
												 cl.cedula, cl.nombre, cl.telefono, dir.direccion
												FROM factura f
												INNER JOIN empleado v
												ON f.empleado = v.id_empleado
												INNER JOIN cliente cl
												ON f.cliente = cl.id_cliente
												INNER JOIN direccion dir
												ON f.cliente = dir.id_cliente
												WHERE f.nro_factura = $noFactura AND f.cliente = $codCliente  AND f.estado != 10 ");

		$result = mysqli_num_rows($query);
		if($result > 0){

			$factura = mysqli_fetch_assoc($query);
			$no_factura = $factura['nro_factura'];

			if($factura['estado'] == 2){
				$anulada = '<img class="anulada" src="'. $anuladoBase64 .'" alt="Anulada">';
			}

			$query_productos = mysqli_query($conn,"SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.nro_factura = dt.nofactura
														INNER JOIN producto p
														ON dt.codproducto = p.id_producto
														WHERE f.nro_factura = $no_factura ");
			$result_detalle = mysqli_num_rows($query_productos);

			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura_'.$noFactura.'.pdf',array('Attachment'=>0));
			exit;
		}
	}

?>