<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "factura";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){
			
			if(!empty($_POST["listaProductos"])){
				$array = json_decode($_POST['listaProductos'],true);
				$table = "factura";
				date_default_timezone_set("America/Costa_Rica");	
				$fecha = date('Y-m-d H:i:s');

					$datas = array(

						"idEmpleado" => $_POST["idEmpleado"],
						"idSucursal" => $_POST["idSucursal"],
						"idCliente"=>$_POST["idCliente"],
						"subTotal" => $_POST["nuevoSubTotalVenta"],
						"fechaFactura" => $fecha,
						"descuento" => $_POST["descuentoVenta"],
						"impuesto" => $_POST["impuestoVenta"],
						"total" => $_POST["nuevoTotalVenta"],
						"metodoPago" => $_POST["listaMetodoPago"],
						"sinpe" => $_POST["nuevoPagoSinpe"],
						"efectivo" => $_POST["nuevoPagoEfectivo"],
						"tarjeta" => $_POST["nuevoPagoTarjeta"]
					);
				
				

                    $respuesta = ModeloVentas::mdlIngresarVenta($table, $datas);

						foreach ($array as $key => $value) { 
							$tabla = "inventario";
							$item1 = "cantidad";
							$resta = intval($value["stockProducto"]) - intval($value["cantidad"]);
							$valor1 = strval($resta);
							$valor2 = $value["idInventario"];

							$nuevoStock = Inventario::actualizarStockProducto($tabla, $item1, $valor1, $valor2);
						}
						
						
					
                    
                    if($respuesta == "ok"){

						$item = null;
						$valor = null;
						$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

						if (!$ventas) {

							$idFactura = 1;
						
						} else {

							foreach ($ventas as $key => $value) {
							}
							$idFactura = $value["codigo"];
			
						}
						
						$table = "detallefactura";
		
						$respuesta = ModeloDetalle::mdlIngresarDetalle($table, $array, $idFactura);

						if($respuesta == "ok"){

							echo "<script>

								window.location.href = '/ProyectoIngenieria/extensiones/tcpdf/pdf/ticket.php?codigo='+$idFactura;

							</script>";


						}else{
							echo "<script>
						
							Swal.fire({
								title: 'No se puede realizar la factura!',
								icon: 'error',
							}).then((result) => {
								window.location = 'ventas';
							})
							</script>";
						}

						
					}else{

						echo "<script>
						
						Swal.fire({
							title: 'No se puede realizar la factura!',
							icon: 'error',
						}).then((result) => {
							window.location = 'ventas';
						})
						</script>";
					}
			}

	}

	

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "factura";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["producto"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["producto"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "producto";

					$item = "codigo";
					$valor = $value["codigo"];
					$orden = "codigo";

					$traerProducto = Product::mdlShow($tablaProductos, $item, $valor, $orden);

					$item1a = "factura";
					$valor1a = $traerProducto["factura"] - $value["cantidad"];

					$nuevasVentas = Product::mdlUpdateProduct($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "inventario";
					$valor1b = $value["cantidad"] + $traerProducto["inventario"];

					$nuevoStock = Product::mdlUpdateProduct($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "cliente";
				$itemCliente = "cedula";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = Client::mdlShow($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "factura";
				$valor1a = $traerCliente["factura"] - array_sum($totalProductosComprados);

				$comprasCliente = Client::mdlUpdate($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "producto";

					$item_2 = "codigo";
					$valor_2 = $value["codigo"];
					$orden = "codigo";

					$traerProducto_2 = Product::mdlShow($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "factura";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["factura"];

					$nuevasVentas_2 = Product::mdlUpdateProduct($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "inventario";
					$valor1b_2 = $traerProducto_2["inventario"] - $value["cantidad"];

					$nuevoStock_2 = Product::mdlUpdateProduct($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "cliente";

				$item_2 = "cedula";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = Client::mdlShow($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "factura";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["factura"];

				$comprasCliente_2 = Client::mdlUpdate($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = Client::mdlUpdate($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("codigo"=>$_POST["nuevaVenta"],
							"idCliente"=>$_POST["seleccionarCliente"],
							"idSucursal"=>$_POST["idSucusal"],
							"idEmpleado"=>$_POST["idEmpleado"],
							"fechaFactura"=>$_POST["fechaFactura"],
							"subTotal"=>$_POST["subTotal"],
							"impuesto"=>$_POST["impuesto"],
							"total"=>$_POST["total"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "factura";

			$item = "codigo";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = Client::mdlUpdate($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = Client::mdlUpdate($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = Client::mdlUpdate($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["producto"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "producto";

				$item = "codigo";
				$valor = $value["codigo"];
				$orden = "codigo";

				$traerProducto = Product::mdlShow($tablaProductos, $item, $valor, $orden);

				$item1a = "factura";
				$valor1a = $traerProducto["factura"] - $value["cantidad"];

				$nuevasVentas = Product::mdlUpdateProduct($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "inventario";
				$valor1b = $value["cantidad"] + $traerProducto["inventario"];

				$nuevoStock = Product::mdlUpdateProduct($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "cliente";

			$itemCliente = "cedula";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = Client::mdlShow($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "factura";
			$valor1a = $traerCliente["factura"] - array_sum($totalProductosComprados);

			$comprasCliente = Client::mdlUpdate($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "factura";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "factura";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControllerClient::ctrShowClient("cedula", $item["idCliente"]);
				$vendedor = ControllerUser::ctrShowUser("cedula", $item["idEmpleado"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #ee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["producto"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='b:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "factura";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/**Devolver ventas del mes actual */
	 static public function ctrVentasMes(){
		$tabla = "factura";
		$item = "fechaFactura";
		$respuesta = ModeloVentas::mdlMostrarVentasMes($tabla, $item);
		return $respuesta;
	}

}