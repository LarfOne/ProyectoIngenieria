<?php
    class ControllerUnit{

        /**REGISTRO DE UNIDADES */
        //"ctrCreateUnit" que se encarga de agregar una unidad de medida en la base de datos.
            static public function ctrCreateUnit()
            {
                    //La función recibe los datos enviados desde un formulario HTML mediante el método POST,
                    $table = "unidadmedida";

                    $datas = array("codigo" => $_POST["idUnit"], 
                                    "nombre" => $_POST["nameUnit"]);
                // llama a la función "mdlAddUnit" de la clase "Unit" 
                //para insertar los datos en la tabla correspondiente en la base de datos.
                    $respuesta = Unit::mdlAddUnit($table, $datas);
                    //Si la inserción es exitosa, se muestra un mensaje de éxito utilizando la librería de JavaScript "SweetAlert" y se redirige al usuario a la página de productos. Si ocurre algún error, se muestra un mensaje de error utilizando la misma librería 
                    //y se redirige al usuario a la página de productos.
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La unidad de medida se agrego correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'products';
                            })

                        </script>";
                    

                    }else{

                        echo "<script>
                        
                        Swal.fire({
                            title: 'No se puede agregar la unidad de medida',
                            icon: 'error',
                        }).then((result) => {
                            window.location = 'products';
                        })
                        </script>";
                    }
            }
            
            //recibe dos parámetros: $item y $valor
        static public function ctrShowUnit($item, $valor){
             //. Estos parámetros son utilizados para realizar una búsqueda en la tabla unidadmedida de la base de datos y devolver el resultado de la búsqueda
            $tabla = "unidadmedida";
            
            $respuesta = Unit::mdlShowUnit($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateUnit(){
            //actualiza una unidad de medida en una base de datos. 

            if(isset($_POST["idUnitm"])){

                if(preg_match('/^[0-9]+$/', $_POST["idUnitm"])){

                    $table = "unidadmedida";

                    $datas = array("codigo" => $_POST["idUnitm"], 
                                    "nombre" => $_POST["nameUnitm"]);
                    //se llama a un método de la clase Unit para actualizar la unidad de medida en la base de datos
                    $respuesta = Unit::mdlUpdateUnit($table, $datas);
                    
                    if($respuesta == "ok"){
                        // Si la actualización se realiza correctamente, se muestra un mensaje de éxito
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La unidad de medida se modifico correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'products';
                            })
                        </script>";
                    }


                    

                }else{
                    // Si el ID de la unidad de medida no es un número, se muestra un mensaje de error 
                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede modificar la unidad de medida',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'products';
                    })
                    </script>";
                }
            }
        }
         //ctrDeleteUnit, que elimina una unidad de medida de la base de datos.
        static public function ctrDeleteUnit(){
            //verifica si se ha enviado un parámetro idUnitE a través de una solicitud GET
            if(isset($_GET["idUnitE"])){

                $table = "unidadmedida";
                $data = $_GET["idUnitE"];
                // llama al método mdlDeleteUnit de la clase Unit para eliminar la unidad de medida de la base de datos. 
                $respuesta = Unit::mdlDeleteUnit($table, $data);

                if($respuesta == "ok"){
                     //Si se eliminó correctamente, se muestra un mensaje de éxito
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La unidad de medida se elimino correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'products';
                            }
                            
                        })
                    </script>";

                }
            
            }
            
            
        }
    }
    


?>