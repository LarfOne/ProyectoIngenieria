<?php

require_once "conexion.php";

class ModeloDetalle{

    static public function mdlIngresarDetalle($tabla, $datos, $idFactura){
        $response = "error";

        for($i = 0; $i < count($datos); $i++){

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idFactura,idProducto, cantidad, precUnit, subTotal) VALUES (:idFactura, :idProducto, :cantidad, :precUnit, :subTotal)");

                $stmt->bindParam(":idFactura", $idFactura, PDO::PARAM_INT);
                $stmt->bindParam(":idProducto", $datos[$i]["id"], PDO::PARAM_INT);
                $stmt->bindParam(":cantidad", $datos[$i]["cantidad"], PDO::PARAM_INT);
                //$stmt->bindParam(":fechaFactura", $datos["fechaFactura"], PDO::PARAM_STR);
                $stmt->bindParam(":precUnit", $datos[$i]["precio"], PDO::PARAM_INT);
                $stmt->bindParam(":subTotal", $datos[$i]["total"], PDO::PARAM_INT);
                //$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
                //$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
                if($stmt->execute()){

                    $response = "ok";
        
                }else{
        
                    $response = "error";
                
                }

            }
        

        return $response;

        $stmt->close();
        $stmt = null;

    }



	/**MOSTRAR detalle asociado a una factura */
	static public function mdlMostrarDetalleporIdFactura($tabla, $item, $valor){
		//Item va a ser fechaFactura. No hay valor debido a que se va a utilizar una funcion de mysql para extraer el mes actual
		//MONTH(NOW()) Permite extraer el mes actual

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}











    
}

?>
