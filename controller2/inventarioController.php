<?php
    class ControllerInventario{
        // recibe dos parámetros: $item y $valor. Estos parámetros son utilizados para filtrar la búsqueda de elementos en la tabla inventario de la base de datos.
        
        static public function ctrShowInventario($item, $valor){

            $tabla = "inventario";
            
            $respuesta = Inventario::mdlShowInventario($tabla, $item, $valor);
            return $respuesta;
        }
         //buscar el código de inventario de un producto en particular, según un valor de búsqueda proporcionado
        static public function ctrCodigoInventarioPorProducto($item, $valor){

            $tabla = "inventario";
            //codigoInventarioPorProducto de esa clase, pasándole la tabla en la que buscar y el valor del campo a buscar
            $respuesta = Inventario::codigoInventarioPorProducto($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateInventario(){

            if(isset($_POST["codigoInventarioAjuste"])){

                    $table = "inventario";
                    $nuevaCantidad = intval($_POST["existenciaAjuste"]) + intval($_POST["cantProductoAjuste"]);
                     //array con los nuevos datos del inventario, que consisten en el código del inventario a modificar
                    $datas = array("codigo" => $_POST["codigoInventarioAjuste"], 
                                    "idSucursal" => $_POST["idSucursalAjuste"], 
                                    "idProducto" =>  $_POST["idProductoAjuste"],    
                                    "cantidad" => $nuevaCantidad);
                        // llama al método "mdlUpdateInventario" de la clase "Inventario" para realizar la actualización en la base de datos
                    $respuesta = Inventario::mdlUpdateInventario($table, $datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'El inventario se modificó correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'inventarios';
                            })
                        </script>";
                    }
            }
        }

        static public function ctrDeleteInventario(){
            // verifica si el parámetro "codigoInventarioE" se ha establecido en la URL 
            //usando $_GET

            if(isset($_GET["codigoInventarioE"])){

                $table = "inventario";
                $data = $_GET["codigoInventarioE"];
                echo ("DICEEEEEN");
                //mdlDelete" de la clase "Inventario" para eliminar el registro correspondiente de la tabla "inventario"
                
                $respuesta = Inventario::mdlDelete($table, $data);
                //$respuesta = User::mdlPrueba($data);

                if($respuesta == "ok"){
                    
                    echo "<script>
                    
                        Swal.fire({
                            title: 'El inventario se eliminó correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'inventarios';
                            }
                            
                        })
                    </script>";

                }else{
                    echo "<script>
                    
                        Swal.fire({
                            title: 'El inventario se eliminó correctamente',
                            showConfirmButton: error,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'inventarios';
                            }
                            
                        })
                    </script>";
                }
            
            }
            
            
        }


         //recibe el parámetro "$item" que indica el campo por el que se desea buscar en la tabla "inventario", en este caso, "idProducto".
        static public function ctrProductosCantidad (){
            $tabla = "inventario";
            $item = "idProducto";
             // "mdlMostrarCantidadProductosInventario" del modelo "Inventario" pasándole los parámetros necesarios
            $respuesta = Inventario::mdlMostrarCantidadProductosInventario($tabla, $item);
            return $respuesta;
        }



    }
    


?>