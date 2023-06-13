<?php
    class ControllerUnit{

        /**REGISTRO DE UNIDADES */
        //"ctrCreateUnit" que se encarga de agregar una unidad de medida en la base de datos.
            static public function ctrCreateUnit()
            {
                if(isset($_POST["nameUnit"])){
                    if(preg_match('/^[0-9-a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,60}$/', $_POST["nameUnit"])){
                        //La función recibe los datos enviados desde un formulario HTML mediante el método POST,
                        $table = "unidadmedida";

                        $datas = array("nombre" => $_POST["nameUnit"]);

                        $respuesta = Unit::mdlAddUnit($table, $datas);
                        
                        if($respuesta == "ok"){
                            echo "<script>
                            
                                Swal.fire({
                                    title: 'La unidad de medida se agregó correctamente',
                                    icon: 'success',
                                }).then((result) => {
                                    window.location = 'unidadMedida';
                                })

                            </script>";
                        

                        }else{

                            echo "<script>
                            
                            Swal.fire({
                                title: 'No se puede agregar la unidad de medida',
                                icon: 'error',
                            }).then((result) => {
                                window.location = 'unidadMedida';
                            })
                            </script>";
                        }
                    }
                }
            }
            

        static public function ctrShowUnit($item, $valor){
             //. Estos parámetros son utilizados para realizar una búsqueda en la tabla unidadmedida de la base de datos y devolver el resultado de la búsqueda
            $tabla = "unidadmedida";
            
            $respuesta = Unit::mdlShowUnit($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateUnit(){
            //actualiza una unidad de medida en una base de datos. 

            if(isset($_POST["idUnitm"])){

                if(preg_match('/^[0-9]{1,10}$/', $_POST["idUnitm"])){
                    if(preg_match('/^[0-9-a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,60}$/', $_POST["nameUnitm"])){

                    

                        $table = "unidadmedida";

                        $datas = array("codigo" => $_POST["idUnitm"], 
                                        "nombre" => $_POST["nameUnitm"]);

                        $respuesta = Unit::mdlUpdateUnit($table, $datas);
                        
                        if($respuesta == "ok"){
                            // Si la actualización se realiza correctamente, se muestra un mensaje de éxito
                            echo "<script>
                            
                                Swal.fire({
                                    title: 'La unidad de medida se modificó correctamente',
                                    icon: 'success',
                                }).then((result) => {
                                    window.location = 'unidadMedida';
                                })
                            </script>";
                        }


                        

                    }else{

                        echo "<script>
                        
                        Swal.fire({
                            title: 'No se puede modificar la unidad de medida',
                            icon: 'error',
                        }).then((result) => {
                            window.location = 'unidadMedida';
                        })
                        </script>";
                    }
                }
            }
        }
         //ctrDeleteUnit, que elimina una unidad de medida de la base de datos.
        static public function ctrDeleteUnit(){

            if(isset($_GET["idUnitE"])){

                $table = "unidadmedida";
                $data = $_GET["idUnitE"];
                // llama al método mdlDeleteUnit de la clase Unit para eliminar la unidad de medida de la base de datos. 
                $respuesta = Unit::mdlDeleteUnit($table, $data);

                if($respuesta == "ok"){
                     //Si se eliminó correctamente, se muestra un mensaje de éxito
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La unidad de medida se eliminó correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'unidadMedida';
                            }
                            
                        })
                    </script>";

                }
            
            }
            
            
        }
    }
    


?>