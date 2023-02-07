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

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fechaFactura"],0,-8);
//$productos = json_decode($respuestaVenta["productos"], true);
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



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false); //para eliminar la linea superio del pdf por defecto y tambien ej hearder
$pdf->startPageGroup();
$pdf->SetTitle('Factura de compra');
$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF
<img style=" width: 45px; margin: 5px;margin-top: 2.5px " src="imagen/ratonAzul2.png">
<h2>MOUSE LAMP</h2>

	<table>
		
		<tr>
		   <img style=" width: 45px; margin: 5px;margin-top: 2.5px " src="view/img/empresa/LogoRaton2.png">
		   <img style=" width: 45px; margin: 5px;margin-top: 2.5px " src="imagen/ratonAzul2.png">



		   <td style="width:150px"><img src="images/logo-negro-bloque.png"></td>
			<td style="width:150px"><img src="imagen/ratonAzul2.png"></td>
			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
				<br>
				<img src="imagen/ratonAzul2.png"
				class="img-responsive" style="padding:0px 100px 0px 110px">

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
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

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
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
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre] $respuestaVendedor[apellidos]</td>
		</tr>
		
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px">Sucursal de venta: $respuestaSucursal[nombre] $respuestaSucursal[codigo]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');






/*------------------------------------ TABLA DE LOS PRODUCTOS COMPRADOS ---------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControllerProduct::ctrShowProduct($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------*/

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
				$ $subTotal
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>


		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Descuento:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $descuento
			</td>

		</tr>


		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
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