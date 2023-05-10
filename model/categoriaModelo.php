<?php

require_once "conexion.php";

class Categories{             


    static public function mdlNameCategories($valor){
        //SELECT nombre FROM `Categories` WHERE codigo = 1

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM categoria WHERE codigo = :codigo");

        $sentenciaSQL -> bindParam(":codigo", $valor, PDO::PARAM_STR);

        $sentenciaSQL -> execute();

        return $sentenciaSQL -> fetch();
    }

    static public function mdlShow($tabla, $item, $valor){

        if($item != null){
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetch();
        
        }else{
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM vista_categoria");

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();
        }

        

        $sentenciaSQL -> close();

        $sentenciaSQL = null;
        
    }

    static public function mdlAdd($datas){

        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_insertar_categoria(:nombre)");

        $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);

        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }

    static public function mdlRead(){
        $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM categoria");
        $sentenciaSQL->execute();
        $listaCategories=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaCategories;

    }

    static public function mdlUpdate($datas){

        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_actualizar_categoria(:codigo,:nombre)");
        
        
        $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);


        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }

    static public function mdlDelete($data){

        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_eliminar_categoria(:codigo)");
        $sentenciaSQL -> bindParam(':codigo', $data, PDO::PARAM_INT);

        if($sentenciaSQL->execute()){
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;


    }

}

?>