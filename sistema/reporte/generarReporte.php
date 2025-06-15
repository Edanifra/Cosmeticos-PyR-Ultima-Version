<?php

	//print_r($_REQUEST);
	//exit;
	//echo base64_encode('2');
	//exit;

	session_start();
	include "../conexion.php";
	require_once '../pdf/vendor/autoload.php';
	use Dompdf\Dompdf;
	use Dompdf\Options;

	$options = new Options();
	$options->set('isRemoteEnabled', true);

	$dompdf = new Dompdf($options);

	if(empty($_REQUEST['fecha_inicio']) || empty($_REQUEST['fecha_fin']))
	{
		echo "No es posible generar la factura.";
		print_r($_REQUEST);
	}else{
		$fecha_inicio = $_REQUEST['fecha_inicio'];
		$fecha_fin = $_REQUEST['fecha_fin'];
		$user = $_SESSION['admin']['usuario'];

		$query_config   = mysqli_query($conn,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		if($result_config > 0){
			$configuracion = mysqli_fetch_assoc($query_config);
		}


		$query_prods = mysqli_query($conn,"SELECT 
                                        p.id_producto,
                                        p.nombre,
                                        p.descripcion,
										p.stock,
                                        SUM(df.cantidad) AS total_vendido
                                    FROM 
                                        producto p
                                    JOIN 
                                        detallefactura df ON p.id_producto = df.codproducto
                                    JOIN 
                                        factura f ON df.nofactura = f.nro_factura
                                    WHERE 
                                        f.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'
                                    GROUP BY 
                                        p.id_producto, p.nombre, p.descripcion
                                    ORDER BY 
                                        total_vendido DESC;");

		$result = mysqli_num_rows($query_prods);
		if($result > 0){

			ob_start();
		    include(dirname('__FILE__').'/reporte.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('reporte_ventas.pdf',array('Attachment'=>0));
			exit;
		}
	}

?>