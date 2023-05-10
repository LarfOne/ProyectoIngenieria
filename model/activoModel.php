<?php

require_once "conexion.php";

class Activo{             


    static public function mdlNameActivo($valor){//mdlNameActivo que se encarga de buscar un activo en la base de datos por su código y devolver su información
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

            return $sentenciaSQL -> fetchAll();//devuelve el resultado de la consulta, que es una sola fila que contiene la información del activo buscado
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

    static public function mdlAdd($table, $datas){//recibe dos parámetros: $table, que es la tabla en la base de datos donde se insertarán los datos, y $datas, que es un array asociativo con los datos a insertar.

        $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (idSucursal,descripcion,estado,empleado_id) VALUES
                                                                            (:idSucursal, :descripcion, :estado, :empleado_id )");
                                                                            
        $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':descripcion', $datas["descripcion"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':estado', $datas["estado"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':empleado_id', $datas["empleado_id"], PDO::PARAM_STR);
  


        // se ejecuta la sentencia SQL con execute() y se retorna "ok" si la inserción se realizó correctamente, o "error" si no se pudo realizar.
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }

    static public function mdlRead(){// se encarga de leer y retornar todos los registros de la tabla "activo" de la base de datos.
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
        //La función retorna un string que indica si la actualización se realizó correctamente o si ocurrió un error. Si la actualización se realiza correctamente, la función retorna "ok".
        // Si ocurre un error, retorna "error".
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
        //Si la eliminación es exitosa, la función retorna el string "ok", de lo contrario, retorna el string "error". Finalmente, se cierra la conexión con la base de datos usando close()
        // y se establece la variable $sentenciaSQL en null.
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