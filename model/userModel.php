<?php

    require_once "conexion.php";

    class User{   
        
        static public function mdlNameUser($valor){
            //SELECT nombre FROM `sucursal` WHERE codigo = 1
    
            $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM empleado WHERE cedula= :cedula");
    
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

            $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (cedula, idSucursal, nombre, apellidos, email,
                                                                                role, password, cuentaBancaria, direccion, estado, image) VALUES
                                                                                (:cedula, :idSucursal, :nombre, :apellidos, :email,
                                                                                :role, :password, :cuentaBancaria, :direccion, :estado, :image)");

            $sentenciaSQL->bindParam(':cedula', $datas["cedula"], PDO::PARAM_STR);
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


            if($sentenciaSQL->execute()){
                
                return "ok";
            }else{
                return "error";
            }

            $sentenciaSQL -> close();

            $sentenciaSQL = null;

        }

        static public function mdlRead(){
            $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM empleado");
            $sentenciaSQL->execute();
            $listaEmpleados=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            return $listaEmpleados;

        }

        static public function mdlUpdate($table, $datas){

            $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET idSucursal = :idSucursal, nombre = :nombre, apellidos = :apellidos, email = :email,
                                                            role = :role, password = :password, cuentaBancaria = :cuentaBancaria, direccion = :direccion, estado = :estado, image = :image WHERE cedula = :cedula");
            
            
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

        static public function mdlDelete($table, $data){

            $sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $table WHERE cedula = :cedula");
            $sentenciaSQL -> bindParam(':cedula', $data, PDO::PARAM_INT);

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