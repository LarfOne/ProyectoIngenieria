<?php

    require_once "conexion.php";

    class Inventario{             

        static public function mdlShowInventario($tabla, $item, $valor){

            if($item != null){
                
                $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                
                $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                
                $sentenciaSQL -> execute();
                
                return $sentenciaSQL -> fetch();
                
            }else{
                $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");

                $sentenciaSQL -> execute();

                return $sentenciaSQL -> fetchAll();

                $sentenciaSQL -> close();

                $sentenciaSQL = null;
            }
            
        }

        static public function mdlAdd($table, $datas){

            $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (codigo, idSucursal, idProducto, cantidad, existencia, minimo) VALUES
                                                                                (:codigo, :idSucursal, :idProducto, :cantidad, :existencia, :minimo)");

            $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':idProducto', $datas["idProducto"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':cantidad', $datas["cantidad"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':existencia', $datas["existencia"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':minimo', $datas["minimo"], PDO::PARAM_STR);

            $sentenciaSQL->execute();

        }

        /*static public function mdlRead(){
            $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM empleado");
            $sentenciaSQL->execute();
            $listaEmpleados=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            return $listaEmpleados;

        }*/

        static public function mdlUpdateInventario($table, $datas){

            $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET idSucursal = :idSucursal, idProducto = :idProducto, cantidad = :cantidad, existencia = :existencia, minimo = :minimo WHERE codigo = :codigo");
            
            $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':idProducto', $datas["idProducto"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':cantidad', $datas["cantidad"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':existencia', $datas["existencia"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':minimo', $datas["minimo"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);

            if($sentenciaSQL->execute()){
                
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;

        }

        static public function mdlDelete($table, $data){

            $sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $table WHERE codigo = :codigo");
            $sentenciaSQL -> bindParam(':codigo', $data, PDO::PARAM_INT);

            if($sentenciaSQL->execute()){
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;


        }




        static public function mdlMostrarCantidadProductosInventario($tabla, $item){
	
		
            if($item != null){
    
                $stmt = Conexion::conectar()->prepare("SELECT COUNT(DISTINCT $item)  FROM $tabla");
    
               
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