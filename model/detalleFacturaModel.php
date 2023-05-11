<?php

require_once "conexion.php";

class ModeloDetalle{
//permite insertar múltiples registros en una tabla de la base de datos a partir de un array de datos
    static public function mdlIngresarDetalle($tabla, $datos, $idFactura){
        //recibe como parámetros el nombre de la tabla, un array con los datos que se van a insertar y el id de la factura
        $response = "error";//$response se inicializa en "error" y se actualiza a "ok" si la inserción se realiza correctamente.

        for($i = 0; $i < count($datos); $i++){

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idFactura,idProducto, cantidad, precUnit, descuento,subTotal) VALUES (:idFactura, :idProducto, :cantidad, :precUnit, :descuento,:subTotal)");

                $stmt->bindParam(":idFactura", $idFactura, PDO::PARAM_INT);
                $stmt->bindParam(":idProducto", $datos[$i]["idProducto"], PDO::PARAM_INT);
                $stmt->bindParam(":cantidad", $datos[$i]["cantidad"], PDO::PARAM_INT);
                $stmt->bindParam(":precUnit", $datos[$i]["precioUnitario"], PDO::PARAM_INT);
                $stmt->bindParam(":descuento", $datos[$i]["descuento"], PDO::PARAM_INT);
                $stmt->bindParam(":subTotal", $datos[$i]["subTotal"], PDO::PARAM_INT);
                
                if($stmt->execute()){
                    $response = "ok";
        
                }else{
        
                    $response = "error";
                
                }
            }
        return $response;//La función retorna el valor de $response 

        $stmt->close();
        $stmt = null;

    }



    static public function mdlShow($tabla, $item, $valor){
        //toma tres parámetros: $tabla, $item, $valor.
        if($item != null){//$item no es nulo, se prepara una sentencia SQL para seleccionar todas las columnas idProducto, cantidad, precUnit y subTotal de la tabla $tabla donde $item es igual a $valor.
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT idProducto, cantidad,precUnit,subTotal FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();
        
        }else{//Si $item es nulo, se prepara una sentencia SQL para seleccionar todas las columnas de la tabla $tabla
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $sentenciaSQL -> execute();
            return $sentenciaSQL -> fetchAll();//devuelven todos los resultados usando el método fetchAll().
        }
        $sentenciaSQL -> close();

        $sentenciaSQL = null;
    }

    static function mdlMostrarDetalleporIdFactura($tabla, $item, $valor)
    {//recibe el nombre de una tabla, un item y un valor,
        //devuelve un arreglo con todas las filas de la tabla que coinciden con el filtro especificado si se proporciona $item y $valor.
        // Si no se proporciona un filtro, la función devuelve todas las filas de la tabla en un arreglo.
        if ($item != null) {
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");
            $sentenciaSQL->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll();
        } else {
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");
        
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll();
        }
        $sentenciaSQL ->close();

        $sentenciaSQL = null;


    }



	static public function mdlSumaProcuctosVendidos($tabla){
        //mdlSumaProcuctosVendidos recibe como parámetro el nombre de la tabla 
		$stmt = Conexion::conectar()->prepare("SELECT SUM(idProducto) as total FROM $tabla GROUP BY idProducto");
        //retorna un arreglo con los resultados de la consulta SQL, que consisten en la suma de los productos vendidos agrupados por idProducto
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}


}
