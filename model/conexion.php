<?php

    class Conexion{
        // "Conexion", que se utiliza para establecer una conexión a una base de datos MySQL
        public $conexion;

        public static function conectar(){//obtiene una instancia de la conexión

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
        function cerrar(){//método "cerrar" que se utiliza para cerrar la conexión a la base de datos,

         $this->conexion->close();

        }


    }

?>