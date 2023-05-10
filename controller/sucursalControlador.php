<?php
    class ControllerSucursal{

        //mdlNameSucursal de la clase Sucursal para obtener la información correspondiente a la sucursal con el código 
        //proporcionado y devolverla como respuesta
        static public function ctrNameSucursal($codigo){
            //espera un parámetro $codigo, que es el código de la sucursal cuyo nombre se desea obtener.
            // La respuesta es el nombre de la sucursal 
            $respuesta = Sucursal::mdlNameSucursal($codigo);
            return $respuesta;

        }

        /**REGISTRO DE SUCURSALES */
        static public function ctrCreateSucursal(){
            //verificar si se ha enviado una solicitud POST con los datos necesarios para crear una nueva sucursal
            if(isset($_POST["idSucursal"])){

                if(preg_match('/^[0-9]+$/', $_POST["idSucursal"]) && 
                    preg_match('/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["nameSucursal"]) 
                    ){

                    $table = "sucursal";

                
                    //crea un arreglo con los datos de la nueva sucursal y se llama a una función del modelo para agregar la nueva entrada a la base de datos.
                    $datas = array("codigo" => $_POST["idSucursal"], 
                                    "nombre" => $_POST["nameSucursal"], 
                                    "direccion" => $_POST["direccionSucursal"],
                                    "telefono" => $_POST["telefonoSucursal"],
                                    "email" => $_POST["emailSucursal"]
                                    );

                    $respuesta = Sucursal::mdlAdd($table, $datas);
                    //Si todo sale bien, se muestra un mensaje de éxito utilizando la biblioteca SweetAlert y se redirige al usuario a la página de sucursales. Si los valores no son válidos, se muestra un mensaje de error similar y se redirige al usuario a la página de sucursales.
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La Sucursal se agrego correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'sucursal';
                            })

                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede agregar la Sucursal',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'sucursal';
                    })
                    </script>";
                }
            }
        }
        //recibe dos parámetros: $item y $valor. Estos parámetros se utilizan para buscar una sucursal específica en la base de datos.
        static public function ctrShowSucursal($item, $valor){
            $tabla = "sucursal";
            // llama al método mdlShow de la clase Sucursal y le pasa los mismos argumentos.
            $respuesta = Sucursal::mdlShow($tabla, $item, $valor);
            return $respuesta;//respuesta es un arreglo de objetos que contiene la información de la sucursal buscada.
        }

        //ctrUpdateSucursal se encarga de actualizar la información de una sucursal en la base de datos.
        static public function ctrUpdateSucursal(){
            //verifica si existe la variable idSucursalm en el arreglo $_POST, que contiene los datos enviados por el método POST del formulario.
            if(isset($_POST["idSucursalm"])){

                if(preg_match('/^[0-9]+$/', $_POST["idSucursalm"])){
                    //Los datos a actualizar se guardan en un arreglo $datas.
                    $table = "sucursal";

                    $datas = array("codigo" => $_POST["idSucursalm"], 
                                    "nombre" => $_POST["nameSucursalm"], 
                                    "direccion" => $_POST["direccionSucursalm"],
                                    "telefono" => $_POST["telefonoSucursalm"],
                                    "email" => $_POST["emailSucursalm"]);

                    $respuesta = Sucursal::mdlUpdate($table, $datas);
                    //Si la actualización fue exitosa, se muestra un mensaje de éxito y se redirige al 
                    //usuario a la página de sucursales. Si no se pudo actualizar, se muestra un mensaje de error y se redirige al usuario a la misma página.
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La Sucursal se modifico correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'sucursal';
                            })
                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede modificar la Sucursal',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'sucursal';
                    })
                    </script>";
                }
            }
        }
        // eliminación de una sucursal de la base de datos.
        static public function ctrDeleteSucursal(){
            //recibe el parámetro "codigoE" a través de GET
            if(isset($_GET["codigoE"])){

                $table = "sucursal";
                $data = $_GET["codigoE"];
                //llama a la función "mdlDelete" de la clase "Sucursal" para eliminar la sucursal de la tabla "sucursal". Si la respuesta es "ok",
                // se muestra un mensaje de éxito utilizando la biblioteca "SweetAlert". Si la respuesta no es "ok", se muestra un mensaje de error utilizando la misma biblioteca.
                $respuesta = Sucursal::mdlDelete($table, $data);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La Sucursal se elimino correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'sucursal';
                            }
                            
                        })
                    </script>";

                }
            
            }
            
        }
    }
