<?php

require_once "conexion.php";

class ModeloDetalle{

    static public function mdlIngresarDetalle($tabla, $datos, $idFactura){
        $response = "error";

        for($i = 0; $i < count($datos); $i++){

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idFactura,idProducto, cantidad, precUnit, subTotal) VALUES (:idFactura, :idProducto, :cantidad, :precUnit, :subTotal)");

                $stmt->bindParam(":idFactura", $idFactura, PDO::PARAM_INT);
                $stmt->bindParam(":idProducto", $datos[$i]["idProducto"], PDO::PARAM_INT);
                $stmt->bindParam(":cantidad", $datos[$i]["cantidad"], PDO::PARAM_INT);
                $stmt->bindParam(":precUnit", $datos[$i]["precioUnitario"], PDO::PARAM_INT);
                $stmt->bindParam(":subTotal", $datos[$i]["subTotal"], PDO::PARAM_INT);

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



    static public function mdlShow($tabla, $item, $valor){

        if($item != null){
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT idProducto, cantidad,precUnit,subTotal FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();
        
        }else{
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        }
    }

    static function mdlMostrarDetalleporIdFactura($tabla, $item, $valor)
    {

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
















}
