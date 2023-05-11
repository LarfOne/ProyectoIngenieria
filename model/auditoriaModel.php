<?php 
    require_once "conexion.php";

    class Auditoria{
        //El método acepta tres parámetros: $tabla, $item y $valor.
        //El parámetro $tabla especifica el nombre de la tabla de la base de datos a consultar. El parámetro $item especifica el nombre de la columna que se utilizará como filtro en la consulta y el parámetro $valor especifica el valor que se utilizará como filtro.
        static public function mdlShowAuditProduct($tabla, $item, $valor){
            
            //Si el parámetro $item no se proporciona (es decir, es null), el método recuperará todos los registros de la tabla especificada por $tabla.
            //devuelve el conjunto de resultados como un array utilizando el método fetch() o fetchAll(), dependiendo de si $item es null.
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

            $sentenciaSQL = null;//el método cierra la conexión con la base de datos y establece la variable $sentenciaSQL en null para liberar recursos.

        }

    }  

?>