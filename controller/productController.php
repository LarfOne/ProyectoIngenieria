<?php

class ControllerProduct
{

	//Recibe como parámetro el código del producto
	static public function ctrNameProducts($codigo){
        //"mdlNameProducts" definido en el modelo "Product" para obtener
		// la información correspondiente al nombre del producto
		$respuesta = Product::mdlNameProducts($codigo);
		return $respuesta;

	}

	/*=============================================
	PRODUCTO
	=============================================*/
	static public function ctrShowProduct($item, $valor){

		$respuesta = Product::mdlShow($item, $valor);
		// devuelve el resultado obtenido a través de la variable $respuesta.
		return $respuesta;
	}


	static public function ctrDeleteProduct()
	{
		//ctrDeleteProduct() verifica si se ha recibido un parámetro idProductE por el método GET
		if (isset($_GET["idProductE"])) {

			$table = "producto";
			$data = $_GET["idProductE"];

			$respuesta = Product::mdlDelete($data);
			//$respuesta = User::mdlPrueba($data);
			//Product::mdlDelete($data) para eliminar el producto correspondiente de la base de datos. Si la respuesta es "ok", se muestra un mensaje de éxito utilizando la biblioteca 
			//SweetAlert y se redirige al usuario a la página de inventarios.
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
		//verifica si se ha enviado el ID del producto a actualizar a través del método POST
		if (isset($_POST["idProductoAjuste"])) {

			if (preg_match('/^[0-9]+$/', $_POST["idProductoAjuste"])) {
				// se crea un array con los datos del producto a actualizar, que se obtienen a través del método POST.
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


			//llama al método "mdlUpdateProduct" de la clase Product para actualizar el producto en la base de datos. 
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
	//verifica si se ha enviado una solicitud POST con un valor idProducto
	{
		$usuarioIngresa = $_SESSION["nombre"] . " " . $_SESSION["apellidos"];
		echo $usuarioIngresa;

		if (isset($_POST["idProducto"])) {

			if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ]+$/', $_POST["idProducto"])){

				/************************** FOTO PRODUCTO ********************************************/
				$ruta = null;
                    if(isset($_FILES["imageProductos"]["tmp_name"])){	

                        list($ancho, $alto) = getimagesize($_FILES["imageProductos"]["tmp_name"]);
                        //var_dump($_FILES["image"]["tmp_name"]);
                        $directorio = "imagen/productos/".$_POST["idProducto"];
                        mkdir($directorio, 0755);
                        if($_FILES["imageProductos"]["type"] == "image/jpeg"){
                            $ruta = "imagen/productos/".$_POST["idProducto"]."/".$_FILES["imageProductos"]["name"];
                            $origen = imagecreatefromjpeg($_FILES["imageProductos"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);
                            imagejpeg($destino, $ruta);
                        }
                        if($_FILES["imageProductos"]["type"] == "image/png"){
                            $ruta = "imagen/productos/".$_POST["idProducto"]."/".$_FILES["imageProductos"]["name"];
                            $origen = imagecreatefrompng($_FILES["imageProductos"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);
                            imagepng($destino, $ruta);
                        }
                        
                    }
					
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
					"observaciones" => $_POST["obsProducto"],
					"image" => $ruta,
					"usuarioIngresa" => $usuarioIngresa
				);

				print_r($datas);
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