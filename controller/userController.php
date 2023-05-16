<?php
    class ControllerUser{
        
         //recibe como parámetro la cédula de un usuario y retorna el nombre completo del usuario correspondiente a dicha cédula.
        static public function ctrNameUser($cedula){
            
            $respuesta = User::mdlNameUser($cedula);
            return $respuesta;

        }

        public function ctrLoginUser(){

            if(isset($_POST["ingUser"])){
                
                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUser"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

                    $valor = $_POST["ingUser"];
                    //loginUser para obtener los datos del usuario que se está intentando ingresar
                    $incrypt = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');
                    // Si el usuario existe y su estado es 'Activo', se comprueba si los datos ingresados coinciden con los almacenados en la base de datos.
                    $respuesta = User::loginUser($valor);
                    //Si coinciden, se establecen las variables de sesión correspondientes y se redirige al usuario a la página de inicio. Si no coinciden, 
                    //se muestra un mensaje de error. Si el usuario no existe o su estado no es 'Activo', también se muestra un mensaje de error
                    if(($respuesta != null) && ($respuesta["estado" ]== 'Activo')){
                    if(($respuesta["nombre"] == $_POST["ingUser"]) && ($respuesta["password"] == $incrypt)){
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["cedula"] = $respuesta["cedula"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["apellidos"] = $respuesta["apellidos"];
						$_SESSION["role"] = $respuesta["role"];
                        $_SESSION["idSucursal"] = $respuesta["idSucursal"];
                        $_SESSION["email"] = $respuesta["email"];
                        $_SESSION["image"] = $respuesta["image"];
                        $_SESSION["estado"] = $respuesta["estado"];
                        
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
                 // verifica que se hayan enviado los datos del formulario y que cumplan con ciertos patrones de validación 

                if(preg_match('/^[0-9]+$/', $_POST["idUser"]) && 
                    preg_match('/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["nameUser"]) &&
                    preg_match('/^[a-zA-Z0-9]{6,}$/', $_POST["passwordUser"])){
                     //crypt de PHP para cifrar la contraseña del usuario y almacenarla en una variable.
                    $incrypt = crypt($_POST["passwordUser"], '$2a$07$usesomesillystringforsalt$');
                    // función comprueba si se ha cargado una imagen de perfil para el nuevo usuario y si es así, la procesa y la almacena en un directorio en el servidor.
                    $ruta = null;
                    
                    /*if(isset($_FILES["imageUser"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["imageUser"]["tmp_name"]);

                        //var_dump($_FILES["image"]["tmp_name"]);

                        $directorio = "imagen/perfil/".$_POST["idUser"];

                        mkdir($directorio, 0755);

                        if($_FILES["imageUser"]["type"] == "image/jpeg"){
                            
                            $ruta = "imagen/perfil/".$_POST["idUser"]."/".$_FILES["imageUser"]["name"];
                        
                            $origen = imagecreatefromjpeg($_FILES["imageUser"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["imageUser"]["type"] == "image/png"){
                            
                            $ruta = "imagen/perfil/".$_POST["idUser"]."/".$_FILES["imageUser"]["name"];
                        
                            $origen = imagecreatefrompng($_FILES["imageUser"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagepng($destino, $ruta);
                        }
                        

                    }*/

                                    $datas = array("cedula" => $_POST["idUser"], 
                                                    "nombre" => $_POST["nameUser"], 
                                                    "password" => $incrypt,
                                                    "apellidos" => $_POST["lastNameUser"],
                                                    "email" => $_POST["emailUser"],
                                                    "role" => $_POST["roleUser"],
                                                    "cuentaBancaria" => $_POST["cuentaUser"],
                                                    "idSucursal" => $_POST["sucursalUser"],
                                                    "direccion" => $_POST["directionUser"],
                                                    "estado" => $_POST["estadoUser"],
                                                    "image" =>$ruta);

                                    
                                
                                    $respuesta = User::mdlAdd($datas);
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
            //User y permite obtener información de un usuario específico en la base de datos.
            //parámetros: $item que indica el campo de la tabla donde se buscará la información (por ejemplo, "idUsuario", "nombre", "cedula", etc.), y $valor que es el valor que se buscará en ese campo para 
            //obtener la información específica de ese usuario.
            
            $respuesta = User::mdlShow($item, $valor);
            return $respuesta;
        }



        

        static public function ctrUpdateUser(){
             //ctrUpdateUser actualiza los datos de un usuario en la base de datos y su imagen de perfil en caso de haberla modificado.
            //se verifica si se ha enviado un ID de usuario a través del método POST y si su formato es correcto. Luego se establece la tabla de la base de 
            //datos en la que se realizará la actualización.

            if(isset($_POST["idUserm"])){

                if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["idUserm"])){

                    $table = "empleado";


                    /**FOTO AL MODIFICAR */

                    $ruta = $_POST["fotoActual"];

                    if(isset($_FILES["imageUpdate"]["tmp_name"]) && !empty($_FILES["imageUpdate"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["imageUpdate"]["tmp_name"]);

                        //var_dump($_FILES["image"]["tmp_name"]);

                        $directorio = "imagen/perfil/".$_POST["idUserm"];

                        /**VER SI HAY UNA FOTO EN LA BASE DE DATOS */

                        if(!empty($_POST["fotoActual"])){
                            unlink($_POST["fotoActual"]);
                        }else{
                            mkdir($directorio, 0755);
                        }

                        

                        if($_FILES["imageUpdate"]["type"] == "image/jpeg"){
                            
                            $ruta = "imagen/perfil/".$_POST["idUserm"]."/".$_FILES["imageUpdate"]["name"];
                        
                            $origen = imagecreatefromjpeg($_FILES["imageUpdate"]["tmp_name"]);
                            $destino = imagecreatetruecolor(500, 500);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, 500, 500, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["imageUpdate"]["type"] == "image/png"){
                            
                            $ruta = "imagen/perfil/".$_POST["idUserm"]."/".$_FILES["imageUpdate"]["name"];
                        
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
                                    "estado" => $_POST["estadoUserm"],
                                    "image" =>$ruta);
                    
                    $respuesta = User::mdlUpdate($datas);
                    
                    if($respuesta == "ok"){  
                    
                        //elimina todos los activos que tenga relacionado y los pone libre si el empleado es inactivo
                        if($_POST["estadoUserm"]=='Inactivo'){
                            $item = "empleado_id";
                            $valor = $_POST["idUserm"];                
                            $activos = ControllerActivos::ctrSpecificActivo($item, $valor);
                        
                        
                            foreach($activos as $key => $activo) {
                            $codigoA=$activo['codigo'];
                            ControllerActivos::ctrUpdateOneActivo($activo,$codigoA);
                            }
                        }

                        //Guarda los nuevos datos de las variables session y los actualiza
                        if( $_SESSION['cedula'] ==$_POST["idUserm"] ){

                            $_SESSION['nombre'] = $_POST['nameUserm'];
                            $_SESSION['apellidos'] = $_POST['lastNameUserm'];
                            $_SESSION['estado'] = $_POST['estadoUserm'];
                        }
                                    

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
                //mdlDelete del modelo User para realizar la eliminación en la base de datos. 
                //Si la eliminación es exitosa, se muestra un mensaje de éxito usando la librería SweetAlert y se redirecciona al usuario a la página de lista de usuarios.
                
                $respuesta = User::mdlDelete($data);
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