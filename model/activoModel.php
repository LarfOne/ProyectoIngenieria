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

    static public function mdlSpecificShow($tabla, $item, $valor){

        if($item != null){
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();
        }
        $sentenciaSQL -> close();

        $sentenciaSQL = null;
        
    }





    static public function mdlShow($tabla, $item, $valor){
         //recibe tres parámetros: el nombre de la tabla de la base de datos a consultar, un nombre de columna y su valor asociado.
        
        //La función comienza por verificar si el segundo parámetro no es nulo. Si no es nulo, se prepara una consulta SQL que selecciona todos los registros de la tabla donde la columna dada coincide con el valor
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

        return $listaActivo;//que retorna un array con todas las filas resultantes.

        // Finalmente, se retorna la lista de activos.
 

    }


     // recibe tres parámetros: $table, $data y $codigoA. $table
    static public function mdlUpdateEmployer($table, $data,$codigoA){
        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET empleado_id = :empleado_id WHERE codigo = :codigo");
    
        $sentenciaSQL->bindParam(':empleado_id', $data[null], PDO::PARAM_STR);    
        $sentenciaSQL->bindParam(':codigo', $data["codigo"], PDO::PARAM_STR);    
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }





    static public function mdlUpdate($table, $datas){
         // recibe como parámetros el nombre de la tabla a actualizar ($table) y un arreglo de datos a actualizar ($datas)

        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET idSucursal = :idSucursal, descripcion = :descripcion, estado = :estado,
                                                        empleado_id = :empleado_id WHERE codigo = :codigo");
        
        
        $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':descripcion', $datas["descripcion"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':estado', $datas["estado"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':empleado_id', $datas["empleado_id"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
         //la función verifica si la ejecución de la sentencia SQL fue exitosa y retorna "ok" en caso afirmativo o "error" en caso contrario. Además, se cierra la conexión y se limpia la instancia de PDOStatement.
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }

    static public function mdlDelete($table, $data){
        //recibe dos parámetros: $table que es el nombre de la tabla de la cual se quiere eliminar 
        //un registro y $data que es el valor de la clave primaria (en este caso llamada "codigo") del registro que se desea eliminar.

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