<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigo ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente, idSucursal, idEmpleado, fechaFactura, subTotal, impuesto, descuento, total) VALUES (:idCliente, :idSucursal, :idEmpleado, :fechaFactura, :subTotal, :impuesto, :descuento, :total)");
		
		//$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_INT);
		$stmt->bindParam(":idSucursal", $datos["idSucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaFactura", $datos["fechaFactura"], PDO::PARAM_STR);
		$stmt->bindParam(":subTotal", $datos["subTotal"], PDO::PARAM_INT);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  idCliente = :idCliente,idSucursal = :idSucursal , idEmpleado = :idEmpleado, fechaFactura = :fechaFactura,subTotal = :subTotal, impuesto = :impuesto, descuento= :descuento, total= :total WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_INT);
		$stmt->bindParam(":idSucursal", $datos["idSucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaFactura", $datos["fechaFactura"], PDO::PARAM_STR);
		$stmt->bindParam(":subTotal", $datos["subTotal"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo = :codigo");

		$stmt -> bindParam(":codigo", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaFactura = :fechaFactura");
    $stmt->bindParam(":fechaFactura", $fechaInicial, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaFactura BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaFactura BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/**MOSTRAR VENTAS DEL MES ACTUAL */
	static public function mdlMostrarVentasMes($tabla, $item){
		//Item va a ser fechaFactura. No hay valor debido a que se va a utilizar una funcion de mysql para extraer el mes actual
		//MONTH(NOW()) Permite extraer el mes actual

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE MONTH($item) = MONTH(NOW())");

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