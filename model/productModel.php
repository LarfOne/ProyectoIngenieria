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


	static public function mdlShow($tabla, $item, $valor){

		if($item != null){

			$sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$sentenciaSQL -> execute();

			return $sentenciaSQL -> fetch();

		}else{

			$sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$sentenciaSQL -> execute();

			return $sentenciaSQL -> fetchAll();

		}

		$sentenciaSQL -> close();

		$sentenciaSQL = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlAdd($tabla, $datos){

		$sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,nombre,marca, descripcion, precio, categoria, unidadmedida, porcentajeIva, ganancia, porcentajeGanancia, observaciones)
		VALUES (:codigo, :nombre, :marca, :descripcion, :precio, :categoria, :unidadmedida, :porcentajeIva, :ganancia, :porcentajeGanancia, :observaciones)");

		$sentenciaSQL->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":unidadmedida", $datos["unidadmedida"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":porcentajeIva", $datos["porcentajeIva"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":ganancia", $datos["ganancia"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":porcentajeGanancia", $datos["porcentajeGanancia"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);


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
	static public function mdlUpdateProduct($tabla, $datos){

		$sentenciaSQL = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, marca = :marca, descripcion = :descripcion,
		precio = :precio, categoria = :categoria, unidadmedida = :unidadmedida, porcentajeiva = :porcentajeiva, 
		ganancia = :ganancia, porcentajeGanancia = :porcentajeGanancia, observaciones = :observaciones WHERE codigo = :codigo");

       
		
		$sentenciaSQL->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":categoria", $datos["categoria"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":unidadmedida", $datos["unidadmedida"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":porcentajeiva", $datos["porcentajeiva"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":ganancia", $datos["ganancia"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":porcentajeGanancia", $datos["porcentajeGanancia"], PDO::PARAM_INT);
		$sentenciaSQL->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);


        if ($sentenciaSQL->execute()) {

            return "ok";
        } else {
            return "error";
        }

        $sentenciaSQL->close();

        $sentenciaSQL = null;
    }

    static public function mdlDelete($table, $data)
    {

        $sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $table WHERE codigo = :codigo");
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