<?php

require_once "../../../controller/ventasController.php";
require_once "../../../model/ventaModel.php";

require_once "../../../controller/clientController.php";
require_once "../../../model/clientModel.php";

require_once "../../../controller/userController.php";
require_once "../../../model/userModel.php";

require_once "../../../controller/productController.php";
require_once "../../../model/productModel.php";


require_once "../../../controller/sucursalController.php";
require_once "../../../model/sucursalModel.php";

require_once "../../../controller/detalleFacturaController.php";
require_once "../../../model/detalleFacturaModel.php";


class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);



$fecha = substr($respuestaVenta["fechaFactura"],0,-8);
$subTotal = number_format($respuestaVenta["subTotal"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$descuento = number_format($respuestaVenta["descuento"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "cedula";
$valorCliente = $respuestaVenta["idCliente"];

$respuestaCliente = ControllerClient::ctrShowClient($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "cedula";
$valorVendedor = $respuestaVenta["idEmpleado"];

$respuestaVendedor = ControllerUser::ctrShowUser($itemVendedor, $valorVendedor);



//TRAEMOS LA INFORMACIÓN DE LA TIENDA DONDE SE VEDIO

$itemSucursal = "codigo";
$valorSucursal = $respuestaVenta["idSucursal"];

$respuestaSucursal =  ControllerSucursal::ctrShowSucursal($itemSucursal, $valorSucursal);




///////////////////////////////////////////////////////////


//TRAEMOS LA INFORMACIÓN DEL DETALLE FACTURA
$itemFac = "idFactura";
$valorFac = $this->codigo;//codigo es el id de la factura

$respuestaDetalle = ControllerDetalle::ctrShowDetalleFactura($itemFac, $valorFac);

//$productos = json_decode($respuestaDetalle, true);




/*

$itemDetalle = "codigoDetalle";
$valorDetalle = $respuestaDetalle["codigoDetalle"];
$respuestaDetalle =  ControllerDetalle::ctrShowDetalleFactura($itemDetalle, $valorDetalle);

$productos = json_decode($respuestaDetalle["idFactura"], true);
*/

///////////////////////////////////////////////////////////
//TRAEMOS LA INFORMACIÓN DE LOS PRODUCTOS


/*
$itemProduc = "codigo";
$valorProduc = $respuestaDetalle[idProducto];
$respuestaProduc=  ControllerProduct::ctrShowProduct($itemProduc, $valorProduc);
*/


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


//  TICKETE DE COMPRA

//$medidas = array(100, 600); // Ajustar aqui segun los milimetros necesarios;
//$pdf = new TCPDF('P', 'mm', $medidas, true, 'UTF-8', false);

$pdf->setPrintHeader(false); //para eliminar la linea superio del pdf por defecto y tambien ej hearder
$pdf->startPageGroup();
$pdf->SetTitle('Factura de compra');
$pdf->AddPage();
$pdf->Image('images/Logo2.jpg');
//$pdf->Image('images/Logo2.jpg', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
// ---------------------------------------------------------



$bloque1 = <<<EOF


<table>
		
		<tr>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
				<br>
					codigo factura: $respuestaDetalle[idFactura]
					<br>
					
					Vendedor: $respuestaVendedor[nombre] $respuestaVendedor[apellidos]
					<br>
					Sucursal de venta: $respuestaSucursal[nombre]

				<br>
					Dirección: Sardinal centro

					<br>
					Teléfono: (+506) 8717-0007 - (+506) 8690-3811
					
					<br>
					info@mouselamp.com
				

				</div>
				
			</td>
		
			</tr>

	</table>

	<br>
	<br>
	
	<!---–<h2>MOUSE LAMP</h2>--->

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF



	<table style="font-size:10px; padding:5px 10px;">
	<br>
	<br>
	<br>
	
	
	<tr>
		



			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cedula cliente: $respuestaCliente[cedula] 

			</td>	
			
			<td style="border: 1px solid #666; background-color:white; width:390px">

			Nombre cliente: $respuestaCliente[nomCliente] $respuestaCliente[apellidos]

		</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha de venta: $fecha

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF
<br>
	<table style="font-size:10px; padding:5px 10px;">

		<tr>	
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unitario.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');















foreach($respuestaDetalle as $key => $venta1){
$bloque9 = <<<EOF


<table style="font-size:10px; padding:5px 10px;">
		<tr>


		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
			 $venta1[idProducto]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
			$venta1[cantidad]
		   </td>
		   <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
			 $venta1[precUnit]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
			$venta1[subTotal]
		   </td>
		</tr>

	</table>
 
EOF;
$pdf->writeHTML($bloque9, false, false, false, false, '');

}























$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				subTotal:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			¢ $subTotal
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			¢ $impuesto
			</td>

		</tr>


		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Descuento:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			¢ $descuento
			</td>

		</tr>


		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				¢ $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf', 'I');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>