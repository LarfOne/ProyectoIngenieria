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
}

?>
