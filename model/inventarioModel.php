<?php

    require_once "conexion.php";

        class Inventario{
                                                    //inventario, cantidad, resta, codigo
            static public function actualizarStockProducto($tabla, $item1, $valor1, $valor){

                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE codigo = :codigo");

                $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
                $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return "error";	

                }

                $stmt -> close();

                $stmt = null;

            }

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

            static public function codigoInventarioPorProducto($tabla, $item, $valor){

                $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                    
                $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_INT);
                    
                $sentenciaSQL -> execute();
                    
                return $sentenciaSQL -> fetch();
            }

            static public function mdlAdd($table, $datas){

                $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (codigo, idSucursal, idProducto, cantidad) VALUES
                                                                                    (:codigo, :idSucursal, :idProducto, :cantidad)");

                $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':idProducto', $datas["idProducto"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':cantidad', $datas["cantidad"], PDO::PARAM_STR);

                $sentenciaSQL->execute();

            }

            /*static public function mdlRead(){
                $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM empleado");
                $sentenciaSQL->execute();
                $listaEmpleados=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

                return $listaEmpleados;

            }*/

            static public function mdlUpdateInventario($table, $datas){

                $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET idSucursal = :idSucursal, idProducto = :idProducto, cantidad = :cantidad WHERE codigo = :codigo");
                
                $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':idProducto', $datas["idProducto"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':cantidad', $datas["cantidad"], PDO::PARAM_STR);
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