<?php

require_once "conexion.php";

class Product{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlNameProducts($valor){
       // recibe un parámetro llamado "$valor" que representa el código del producto que se desea buscar 
		//SELECT nombre FROM `sucursal` WHERE codigo = 1

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM producto WHERE codigo = :codigo");

        $sentenciaSQL -> bindParam(":codigo", $valor, PDO::PARAM_STR);

        $sentenciaSQL -> execute();

        return $sentenciaSQL -> fetch();// devuelve el resultado de la consulta en forma de arreglo asociativo 
    }


	static public function mdlShow($item, $valor){
		//mdlShow recibe dos parámetros: $item y $valor.
		if($item != null){//retorna una fila de la tabla "producto" si se encuentra un producto con el valor de columna 
			             //$item igual a $valor y $item no es null. Si $item es null, la función retorna todas las filas de la vista "vista_producto". Si no se encuentra ningún producto, la función retorna null.

			$sentenciaSQL = Conexion::conectar()->prepare("CALL sp_obtener_producto(:$item)");

			$sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$sentenciaSQL -> execute();

			return $sentenciaSQL -> fetch();

		}else{

			$sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM vista_producto");

			$sentenciaSQL -> execute();

			return $sentenciaSQL -> fetchAll();

		}

		$sentenciaSQL -> close();

		$sentenciaSQL = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlAdd($datos){
		//recibe un arreglo asociativo $datos con la información del producto a agregar
		$sentenciaSQL = Conexion::conectar()->prepare("CALL sp_insertar_producto(:codigo, :nombre, :marca, :descripcion, :precioNeto, 
			:categoria, :unidadmedida, :porcentajeIva, :precioTotal, :observaciones, :image, :usuarioIngresa)");

		$sentenciaSQL->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":precioNeto", $datos["precioNeto"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":categoria", $datos["categoria"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":unidadmedida", $datos["unidadmedida"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":porcentajeIva", $datos["porcentajeIva"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":precioTotal", $datos["precioTotal"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":image", $datos["image"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":usuarioIngresa", $datos["usuarioIngresa"], PDO::PARAM_STR);

		//retorna un string indicando si la operación de inserción en la base de datos fue exitosa o no, 
		//"ok" en caso de éxito y "error" en caso contrario.
		if($sentenciaSQL->execute()){
			return "ok";
		}else{
			return "error";
		
		}
		$sentenciaSQL->close();
		$sentenciaSQL = null;

	}

	static public function mdlRead()
    {
        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM producto");
        $sentenciaSQL->execute();
        $listaProduct = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaProduct;//devuelve un array con la información de todos los productos en la tabla producto
    }


	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlUpdateProduct($datos){
		//mdlUpdateProduct recibe un arreglo de datos que representan los nuevos valores de un producto.
		$sentenciaSQL = Conexion::conectar()->prepare("CALL sp_actualizar_producto (:codigo, :nombre, :marca, :descripcion,
		:precioNeto, :categoria, :unidadmedida, :porcentajeiva, 
		:precioTotal, :observaciones, :image, :usuarioIngresa)");
		
		$sentenciaSQL->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":precioNeto", $datos["precioNeto"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":categoria", $datos["categoria"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":unidadmedida", $datos["unidadmedida"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":porcentajeiva", $datos["porcentajeIva"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":precioTotal", $datos["precioTotal"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":image", $datos["image"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":usuarioIngresa", $datos["usuarioIngresa"], PDO::PARAM_STR);
		
		//Si la ejecución de la sentencia SQL es exitosa, la función retorna la cadena "ok". De lo contrario, retorna la cadena "error".
        if ($sentenciaSQL->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $sentenciaSQL->close();

        $sentenciaSQL = null;
    }

    static public function mdlDelete($data)
    {//mdlDelete recibe un parámetro $data que corresponde al código del producto a eliminar

        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_eliminar_producto(:codigo)");
        $sentenciaSQL->bindParam(':codigo', $data, PDO::PARAM_INT);
		//Si la eliminación se realizó correctamente, la función devuelve "ok", de lo contrario, devuelve "error".
        if ($sentenciaSQL->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $sentenciaSQL->close();

        $sentenciaSQL = null;
    }
}