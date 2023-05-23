<?php

    require_once "conexion.php";

class User{   
        
        /**
         * Obtener todos los datos de un usuario
         * 
         * @param recibe como parametro el identificador del usuario que se consulta
         * 
         * @return retorna una fila de todos los datos del usuario
        */

        static public function mdlNameUser($valor){
            //SELECT nombre FROM `sucursal` WHERE codigo = 1
    
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM empleado WHERE cedula= :cedula");
    
            $sentenciaSQL -> bindParam(":cedula", $valor, PDO::PARAM_STR);
    
            $sentenciaSQL -> execute(); 
    
            return $sentenciaSQL -> fetch();
        }
        
        
        /**
         * Muestra todos los datos de un usuario o muestra todos los datos de todos los usuarios
         * 
         * 
         * @param recibe como parametro la tabla para consultar los datos de los usuarios, recibe un 
         * item que es el identificador del usuario y recibe el valor que es el dato del identificador 
         * 
         * 
         * @return retorna una fila de todos los datos del usuario o retorna todos 
         * los datos de todos los usuarios
         * 
        */

        static public function loginUser($name){
            $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_login(:name)");
            $sentenciaSQL -> bindParam(":name", $name, PDO::PARAM_STR);
            $sentenciaSQL -> execute();
            return $sentenciaSQL -> fetch();
        }

        static public function mdlShow($item, $valor){
            if($item != null){
                $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_obtener_empleado(:cedula)");
                $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_INT);
                $sentenciaSQL -> execute();
                return $sentenciaSQL -> fetch();
            
            }else{
                $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM vista_empleado");
                $sentenciaSQL -> execute();
                return $sentenciaSQL -> fetchAll();
            }
            $sentenciaSQL -> close();

            $sentenciaSQL = null;
            
        }

        /**
         * agregar todos los datos de un usuario
         * 
         * @param recibe un array llamado datas con todos los datos de un usuario y recibe la en 
         * en la que se va a agregar
         * 
         * @return retorna un OK si los datos se agregaron correctamente o un error si los 
         * datos no se agregaron
        */

        static public function mdlAdd($datas){

            $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_insertar_empleado(:cedula, :idSucursal, :nombre, :apellidos, :email, :role, :password, :cuentaBancaria, :direccion, :estado, :image)");
            $sentenciaSQL->bindParam(':cedula', $datas["cedula"], PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':apellidos', $datas["apellidos"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':email', $datas["email"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':cuentaBancaria', $datas["cuentaBancaria"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':direccion', $datas["direccion"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':estado', $datas["estado"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':role', $datas["role"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':password', $datas["password"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':image', $datas["image"], PDO::PARAM_STR);

            if($sentenciaSQL->execute()){
                
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;

        }

        /**
         * Obtener todos los datos de un usuario
         * 
         * @param recibe el identificador del usuario que se consulta
         * 
         * @return retorna una fila de todos los datos del usuario
        */

        static public function mdlRead(){
            $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM empleado");
            $sentenciaSQL->execute();
            $listaEmpleados=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            return $listaEmpleados;

        }


        /**
         * Obtener todos los datos de un usuario
         * 
         * @param recibe el identificador del usuario que se consulta
         * 
         * @return retorna una fila de todos los datos del usuario
        */

        static public function mdlUpdate($datas){

            $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_update_empleado(:cedula, :idSucursal, :nombre, :apellidos, :email, 
            :role, :password, :cuentaBancaria, :direccion, :estado, :image)");

            $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':nombre', $datas["nombre"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':apellidos', $datas["apellidos"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':email', $datas["email"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':cuentaBancaria', $datas["cuentaBancaria"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':direccion', $datas["direccion"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':estado', $datas["estado"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':role', $datas["role"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':password', $datas["password"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':image', $datas["image"], PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':cedula', $datas["cedula"], PDO::PARAM_STR);

            if($sentenciaSQL->execute()){
                
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;

        }

        static public function mdlDelete($data){
            try {
                $sentenciaSQL = Conexion::conectar()->prepare("CALL sp_eliminar_empleado_administrador(:cedula)");
                $sentenciaSQL->bindParam(':cedula', $data, PDO::PARAM_INT);
                $sentenciaSQL->execute();
        
                // Obtener el resultado del procedimiento almacenado
                $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        
                $sentenciaSQL->closeCursor();
        
                if ($resultado) {
                    return $resultado['mensaje'];
                } else {
                    return "Error al ejecutar el procedimiento almacenado.";
                }
            } catch (PDOException $e) {
                return "Error en la conexión a la base de datos: " . $e->getMessage();
            }
        }
        
        
        static public function getUserImagePath($cedula)
        {
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT image FROM empleado WHERE  cedula = :cedula");
            $sentenciaSQL->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $sentenciaSQL->execute();

            $imagen = $sentenciaSQL->fetch(PDO::FETCH_COLUMN);

            return $imagen;
        }

}


    

?>