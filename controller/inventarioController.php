<?php
    class ControllerInventario{
        // recibe dos parámetros: $item y $valor. Estos parámetros son utilizados para filtrar la búsqueda de elementos en la tabla inventario de la base de datos.
        
        static public function ctrShowInventario($item, $valor){

            $tabla = "inventario";
            //mdlShowInventario es responsable de realizar la consulta SQL en la base de datos y devolver el resultado.
            $respuesta = Inventario::mdlShowInventario($tabla, $item, $valor);
            //el resultado se devuelve a través de la variable $respuesta.
            return $respuesta;
        }
         //buscar el código de inventario de un producto en particular, según un valor de búsqueda proporcionado
        static public function ctrCodigoInventarioPorProducto($item, $valor){

            $tabla = "inventario";
            //codigoInventarioPorProducto de esa clase, pasándole la tabla en la que buscar y el valor del campo a buscar
            $respuesta = Inventario::codigoInventarioPorProducto($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrCreateInventario()
	    {
            // verifica si se ha enviado el formulario con la información necesaria a través del método POST
            if (isset($_POST["idProducto"])) {

                if(preg_match('/^[0-9]+$/', $_POST["idProducto"])){
            
                    $table = "inventario";
                    //crea un arreglo con los datos necesarios para el nuevo registro, donde se especifica la sucursal, el producto y la cantidad de productos disponibles en esa sucursal

                    $datas = array(
                        "idSucursal" => $_POST["idSucursal"],
                        "idProducto" => $_POST["idProducto"],
                        "cantidad" => $_POST["cantProducto"]
                    );
                    //se llama al método "mdlAdd" del modelo Inventario para insertar el nuevo registro en la base de datos.
                    $respuesta = Inventario::mdlAdd($table, $datas);
                }
            }

	    }

        // se encarga de actualizar el inventario de un producto en una sucursal 
        static public function ctrUpdateInventario(){
            //se verifica si el formulario con los datos necesarios para la actualización ha sido enviado (se verifica si existe la variable POST "codigoInventarioAjuste").
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
                                title: 'El inventario se modifico correctamente',
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
                //mdlDelete" de la clase "Inventario" para eliminar el registro correspondiente de la tabla "inventario"
                
                $respuesta = Inventario::mdlDelete($table, $data);
                //$respuesta = User::mdlPrueba($data);
                //Si la eliminación se realiza correctamente, se muestra un mensaje de confirmación usando la biblioteca Swal.js y se redirige al usuario a la página de inventarios. Si hay algún error,
                // se mostrará un mensaje de error correspondiente.
                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'El inventario se elimino correctamente',
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

                }
            
            }
            
            
        }


         //recibe el parámetro "$item" que indica el campo por el que se desea buscar en la tabla "inventario", en este caso, "idProducto".
        static public function ctrProductosCantidad (){
            $tabla = "inventario";
            $item = "idProducto";
             // "mdlMostrarCantidadProductosInventario" del modelo "Inventario" pasándole los parámetros necesarios
            $respuesta = Inventario::mdlMostrarCantidadProductosInventario($tabla, $item);
            return $respuesta;//array con la cantidad total de cada producto disponible en el inventario.
        }



    }
    


?>