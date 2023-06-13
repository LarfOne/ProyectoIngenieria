<?php
    class ControllerSucursal{

         //mdlNameSucursal de la clase Sucursal para obtener la información correspondiente a la sucursal con el código 
        //proporcionado y devolverla como respuesta
        static public function ctrNameSucursal($codigo){
            
            $respuesta = Sucursal::mdlNameSucursal($codigo);
            return $respuesta;

        }

        /**REGISTRO DE SUCURSALES */
        static public function ctrCreateSucursal(){
            if(isset($_POST["idSucursal"])){

                if(preg_match('/^[0-9]{1,18}$/', $_POST["idSucursal"]) && 
                    preg_match('/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ]{1,45}$/', $_POST["nameSucursal"])){
                        if(preg_match('/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ]{1,45}$/', $_POST["direccionSucursal"])){
                            if(preg_match('/^[0-9]{1,20}$/', $_POST["telefonoSucursal"])){
                                if(preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $_POST["emailSucursal"])){
                                    
                                        $table = "sucursal";
                                        
                                        $datas = array("codigo" => $_POST["idSucursal"], 
                                                        "nombre" => $_POST["nameSucursal"], 
                                                        "direccion" => $_POST["direccionSucursal"],
                                                        "telefono" => $_POST["telefonoSucursal"],
                                                        "email" => $_POST["emailSucursal"]
                                                        );

                                        $respuesta = Sucursal::mdlAdd($table, $datas);
                                        //Si todo sale bien, se muestra un mensaje de éxito utilizando la biblioteca SweetAlert y se redirige al usuario a la página de sucursales. Si los valores no son válidos, se muestra un mensaje de error similar y se redirige al usuario a la página de sucursales
                                        if($respuesta == "ok"){
                                            echo "<script>
                                            
                                                Swal.fire({
                                                    title: 'La Sucursal se agregó correctamente',
                                                    icon: 'success',
                                                }).then((result) => {
                                                    window.location = 'sucursal';
                                                })

                                            </script>";
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
                        }
                    }
                    
            }
        }

        static public function ctrShowSucursal($item, $valor){

            $tabla = "sucursal";
            
            $respuesta = Sucursal::mdlShow($tabla, $item, $valor);
            return $respuesta;//respuesta es un arreglo de objetos que contiene la información de la sucursal buscada
        }
        //ctrUpdateSucursal se encarga de actualizar la información de una sucursal en la base de datos
        static public function ctrUpdateSucursal(){

            if(isset($_POST["idSucursalm"])){

                if(preg_match('/^[0-9]{1,18}$/', $_POST["idSucursalm"]) && 
                    preg_match('/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ]{1,45}$/', $_POST["nameSucursalm"])){
                        if(preg_match('/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ]{1,45}$/', $_POST["direccionSucursalm"])){
                            if(preg_match('/^[0-9]{1,20}$/', $_POST["telefonoSucursalm"])){
                                if(preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $_POST["emailSucursalm"])){
                                    //Los datos a actualizar se guardan en un arreglo $datas
                                                            
                                    $table = "sucursal";

                                    $datas = array("codigo" => $_POST["idSucursalm"], 
                                                    "nombre" => $_POST["nameSucursalm"], 
                                                    "direccion" => $_POST["direccionSucursalm"],
                                                    "telefono" => $_POST["telefonoSucursalm"],
                                                    "email" => $_POST["emailSucursalm"]);

                                    $respuesta = Sucursal::mdlUpdate($table, $datas);
                                    //Si la actualización fue exitosa, se muestra un mensaje de éxito y se redirige al 
                                    //usuario a la página de sucursales. Si no se pudo actualizar, se muestra un mensaje de error y se redirige al usuario a la misma página
                                    if($respuesta == "ok"){
                                        echo "<script>
                                        
                                            Swal.fire({
                                                title: 'La Sucursal se modificó correctamente',
                                                icon: 'success',
                                            }).then((result) => {
                                                window.location = 'sucursal';
                                            })
                                        </script>";
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
                    }
                }
            }

        }

         // eliminación de una sucursal de la base de datos
        static public function ctrDeleteSucursal(){

            if(isset($_GET["codigoE"])){

                $table = "sucursal";
                $data = $_GET["codigoE"];
                //llama a la función "mdlDelete" de la clase "Sucursal" para eliminar la sucursal de la tabla "sucursal". Si la respuesta es "ok",
                // se muestra un mensaje de éxito utilizando la biblioteca "SweetAlert". Si la respuesta no es "ok", se muestra un mensaje de error utilizando la misma biblioteca
                
                $respuesta = Sucursal::mdlDelete($table, $data);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La Sucursal se eliminó correctamente',
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
    


?>  