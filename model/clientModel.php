
<?php

require_once "conexion.php";

class Client{


	static public function mdlNameClient($valor){
       

        $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM cliente WHERE cedula = :cedula");

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

		static public function mdlAddCli($table, $datas){

				$sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table(cedula,nomCliente,apellidos,telefonoCli,email, direccion) VALUES (:cedula, :nomCliente, :apellidos, :telefonoCli, :email, :direccion)");

				$sentenciaSQL->bindParam(":cedula", $datas["cedula"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":nomCliente", $datas["nomCliente"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":apellidos", $datas["apellidos"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":telefonoCli", $datas["telefonoCli"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":email", $datas["email"], PDO::PARAM_STR);
				$sentenciaSQL->bindParam(":direccion", $datas["direccion"], PDO::PARAM_STR);

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

        return $listaCliente;

    }

    static public function mdlUpdate($table, $datas){

        $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET  nomCliente = :nomCliente, apellidos= :apellidos,
                                                         telefonoCli = :telefonoCli, email = :email , direccion = :direccion WHERE cedula = :cedula");
        
        
        $sentenciaSQL->bindParam(':cedula', $datas["cedula"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':nomCliente', $datas["nomCliente"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':apellidos', $datas["apellidos"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':telefonoCli', $datas["telefonoCli"], PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':email', $datas["email"], PDO::PARAM_STR);
		$sentenciaSQL->bindParam(':direccion', $datas["direccion"], PDO::PARAM_STR);

        if($sentenciaSQL->execute()){
            
            return "ok";
        }else{
            return "error";
        }

        $sentenciaSQL -> close();

        $sentenciaSQL = null;

    }


	static public function mdlDeleteClient($tabla, $data){

		$sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cedula = :cedula");

		$sentenciaSQL -> bindParam(":cedula", $data, PDO::PARAM_INT);

		if($sentenciaSQL -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$sentenciaSQL -> close();

		$sentenciaSQL = null;

	}

}