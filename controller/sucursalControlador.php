<?php
    class ControllerSucursal{


        static public function ctrNameSucursal($codigo){
            
            $respuesta = Sucursal::mdlNameSucursal($codigo);
            return $respuesta;

        }

        /**REGISTRO DE SUCURSALES */
        static public function ctrCreateSucursal(){
            if(isset($_POST["idSucursal"])){

                if(preg_match('/^[0-9]+$/', $_POST["idSucursal"]) && 
                   preg_match('/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["nameSucursal"]) 
                   ){

                    $table = "sucursal";

                   

                    $datas = array("codigo" => $_POST["idSucursal"], 
                                    "nombre" => $_POST["nameSucursal"], 
                                    "direccion" => $_POST["direccionSucursal"],
                                    "telefono" => $_POST["telefonoSucursal"],
                                    "email" => $_POST["emailSucursal"]
                                    );

                    $respuesta = Sucursal::mdlAdd($table, $datas);
                    
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

        static public function ctrShowSucursal($item, $valor){

            $tabla = "sucursal";
            
            $respuesta = Sucursal::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateSucursal(){

            if(isset($_POST["idSucursalm"])){

                if(preg_match('/^[0-9]+$/', $_POST["idSucursalm"])){

                    $table = "sucursal";

                    $datas = array("codigo" => $_POST["idSucursalm"], 
                                    "nombre" => $_POST["nameSucursalm"], 
                                    "direccion" => $_POST["direccionSucursalm"],
                                    "telefono" => $_POST["telefonoSucursalm"],
                                    "email" => $_POST["emailSucursalm"]);

                    $respuesta = Sucursal::mdlUpdate($table, $datas);
                    
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

        static public function ctrDeleteSucursal(){

            if(isset($_GET["codigoE"])){

                $table = "sucursal";
                $data = $_GET["codigoE"];
                
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
    


?>  