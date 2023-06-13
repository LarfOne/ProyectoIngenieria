
<?php

require_once "conexion.php";

class Client{


	static public function mdlNameClient($valor){
       //mdlNameClient() recibe como parámetro el valor de la cédula de un cliente a buscar en la tabla "cliente" de la base de datos.

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM cliente WHERE cedula = :cedula");

        $sentenciaSQL -> bindParam(":cedula", $valor, PDO::PARAM_STR);

        $sentenciaSQL -> execute();
        // retorna la información del cliente encontrado, en caso de existir, o retorna NULL en caso contrario.
        return $sentenciaSQL -> fetch();
    }

    static public function mdlShow($tabla, $item, $valor){
        //mdlShow recibe tres parámetros: $tabla que es el nombre de la tabla a consultar, 
        //$item que es el nombre del campo por el cual se desea filtrar la consulta (puede ser null si no se desea filtrar) y $valor que es el valor que se desea buscar en el campo especificado por $item.
        if($item != null){
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

            $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetch();
        
        }else{
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $sentenciaSQL -> execute();

            return $sentenciaSQL -> fetchAll();// retorna un arreglo con todos los resultados obtenidos mediante el método fetchAll().
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;
        
    }

		static public function mdlAddCli($table, $datas){
            // "mdlAddCli" recibe dos parámetros: el nombre de una tabla en la base de datos y un arreglo asociativo con los datos de un cliente
				$sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table(cedula,nomCliente,telefonoCli,email, direccion) VALUES (:cedula, :nomCliente, :telefonoCli, :email, :direccion)");

				$sentenciaSQL->bindParam(":cedula", $datas["cedula"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":nomCliente", $datas["nomCliente"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":telefonoCli", $datas["telefonoCli"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":email", $datas["email"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":direccion", $datas["direccion"], PDO::PARAM_STR);
				// retorna "ok" si la operación se realiza correctamente, o "error" si hay algún problema en la ejecución
                if($sentenciaSQL->execute()){
					return "ok";
				}else{
					return "error";
				
				}
				$sentenciaSQL->close();
				$sentenciaSQL = null;

			}


    static public function mdlRead(){
        $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM cliente");
        $sentenciaSQL->execute();
        $listaCliente=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        return $listaCliente;//devuelve un array asociativo con los datos de todos los registros de la tabla. 

    }

    static public function mdlUpdate($table, $datas){
        //"mdlUpdate" recibe como parámetros el nombre de la tabla a actualizar y los datos a actualizar
        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET  nomCliente = :nomCliente,
                                                        telefonoCli = :telefonoCli, email = :email , direccion = :direccion WHERE cedula = :cedula");
        
        
        $sentenciaSQL->bindParam(':cedula', $datas["cedula"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':nomCliente', $datas["nomCliente"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':telefonoCli', $datas["telefonoCli"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':email', $datas["email"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(':direccion', $datas["direccion"], PDO::PARAM_STR);
        //Si la consulta se ejecuta correctamente, la función devuelve "ok", de lo contrario devuelve "error". 
        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();
        $sentenciaSQL = null;

    }


	static public function mdlDeleteClient($tabla, $data){
        //tabla es un string que indica la tabla de la base de datos donde se desea eliminar un registro.
        //data es un entero que representa el valor de la cédula del cliente
		$sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cedula = :cedula");

		$sentenciaSQL -> bindParam(":cedula", $data, PDO::PARAM_INT);
        // retorna un string que indica si la eliminación del registro fue exitosa o si se produjo un error.
		if($sentenciaSQL -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$sentenciaSQL -> close();

		$sentenciaSQL = null;

	}
    //"mdlMostrarCantidadCliente" recibe dos parámetros: el nombre de la tabla a la que se hace referencia en la consulta SQL, y el nombre del campo cuya cantidad de valores distintos se desea contar.
    static public function mdlMostrarCantidadCliente($tabla, $item){
        ////se devuelve el resultado en un arreglo.
		//Si el segundo parámetro es nulo, entonces se seleccionan todas las filas de la tabla especificada y se devuelven en un arreglo
        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(DISTINCT $item)  FROM $tabla");

           
            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }
        
        $stmt -> close();

        $stmt = null;

    

}


}