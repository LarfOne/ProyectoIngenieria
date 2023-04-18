<?php

require_once "conexion.php";

class Activo{             


    static public function mdlNameActivo($valor){
        //SELECT nombre FROM `sucursal` WHERE codigo = 1

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM activos WHERE codigo= :codigo");

        $sentenciaSQL -> bindParam(":cedula", $valor, PDO::PARAM_STR);

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

        $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (idSucursal,descripcion,estado,empleado_id) VALUES
                                                                            (:idSucursal, :descripcion, :estado, :empleado_id )");
                                                                            
        $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':descripcion', $datas["descripcion"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':estado', $datas["estado"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':empleado_id', $datas["empleado_id"], PDO::PARAM_STR);
  



        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }

    static public function mdlRead(){
        $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM activo");
        $sentenciaSQL->execute();
        $listaActivo=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaActivo;

    }

    static public function mdlUpdate($table, $datas){

        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET idSucursal = :idSucursal, descripcion = :descripcion, estado = :estado,
                                                         empleado_id = :empleado_id WHERE codigo = :codigo");
        
        
        $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':descripcion', $datas["descripcion"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':estado', $datas["estado"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':empleado_id', $datas["empleado_id"], PDO::PARAM_STR);
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



}

?>