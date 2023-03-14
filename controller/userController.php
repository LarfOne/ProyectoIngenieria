<?php
    class ControllerUser{
        

        static public function ctrNameUser($cedula){
            
            $respuesta = User::mdlNameUser($cedula);
            return $respuesta;

        }

        public function ctrLoginUser(){

            if(isset($_POST["ingUser"])){
                
                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUser"]) &&
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
                    
                    $tabla = "empleado";

                    $item = "nombre";

                    $valor = $_POST["ingUser"];

                    $incrypt = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

                    $respuesta = User::mdlShow($tabla, $item, $valor);




                    if($respuesta != null){


                    if(($respuesta["nombre"] == $_POST["ingUser"]) && ($respuesta["password"] == $incrypt)){

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["cedula"] = $respuesta["cedula"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["apellidos"] = $respuesta["apellidos"];
						$_SESSION["role"] = $respuesta["role"];
                        $_SESSION["idSucursal"] = $respuesta["idSucursal"];
                        $_SESSION["email"] = $respuesta["email"];
                        $_SESSION["image"] = $respuesta["image"];
                        
                        echo '<script>
                                window.location = "inicio"
                            </script>';
                        
                    }else{
                        echo '<br><div class="alert alert-danger">ERROR al ingresar, vuelve a intentarlo</div>';
                    }
                }else{
                    echo '<br><div class="alert alert-danger">ERROR al ingresar, vuelve a intentarlo</div>';
                }
                }

            }
        }

        /**REGISTRO DE EMPLEADOS */
        static public function ctrCreateUser(){
            if(isset($_POST["idUser"])){

                if(preg_match('/^[0-9]+$/', $_POST["idUser"]) && 
                   preg_match('/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["nameUser"]) &&
                   preg_match('/^[a-zA-Z-Z0-9]+$/', $_POST["passwordUser"])){

                    $table = "empleado";

                    $incrypt = crypt($_POST["passwordUser"], '$2a$07$usesomesillystringforsalt$');
                    
                    $ruta = null;
                    
                    if(isset($_FILES["image"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["image"]["tmp_name"]);

                        //var_dump($_FILES["image"]["tmp_name"]);

                        $directorio = "imagen/".$_POST["idUser"];

                        mkdir($directorio, 0755);

                        if($_FILES["image"]["type"] == "image/jpeg"){
                            
                            $ruta = "imagen/".$_POST["idUser"]."/".$_FILES["image"]["name"];
                        
                            $origen = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["image"]["type"] == "image/png"){
                            
                            $ruta = "imagen/".$_POST["idUser"]."/".$_FILES["image"]["name"];
                        
                            $origen = imagecreatefrompng($_FILES["image"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagepng($destino, $ruta);
                        }
                        

                    }

                                    $datas = array("cedula" => $_POST["idUser"], 
                                    "nombre" => $_POST["nameUser"], 
                                    "password" => $incrypt,
                                    "apellidos" => $_POST["lastNameUser"],
                                    "email" => $_POST["emailUser"],
                                    "role" => $_POST["roleUser"],
                                    "cuentaBancaria" => $_POST["cuentaUser"],
                                    "idSucursal" => $_POST["sucursalUser"],
                                    "direccion" => $_POST["directionUser"],
                                    "image" =>$ruta);
  
                                    $respuesta = User::mdlAdd($table, $datas);

                                    if($respuesta == "ok"){
                                        echo "<script>
                                        
                                            Swal.fire({
                                                title: 'El usuario se agrego correctamente',
                                                icon: 'success',
                                            }).then((result) => {
                                                window.location = 'users';
                                            })
                
                                        </script>";
                                    }else{

                                        echo "<script>
                                        
                                        Swal.fire({
                                            title: 'No se puede agregar el usuario',
                                            icon: 'error',
                                        }).then((result) => {
                                            window.location = 'users';
                                        })
                                        </script>";
                                    }
                }
            }
        }

        static public function ctrShowUser($item, $valor){

            $tabla = "empleado";
            
            $respuesta = User::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateUser(){

            if(isset($_POST["idUserm"])){

                if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["idUserm"])){

                    $table = "empleado";


                    /**FOTO AL MODIFICAR */

                    $ruta = $_POST["fotoActual"];

                    if(isset($_FILES["imageUpdate"]["tmp_name"]) && !empty($_FILES["imageUpdate"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["imageUpdate"]["tmp_name"]);

                        //var_dump($_FILES["image"]["tmp_name"]);

                        $directorio = "imagen/".$_POST["idUserm"];

                        /**VER SI HAY UNA FOTO EN LA BASE DE DATOS */

                        if(!empty($_POST["fotoActual"])){
                            unlink($_POST["fotoActual"]);
                        }else{
                            mkdir($directorio, 0755);
                        }

                        

                        if($_FILES["imageUpdate"]["type"] == "image/jpeg"){
                            
                            $ruta = "imagen/".$_POST["idUserm"]."/".$_FILES["imageUpdate"]["name"];
                        
                            $origen = imagecreatefromjpeg($_FILES["imageUpdate"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["imageUpdate"]["type"] == "image/png"){
                            
                            $ruta = "imagen/".$_POST["idUserm"]."/".$_FILES["imageUpdate"]["name"];
                        
                            $origen = imagecreatefrompng($_FILES["imageUpdate"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagepng($destino, $ruta);
                        }
                        

                    }


                    /**CAMBIAR CONTRASEÑA */

                    if($_POST["passwordUserm"] != ""){
                        $incrypt = crypt($_POST["passwordUserm"], '$2a$07$usesomesillystringforsalt$');
                    }else{
                        $incrypt = $_POST["passwordActual"];
                    }

                    $datas = array("cedula" => $_POST["idUserm"], 
                                    "nombre" => $_POST["nameUserm"], 
                                    "password" =>  $incrypt,    
                                    "apellidos" => $_POST["lastNameUserm"],
                                    "email" => $_POST["emailUserm"],
                                    "role" => $_POST["roleUserm"],
                                    "cuentaBancaria" => $_POST["cuentaUserm"],
                                    "idSucursal" => $_POST["sucursalUserm"],
                                    "direccion" => $_POST["directionUserm"],
                                    "image" =>$ruta);

                    $respuesta = User::mdlUpdate($table, $datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'El usuario se modifico correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'users';
                            })
                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede modificar el usuario',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'users';
                    })
                    </script>";
                }
            }
        }

        static public function ctrDeleteUser(){

            if(isset($_GET["idEmpleadoE"])){

                $table = "empleado";
                $data = $_GET["idEmpleadoE"];
                
                $respuesta = User::mdlDelete($table, $data);
                //$respuesta = User::mdlPrueba($data);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'El usuario se eliminó correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'users';
                            }
                            
                        })
                    </script>";

                }
            
            }
            
            
        }
    }
    


?>  