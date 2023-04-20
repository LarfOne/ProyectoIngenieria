<?php 
    require_once "conexion.php";

    class Auditoria{

        static public function mdlShowAuditProduct($tabla, $item, $valor){
            if($item != null){
                $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

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

    }  

?>