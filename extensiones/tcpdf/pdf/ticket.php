<?php

require_once "../../../controller/ventasController.php";
require_once "../../../model/ventaModel.php";

require_once "../../../controller/clienteControlador.php";
require_once "../../../model/clienteModelo.php";

require_once "../../../controller/userController.php";
require_once "../../../model/userModel.php";

require_once "../../../controller/productController.php";
require_once "../../../model/productModel.php";


require_once "../../../controller/sucursalControlador.php";
require_once "../../../model/sucursalModelo.php";

require_once "../../../controller/detalleFacturaController.php";
require_once "../../../model/detalleFacturaModel.php";


class imprimirTicket{

public $codigo;

public function traerImpresionTicket(){

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




//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');




//  TICKETE DE COMPRA

$medidas = array(80, 120); // Medidas en milímetros (Ancho x Alto)

$pdf = new TCPDF('P', 'mm', $medidas, true, 'UTF-8', false);
$ancho_maximo = 80; // en mm
$tamano_fuente = 9; // tamaño de fuente inicial
$pdf->SetMargins(7, 0, 7);
$pdf->SetFont('helvetica', '', $tamano_fuente);
$pdf->SetAutoPageBreak(false); // Desactivar salto de página automático
$pdf->setPrintHeader(false);
$pdf->startPageGroup();
$pdf->SetTitle('Tikete de compra');

$pdf->AddPage();




$bloque1 = <<<EOF


<table>	
		<tr>
			<td style="background-color:white;">
        <h2>MOUSE LAMP</h2>
				<div style="font-size:8.5px; text-align:left; line-height:15px;">
					Codigo Factura: $valorFac
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

	
	<!---–<h2>MOUSE LAMP</h2>--->

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF



	<table style="font-size:10px; ">
	<tr>
		
      <h4>Informacion del cliente</h4>


      <br>

				Cedula : $respuestaCliente[cedula] 
       
	
        <br>

			Nombre : $respuestaCliente[nomCliente] $respuestaCliente[apellidos]

			<br>

			Correo : 
			$respuestaCliente[email] 
    <br>
		Fecha de venta: $fecha




			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">
			
				

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
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">V. Unitario</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

foreach($respuestaDetalle as $key => $venta1){
	$itemPro = "codigo";
	$valorPro = $venta1["idProducto"];	
	$respuestaPro = ControllerProduct::ctrShowProduct($itemPro, $valorPro);

	$bloque9 = <<<EOF
	
	
	<table style="font-size:10px; padding:5px 10px;">
			<tr>
			
				 <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				 $respuestaPro[nombre]
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

$factura = new imprimirTicket();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionTicket();
