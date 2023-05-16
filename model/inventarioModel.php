<?php

    require_once "conexion.php";

        class Inventario{
                                                    //inventario, cantidad, resta, codigo
            static public function actualizarStockProducto($tabla, $item1, $valor1, $valor){
                //recibe cuatro parámetros: $tabla, que es el nombre de la tabla en la base de datos a actualizar; $item1, que es el nombre de la columna en la que se actualizará el valor; $valor1, que es el nuevo valor que se actualizará en la columna; y $valor, que es el valor que se utilizará para filtrar las filas en la tabla.
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE codigo = :codigo");

                $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
                $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
                //retorna un string que indica si la actualización se realizó con éxito ("ok") o si ocurrió un error ("error")
                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return "error";	

                }

                $stmt -> close();

                $stmt = null;

            }

            static public function mdlShowInventario($tabla, $item, $valor){
                //$tabla: una cadena que indica el nombre de la tabla ,
                //$item: una cadena que indica el nombre de la columna de la tabla 
                //$valor: el valor que se va a buscar en la columna especificada por $item.
                
                
                //Si se utiliza un valor para $item, la función devuelve un solo registro, mientras que si se establece como null, 
                //se devolverán todos los registros de la tabla
                if($item != null){
                    
                    $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                    
                    $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                    
                    $sentenciaSQL -> execute();
                    
                    return $sentenciaSQL -> fetch();
                    
                }else{
                    $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla");

                    $sentenciaSQL -> execute();

                    return $sentenciaSQL -> fetchAll();

                    $sentenciaSQL -> close();

                    $sentenciaSQL = null;
                }
                
            }

            static public function codigoInventarioPorProducto($tabla, $item, $valor){
                //recibe tres parámetros: $tabla que indica el nombre de la tabla en la base de datos, $item que es el nombre de la columna que se desea buscar en la tabla y 
                //$valor que es el valor que se busca en la columna $item.
                $sentenciaSQL = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                    
                $sentenciaSQL -> bindParam(":".$item, $valor, PDO::PARAM_INT);
                    
                $sentenciaSQL -> execute();
                    
                return $sentenciaSQL -> fetch();// retorna la fila correspondiente a la búsqueda realizada en forma de un arreglo
            }

            static public function mdlAdd($table, $datas){
                //$table: una cadena de caracteres que indica el nombre de la tabla 
                //$datas: un array asociativo que contiene los datos a agregar en la tabla.
                $sentenciaSQL = Conexion::conectar()->prepare("INSERT INTO $table (codigo, idSucursal, idProducto, cantidad) VALUES
                                                                                    (:codigo, :idSucursal, :idProducto, :cantidad)");

                $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':idProducto', $datas["idProducto"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':cantidad', $datas["cantidad"], PDO::PARAM_STR);

                $sentenciaSQL->execute();

            }

            /*static public function mdlRead(){
                $sentenciaSQL= Conexion::conectar()->prepare("SELECT * FROM empleado");
                $sentenciaSQL->execute();
                $listaEmpleados=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

                return $listaEmpleados;

            }*/

            static public function mdlUpdateInventario($table, $datas){
                // recibe dos parámetros: el nombre de la tabla a actualizar y los datos a actualizar en forma de un array asociativo $datas
                $sentenciaSQL = Conexion::conectar()->prepare("UPDATE $table SET idSucursal = :idSucursal, idProducto = :idProducto, cantidad = :cantidad WHERE codigo = :codigo");
                
                $sentenciaSQL->bindParam(':idSucursal', $datas["idSucursal"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':idProducto', $datas["idProducto"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':cantidad', $datas["cantidad"], PDO::PARAM_STR);
                $sentenciaSQL->bindParam(':codigo', $datas["codigo"], PDO::PARAM_STR);
                //retorna un string "ok" si la ejecución de la sentencia fue exitosa, y un string "error" si ocurrió algún error. 
                if($sentenciaSQL->execute()){
                    
                    return "ok";
                }else{
                    return "error";
                }

                $sentenciaSQL -> close();

                $sentenciaSQL = null;

            }

            static public function mdlDelete($table, $data){
                // parámetros: el nombre de la tabla y el valor del código del registro que se eliminará
                $sentenciaSQL = Conexion::conectar()->prepare("DELETE FROM $table WHERE codigo = :codigo");
                $sentenciaSQL -> bindParam(':codigo', $data, PDO::PARAM_INT);
                //Retorna una cadena "ok" si la eliminación fue exitosa y "error" si no lo fue.
                if($sentenciaSQL->execute()){
                    return "ok";
                }else{
                    return "error";
                }

                $sentenciaSQL -> close();

                $sentenciaSQL = null;


            }




            static public function mdlMostrarCantidadProductosInventario($tabla, $item){
        // recibe el nombre de una tabla ($tabla) y el nombre de una columna ($item) opcionalmente. 
            
                if($item != null){
        
                    $stmt = Conexion::conectar()->prepare("SELECT COUNT(DISTINCT $item)  FROM $tabla");
        
                
                    $stmt -> execute();
        
                    return $stmt -> fetchAll();
        
                }else{
        
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");
        
                    $stmt -> execute();
                    return $stmt -> fetchAll();//La función retorna un arreglo con los resultados obtenidos de la base de datos.
                }
                
                $stmt -> close();
                $stmt = null;
            
        }
    }

?>