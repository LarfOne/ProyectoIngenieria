<?php

require_once "conexion.php";

class Sucursal{             

    //mdlNameSucursal que acepta un parámetro $valor
    static public function mdlNameSucursal($valor){
        //SELECT nombre FROM `sucursal` WHERE codigo = 1
        //Realiza una consulta a la tabla de base de datos llamada sucursal y recupera todas las columnas donde la columna codigo
        // es igual al valor del parámetro $valor.
        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM sucursal WHERE codigo = :codigo");

        $sentenciaSQL -> bindParam(":codigo", $valor, PDO::PARAM_STR);

        $sentenciaSQL -> execute();

        return $sentenciaSQL -> fetch();
    }
    //mdlShow que acepta tres parámetros: $tabla, $item y $valor.
    static public function mdlShow($tabla, $item, $valor){
        // verifica si el parámetro $item es nulo o no. Si no es nulo, entonces se prepara una consulta SQL que selecciona todas las columnas de la tabla $tabla
        // donde la columna $item es igual al valor del parámetro $valor.
        if($item != null){
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetch();
        
        }else{
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();//devuelve una única fila de la tabla en forma de array asociativo.
        }

    
        $sentenciaSQL -> close();

        $sentenciaSQL = null;
        
    }

    static public function mdlAdd($table, $datas){

        //mdlAdd que acepta dos parámetros: $table y $datas.
        $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (codigo, nombre,direccion,telefono,email) VALUES
                                                                            (:codigo, :nombre, :direccion, :telefono, :email )");

        $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':direccion', $datas["direccion"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':telefono', $datas["telefono"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':email', $datas["email"], PDO::PARAM_STR);
  

        //Si la ejecución de la declaración SQL es exitosa, 
        //la función devuelve el valor "ok". De lo contrario, devuelve "error".

        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }

    static public function mdlRead(){
        //mdlRead que no acepta ningún parámetro.
        $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM sucursal");
        $sentenciaSQL->execute();
        $listaSucursal=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaSucursal;// devuelve el array que contiene todas las filas resultantes de la consulta.

    }

    static public function mdlUpdate($table, $datas){
        //mdlUpdate que acepta dos parámetros: $table y $datas.
        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre, direccion = :direccion, email = :email,
                                                        telefono = :telefono, email = :email WHERE codigo = :codigo");
        
        
        $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':direccion', $datas["direccion"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':telefono', $datas["telefono"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':email', $datas["email"], PDO::PARAM_STR);
      
        //Si la ejecución es exitosa, la función devuelve "ok". De lo contrario, devuelve "error".
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }
    //mdlDelete que acepta dos parámetros: $table y $data.
    static public function mdlDelete($table, $data){

        $sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $table WHERE codigo = :codigo");
        $sentenciaSQL -> bindParam(':codigo', $data, PDO::PARAM_INT);
        // Si la ejecución es exitosa, la función devuelve "ok". De lo contrario, devuelve "error".
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