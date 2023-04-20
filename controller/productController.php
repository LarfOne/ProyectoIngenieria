<?php

class ControllerProduct
{

	static public function ctrNameProducts($codigo){
            
		$respuesta = Product::mdlNameProducts($codigo);
		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/
	static public function ctrShowProduct($item, $valor){

		$tabla = "producto";

		$respuesta = Product::mdlShow($tabla, $item, $valor);
		return $respuesta;
	}


	static public function ctrDeleteProduct()
	{

		if (isset($_GET["idProductE"])) {

			$table = "producto";
			$data = $_GET["idProductE"];

			$respuesta = Product::mdlDelete($table, $data);
			//$respuesta = User::mdlPrueba($data);

			if ($respuesta == "ok") {
				echo "<script>
				
					Swal.fire({
						title: 'El producto se eliminó correctamente',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						closeOnConfirm: false,
						icon: 'success',
					}).then((result) => {
						if(result.value){
							window.location = 'inventarios';
						}
						
					})
				</script>";
			}
		}
	}




	static public function ctrUpdateProduct(){

		if (isset($_POST["idProducto"])) {

			if (preg_match('/^[0-9]+$/', $_POST["idProducto"])) {

				$table = "producto";

				$datas = array(
					"codigo" => $_POST["idProducto"],
					"nombre" => $_POST["nameProducto"],
					"marca" => $_POST["marcaProducto"],
					"descripcion" => $_POST["descriptionProducto"],
					"precioNeto" => $_POST["precioNeto"],
					"categoria" => $_POST["cateProducto"],
					"unidadmedida" => $_POST["unitProducto"],
					"porcentajeIva" => $_POST["porcProducto"],
					"precioTotal" => $_POST["precioTotal"],
					"observaciones" => $_POST["obsProducto"]
				);


			
				$respuesta = Product::mdlUpdateProduct($table, $datas);

				if ($respuesta == "ok") {
					echo "<script>
					
						Swal.fire({
							title: 'El producto se modificó correctamente',
							icon: 'success',
						}).then((result) => {
							window.location = 'inventarios';
						})
					</script>";
				
			    } else {

					echo "<script>
					
					Swal.fire({
						title: 'No se puede modificar el producto',
						icon: 'error',
					}).then((result) => {
						window.location = 'inventarios';
					})
					</script>";
				}
			}
		}
	} 

	static public function ctrCreateProduct()
	{
		if (isset($_POST["idProducto"])) {

			if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ]+$/', $_POST["idProducto"])){

				$table = "producto";

				$datas = array(
					"codigo" => $_POST["idProducto"],
					"nombre" => $_POST["nameProducto"],
					"marca" => $_POST["marcaProducto"],
					"descripcion" => $_POST["descriptionProducto"],
					"categoria" => $_POST["cateProducto"],
					"precioNeto" => $_POST["precioNeto"],
					"unidadmedida" => $_POST["unitProducto"],
					"porcentajeIva" => $_POST["porcProducto"],
					"precioTotal" => $_POST["precioTotal"],
					"observaciones" => $_POST["obsProducto"]
				);

				$respuesta = Product::mdlAdd($table, $datas);

				if ($respuesta == "ok") {
					echo "<script>
					
						Swal.fire({
							title: 'El producto se agregó correctamente',
							icon: 'success',
						}).then((result) => {
							window.location = 'products';
						})
					</script>";
				
				} else {

					echo "<script>
					
					Swal.fire({
						title: 'No se puede agregar el producto',
						icon: 'error',
					}).then((result) => {
						window.location = 'products';
					})
					</script>";
				}
			}
		}

	}

}
?> 