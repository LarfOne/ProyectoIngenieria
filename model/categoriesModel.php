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
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();
        }

        

        $sentenciaSQL -> close();

        $sentenciaSQL = null;
        
    }

    static public function mdlAdd($table, $datas){

        $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (codigo, nombre) VALUES
                                                                            (:codigo, :nombre )");

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

    static public function mdlRead(){
        $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM categoria");
        $sentenciaSQL->execute();
        $listaCategories=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaCategories;

    }

    static public function mdlUpdate($table, $datas){

        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre
                                                         WHERE codigo = :codigo");
        
        
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

}

?>