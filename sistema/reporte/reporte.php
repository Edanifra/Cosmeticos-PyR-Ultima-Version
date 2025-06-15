<?php
	$subtotal 	= 0;
	$iva 	 	= 0;
	$impuesto 	= 0;
	$tl_sniva   = 0;
	$total 		= 0;

	$nombreImagen = "logo.png";
	$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

	date_default_timezone_set("America/Caracas");

 //print_r($configuracion); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <style>
        /* Copia el contenido de estilos.css aquí */
        body {
            font-family: Arial, sans-serif;
        }
        /* Resto de tus estilos */
		@import url('fonts/BrixSansRegular.css');
		@import url('fonts/BrixSansBlack.css');

		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		.reporteWrapper{
			display:flex;
			align-items:center;
			justify-content:center;
			gap:4%;
		}
		.reporteWrapper div img{
			width: 280px;
			height: 280px;
		}
		p, label, span, table{
			font-family: 'BrixSansRegular';
			font-size: 9pt;
		}
		.h2{
			font-family: 'BrixSansBlack';
			font-size: 16pt;
		}
		.h3{
			font-family: 'BrixSansBlack';
			font-size: 12pt;
			display: block;
			background: #0a4661;
			color: #FFF;
			text-align: center;
			padding: 3px;
			margin-bottom: 5px;
		}
		#page_pdf{
			width: 95%;
			margin: 15px auto 10px auto;
		}

		#factura_head, #factura_cliente, #factura_detalle{
			width: 100%;
			margin-bottom: 10px;
		}
		.logo_factura{
			width: 25%;
		}
		.info_empresa{
			width: 50%;
			text-align: center;
		}
		.info_factura{
			width: 25%;
		}
		.info_cliente{
			width: 100%;
		}
		.datos_cliente{
			width: 100%;
		}
		.datos_cliente tr td{
			width: 50%;
		}
		.datos_cliente{
			padding: 10px 10px 0 10px;
		}
		.datos_cliente label{
			width: 75px;
			display: inline-block;
		}
		.datos_cliente p{
			display: inline-block;
		}

		.textright{
			text-align: right;
		}
		.textleft{
			text-align: left;
		}
		.textcenter{
			text-align: center;
		}
		.round{
			border-radius: 10px;
			border: 1px solid #0a4661;
			overflow: hidden;
			padding-bottom: 15px;
		}
		.round p{
			padding: 0 15px;
		}

		#factura_detalle{
			border-collapse: collapse;
		}
		#factura_detalle thead th{
			background: #058167;
			color: #FFF;
			padding: 5px;
		}
		#detalle_productos tr:nth-child(even) {
		    background: #ededed;
		}
		#detalle_totales span{
			font-family: 'BrixSansBlack';
		}
		.nota{
			font-size: 8pt;
		}
		.label_gracias{
			font-family: verdana;
			font-weight: bold;
			font-style: italic;
			text-align: center;
			margin-top: 20px;
		}
		.anulada{
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translateX(-50%) translateY(-50%);
		}
    </style>
</head>
<body>
<div id="page_pdf">
    <div class="reporteWrapper">
        <div>
            <img src="logo.png">
        </div>
        <td class="info_empresa">
            <div>
				<span class="h2"><?php echo strtoupper($configuracion['nombre']); ?></span>
				<p><?php echo $configuracion['direccion']; ?></p>
				<p>RIF: <?php echo $configuracion['rif']; ?></p>
				<p>Teléfono: <?php echo $configuracion['telefono']; ?></p>
				<p>Email: <?php echo $configuracion['email']; ?></p>
            </div>
        </td>
        <td class="info_factura">
            <div class="round">
                <span class="h3">Reporte</span>
                <p>Fecha: <?php echo date("d/m/y"); ?></p>
                <p>Hora: <?php echo date('h:i:s A'); ?></p>
                <p>Usuario: <?php echo $user;?></p>
            </div>
        </td>
    </div>
	<table id="datos_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Ventas</span>
					<table class="datos_cliente">
						<thead>
							<tr style="font-weight:bold;">
								<th><label>SKU</label></th>
								<th><label>Descripción</label></th>
								<th><label>Stock</label></th>
								<th><label>Unidades vendidas</label></th>
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_assoc($query_prods)){ ?>
								<tr>
									<td><p><?php echo $rows['id_producto']; ?></p></td>
									<td><p><?php echo $rows['nombre']; ?></p></td>
									<td><p><?php echo $rows['stock']; ?></p></td>
									<td><p><?php echo $rows['total_vendido']; ?></p></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>

</div>

</body>
</html>