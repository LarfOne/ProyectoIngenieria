<?php

class ControllerProduct
{
	//Recibe como parámetro el código del producto
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

        // Obtener la ruta de la imagen del producto
        $rutaImagen = Product::getProductImagePath($data);

        $respuesta = Product::mdlDelete($data);

        if ($respuesta == "ok") {
            // Eliminar la imagen del producto si existe
            if (!empty($rutaImagen) && file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }

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

			if(preg_match('/^[0-9]{1,18}$/', $_POST["idProductoAjuste"])){
				if(preg_match('/^[0-9a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,25}$/', $_POST["nameProductoAjuste"])){
					if(preg_match('/^[0-9a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,20}$/', $_POST["marcaProductoAjuste"])){
						if(preg_match('/^[0-9a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST["descriptionProductoAjuste"])){
							if(preg_match('/^[0-9]{1,10}$/', $_POST["precioNetoAjuste"])){
								if(preg_match('/^[0-9]{1,2}$/', $_POST["porcProductoAjuste"])){
									if(preg_match('/^[0-9]{1,10}$/', $_POST["precioTotalAjuste"])){

										$usuarioResponsable = $_SESSION["nombre"] . " " . $_SESSION["apellidos"];

										$ruta = $_POST["fotoActualProducto"];
										
										if(isset($_FILES["imageProductosAjuste"]["tmp_name"]) && !empty($_FILES["imageProductosAjuste"]["tmp_name"])){	
											list($ancho, $alto) = getimagesize($_FILES["imageProductosAjuste"]["tmp_name"]);
											//var_dump($_FILES["image"]["tmp_name"]);
											$directorio = "imagen/productos/";
											if (!file_exists($directorio)) {
												mkdir($directorio, 0755);
											}
											if($_FILES["imageProductosAjuste"]["type"] == "image/jpeg"){
												$ruta = "imagen/productos/".$_POST["idProductoAjuste"].".jpg";
												$origen = imagecreatefromjpeg($_FILES["imageProductosAjuste"]["tmp_name"]);
												$destino = imagecreatetruecolor($ancho, $alto);
												imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
												imagejpeg($destino, $ruta);
											}
											if($_FILES["imageProductosAjuste"]["type"] == "image/png"){
												$ruta = "imagen/productos/".$_POST["idProductoAjuste"].".png";
												$origen = imagecreatefrompng($_FILES["imageProductosAjuste"]["tmp_name"]);
												$destino = imagecreatetruecolor($ancho, $alto);
												imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
												imagepng($destino, $ruta);
											}
											
										}

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
											"observaciones" => $_POST["obsProductoAjuste"],
											"image" => $ruta,
											"usuarioResponsable" => $usuarioResponsable);


										//llama al método "mdlUpdateProduct" de la clase Product para actualizar el producto en la base de datos. 
										$respuesta = Product::mdlUpdateProduct($datas);

										if ($respuesta == "ok") {

											$table = "inventario";
											$nuevaCantidad = intval($_POST["existenciaAjuste"]) + intval($_POST["cantProductoAjuste"]);
											//array con los nuevos datos del inventario, que consisten en el código del inventario a modificar
											$datasInventario = array("codigo" => $_POST["codigoInventarioAjuste"], 
															"idSucursal" => $_POST["idSucursalAjuste"], 
															"idProducto" =>  $_POST["idProductoAjuste"],    
															"cantidad" => $nuevaCantidad);
												// llama al método "mdlUpdateInventario" de la clase "Inventario" para realizar la actualización en la base de datos
											$respuesta = Inventario::mdlUpdateInventario($table, $datasInventario);

											if($respuesta == "ok"){
												echo "<script>
													Swal.fire({
														title: 'El producto se modifico correctamente al inventario',
														icon: 'success',
													}).then((result) => {
														window.location = 'inventarios';
													})
												</script>";

											}else{
												echo "<script>
											
												Swal.fire({
													title: 'No se puede modificar el producto al inventario',
													icon: 'error',
												}).then((result) => {
													window.location = 'inventarios';
												})
												</script>";
											}
											
										} else {
											echo "<script>
											
											Swal.fire({
												title: 'No se puede agregar el producto',
												icon: 'error',
											}).then((result) => {
												window.location = 'inventarios';
											})
											</script>";
										}
									}
								}
							}
						}
					}
				}
			}
		}
	} 

	static public function ctrCreateProduct()
	{
		//verifica si se ha enviado una solicitud POST con un valor idProducto
		if (isset($_POST["idProducto"])) {

			if(preg_match('/^[0-9]{1,18}$/', $_POST["idProducto"])){
				if(preg_match('/^[0-9a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,25}$/', $_POST["nameProducto"])){
					if(preg_match('/^[0-9a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,20}$/', $_POST["marcaProducto"])){
						if(preg_match('/^[0-9a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST["descriptionProducto"])){
							if(preg_match('/^[0-9]{1,10}$/', $_POST["precioNeto"])){
								if(preg_match('/^[0-9]{1,2}$/', $_POST["porcProducto"])){
									if(preg_match('/^[0-9]{1,10}$/', $_POST["precioTotal"])){

										$usuarioResponsable = $_SESSION["nombre"] . " " . $_SESSION["apellidos"];
										/************************** FOTO PRODUCTO ********************************************/
										$ruta = null;
										if(isset($_FILES["imageProductos"]) && $_FILES["imageProductos"]["error"] === UPLOAD_ERR_OK){	

											list($ancho, $alto) = getimagesize($_FILES["imageProductos"]["tmp_name"]);
											//var_dump($_FILES["image"]["tmp_name"]);
											$directorio = "imagen/productos/";
											if (!file_exists($directorio)) {
												mkdir($directorio, 0755);
											}
											if($_FILES["imageProductos"]["type"] == "image/jpeg"){
												$ruta = "imagen/productos/".$_POST["idProducto"].".jpg";
												$origen = imagecreatefromjpeg($_FILES["imageProductos"]["tmp_name"]);
												$destino = imagecreatetruecolor($ancho, $alto);
												imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
												imagejpeg($destino, $ruta);
											}
											if($_FILES["imageProductos"]["type"] == "image/png"){
												$ruta = "imagen/productos/".$_POST["idProducto"].".png";
												$origen = imagecreatefrompng($_FILES["imageProductos"]["tmp_name"]);
												$destino = imagecreatetruecolor($ancho, $alto);
												imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
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
											"usuarioResponsable" => $usuarioResponsable);
											
											//mdlAdd() y se le pasa $datas como argumento. Si el método mdlAdd() devuelve "ok", 
										//el producto se agregó con éxito a la base de datos y se muestra una alerta de éxito. Si el método devuelve otra cosa, se muestra una alerta de error.
										$respuesta = Product::mdlAdd($datas);

										if ($respuesta == "ok") {

											$tableInventario = "inventario";
											//crea un arreglo con los datos necesarios para el nuevo registro, donde se especifica la sucursal, el producto y la cantidad de productos disponibles en esa sucursal

											$datasInventario = array(
												"idSucursal" => $_POST["idSucursalProducto"],
												"idProducto" => $_POST["idProducto"],
												"cantidad" => $_POST["cantProducto"]
											);

											$respuesta = Inventario::mdlAdd($tableInventario, $datasInventario);

											if($respuesta == "ok"){
												echo "<script>
													Swal.fire({
														title: 'El producto se agregó correctamente al inventario',
														icon: 'success',
													}).then((result) => {
														window.location = 'products';
													})
												</script>";

											}else{
												echo "<script>
											
												Swal.fire({
													title: 'No se puede agregar el producto al inventario',
													icon: 'error',
												}).then((result) => {
													window.location = 'products';
												})
												</script>";
											}
											
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
					}
				}
			}
		}
	}

}
?> 