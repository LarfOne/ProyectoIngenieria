<?php

    require_once "conexion.php";

    class Unit{             
        //mdlShowUnit recibe tres parámetros: $tabla, $item y $valor. La variable $tabla indica la tabla de la base de datos en la que se desea hacer la consulta. La variable
        // $item representa el nombre del campo de la tabla que se desea consultar
        static public function mdlShowUnit($tabla, $item, $valor){
            //devuelve una fila de la tabla de la base de datos que coincide con el valor proporcionado en $valor y $item
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

        static public function mdlAddUnit($table, $datas){
            // recibe dos parámetros: $table, que indica la tabla en la base de datos a la que se agregarán los datos, 
            //y $datas, que es un arreglo asociativo que contiene los valores que se agregarán a la tabla 
            $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (nombre) VALUES (:nombre)");
            $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);
            //Si se ejecuta sin errores, devuelve "ok", de lo contrario, devuelve "error".
            if($sentenciaSQL->execute()){
                
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;

        }
        //mdlReadUnit no recibe ningún parámetro. Devuelve un array asociativo con los datos de todas las categorías almacenadas en la tabla categoria.
        static public function mdlReadUnit(){
            $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM categoria");
            $sentenciaSQL->execute();
            $listaEmpleados=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            return $listaEmpleados;

        }
        //mdlUpdateUnit recibe como parámetros el nombre de la tabla ($table) y un arreglo con los datos a actualizar ($datas), que incluye el código de la unidad a actualizar ($datas["codigo"])
        // y el nuevo nombre de la unidad ($datas["nombre"]).
        static public function mdlUpdateUnit($table, $datas){

            $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre WHERE codigo = :codigo");
            
            $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);

            $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
            //La función devuelve un string indicando si la operación se realizó correctamente o no: "ok" en caso de éxito y "error" en caso contrario.
            if($sentenciaSQL->execute()){
                
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;

        }
        //mdlDeleteUnit recibe dos parámetros: $table, que es el nombre de la tabla de la que se eliminará un registro, y $data,
        // que es el valor del campo "codigo" del registro que se desea eliminar
        static public function mdlDeleteUnit($table, $data){

            $sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $table WHERE codigo = :codigo");
            $sentenciaSQL -> bindParam(':codigo', $data, PDO::PARAM_INT);
            //La función devuelve una cadena de texto indicando si la eliminación se realizó correctamente ("ok") o si ocurrió un error ("error").
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