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

		$respuesta = Product::mdlShow($item, $valor);
		return $respuesta;
	}


	static public function ctrDeleteProduct()
	{

		if (isset($_GET["idProductE"])) {

			$table = "producto";
			$data = $_GET["idProductE"];

			$respuesta = Product::mdlDelete($data);
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

		if (isset($_POST["idProductoAjuste"])) {

			if (preg_match('/^[0-9]+$/', $_POST["idProductoAjuste"])) {

				$datas = array(
					"codigo" => $_POST["idProductoAjuste"],
					"nombre" => $_POST["nameProductoAjuste"],
					"marca" => $_POST["marcaProductoAjuste"],
					"descripcion" => $_POST["descriptionProductoAjuste"],
					"precioNeto" => $_POST["precioNetoAjuste"],
					"categoria" => $_POST["cateProductoAjuste"],
					"unidadmedida" => $_POST["unitProductoAjuste"],
					"porcentajeIva" => $_POST["porcProductoAjuste"],
					"precioTotal" => $_POST["precioTotalAjuste"],
					"observaciones" => $_POST["obsProductoAjuste"]
				);


			
				$respuesta = Product::mdlUpdateProduct($datas);

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

				$respuesta = Product::mdlAdd($datas);

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