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
                    
                    
                    /**Agregar foto a una carpeta */
                    $target_dir = "imagen/"; //directorio en el que se subira
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);//se añade el directorio y el nombre del archivo
                    $uploadOk = 1;//se añade un valor determinado en 1
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Comprueba si el archivo de imagen es una imagen real o una imagen falsa
                    if(isset($_POST["submit"])) {//detecta el boton
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        if($check !== false) {//si es falso es una imagen y si no lanza error
                            echo "Archivo es una imagen- " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "El archivo no es una imagen";
                            $uploadOk = 0;
                        }
                    }
                    // Comprobar si el archivo ya existe
                    if (file_exists($target_file)) {
                        echo "El archivo ya existe";
                        $uploadOk = 0;//si existe lanza un valor en 0
                    }
                    // Comprueba el peso
                    if ($_FILES["image"]["size"] > 500000) {
                        echo "Perdon pero el archivo es muy pesado";
                        $uploadOk = 0;
                    }
                    // Permitir ciertos formatos de archivo
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        echo "Perdon solo, JPG, JPEG, PNG & GIF Estan soportados";
                        $uploadOk = 0;
                    }
                    //Comprueba si $ uploadOk se establece en 0 por un error
                    if ($uploadOk == 0) {
                        echo "Perdon, pero el archivo no se subio";
                    // si todo está bien, intenta subir el archivo
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            echo "El archivo ". basename( $_FILES["image"]["name"]). " Se subio correctamente";
                        } else {
                            echo "Error al cargar el archivo";
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
                                    "image" => $_FILES["image"]["name"]);
  
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
                    }


                    

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

        static public function ctrShowUser($item, $valor){

            $tabla = "empleado";
            
            $respuesta = User::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateUser(){

            if(isset($_POST["idUserm"])){

                if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["idUserm"])){

                    $table = "empleado";

                    //Se digito una nueva contraseña
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
                                    "image" => file_get_contents($_FILES['image']['tmp_name']));

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