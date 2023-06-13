<?php

require_once "conexion.php";

class Categories{             

    //acepta un parámetro $valor
    //El método se utiliza para buscar una categoría en la tabla "categoria" de la base de datos mediante su código.
    static public function mdlNameCategories($valor){
        //SELECT nombre FROM `Categories` WHERE codigo = 1

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM categoria WHERE codigo = :codigo");

        $sentenciaSQL -> bindParam(":codigo", $valor, PDO::PARAM_STR);

        $sentenciaSQL -> execute();

        return $sentenciaSQL -> fetch();//Después de ejecutar la consulta, el método devuelve el resultado utilizando el método fetch(), que devuelve una fila de la tabla de la base de datos como un array.
    }
    //mdlShow() que acepta tres parámetros: $tabla, $item y $valor
    static public function mdlShow($tabla, $item, $valor){

        if($item != null){
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetch();//Finalmente, devuelve el resultado de la consulta utilizando el método fetch()
        
        }else{
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM vista_categoria");

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();//devuelve todos los resultados utilizando el método fetchAll().
        }

        

        $sentenciaSQL -> close();

        $sentenciaSQL = null;
        
    }

    static public function mdlAdd($datas){
        //mdlAdd() que acepta un parámetro $datas
        //El propósito de este método es insertar un nuevo registro en la tabla "categoria" de la base de datos.
        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_insertar_categoria(:nombre)");

        $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);
        //Si la inserción fue exitosa, el método devuelve la cadena "ok". De lo contrario, devuelve la cadena "error".
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }
    //mdlRead() que se utiliza para leer todos los registros de la tabla "categoria" de la base de datos.
    static public function mdlRead(){
        $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM categoria");
        $sentenciaSQL->execute();
        // el método fetchAll() para obtener todos los registros de la tabla "categoria" como una matriz asociativa.
        $listaCategories=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaCategories;// devuelve la matriz asociativa que contiene todos los registros de la tabla "categoria".

    }

    static public function mdlUpdate($datas){
        //mdlUpdate() que acepta un parámetro $datas
        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_actualizar_categoria(:codigo,:nombre)");
        
        
        $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);

        //Si la actualización fue exitosa, el método devuelve la cadena "ok". De lo contrario, devuelve la cadena "error".
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;//$sentenciaSQL en null para liberar recursos.

    }

    static public function mdlDelete($data){
        //mdlDelete() que acepta un parámetro $data
        $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_eliminar_categoria(:codigo)");
        $sentenciaSQL -> bindParam(':codigo', $data, PDO::PARAM_INT);
        //Si la eliminación fue exitosa, el método devuelve la cadena "ok". De lo contrario, devuelve la cadena "error".
        if($sentenciaSQL->execute()){
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;//$sentenciaSQL en null para liberar recursos.


    }

}

?>