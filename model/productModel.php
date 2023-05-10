<?php

require_once "conexion.php";

class Product{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlNameProducts($valor){
        //SELECT nombre FROM `sucursal` WHERE codigo = 1

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM producto WHERE codigo = :codigo");

        $sentenciaSQL -> bindParam(":codigo", $valor, PDO::PARAM_STR);

        $sentenciaSQL -> execute();

        return $sentenciaSQL -> fetch();
    }


	static public function mdlShow($item, $valor){

		if($item != null){

			$sentenciaSQL = Conexion::conectar()->prepare("CALL pa_obtener_producto(:$item)");

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

		$sentenciaSQL = Conexion::conectar()->prepare("CALL pa_insertar_producto(:codigo, :nombre, :marca, :descripcion, :precioNeto, 
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

        return $listaProduct;
    }


	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlUpdateProduct($datos){

		$sentenciaSQL = Conexion::conectar()->prepare("CALL pa_actualizar_producto (:codigo, :nombre, :marca, :descripcion,
		:precioNeto, :categoria, :unidadmedida, :porcentajeiva, 
		:precioTotal, :observaciones)");
		
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
		
        if ($sentenciaSQL->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $sentenciaSQL->close();

        $sentenciaSQL = null;
    }

    static public function mdlDelete($data)
    {

        $sentenciaSQL = Conexion::conectar()->prepare("CALL pa_eliminar_producto(:codigo)");
        $sentenciaSQL->bindParam(':codigo', $data, PDO::PARAM_INT);

        if ($sentenciaSQL->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $sentenciaSQL->close();

        $sentenciaSQL = null;
    }
}