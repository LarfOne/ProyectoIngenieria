<?php

    class Conexion{

        public $conexion;

        public static function conectar(){

            $host="localhost";
            $bd="proyectoinventario";
            $usuario="root";
            $contrasena="";

            try {
                
                $conexion=new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasena);

            } catch (Exception $ex) {
                echo $ex->getMessage();
            }

            return $conexion;
        }
        function cerrar(){

         $this->conexion->close();

        }


    }

?>