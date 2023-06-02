<?php
    class ControllerActivos{
        

        /**REGISTRO DE ACTIVOS */
        //se encarga de crear un nuevo activo en una base de datos, a través del envío de un formulario vía POST
        static public function ctrCreateActivo(){
            if(isset($_POST["idSucursalActivo"])){
                  //Se verifica si existe la variable $_POST["idSucursal"], lo que indica que se ha enviado el 
                //formulario con los datos del activo a crear.
                if(preg_match('/^[0-9]+$/', $_POST["idSucursalActivo"])){

                    $table = "activos";

                    
                     
                    //Se define un array $datas que contiene los datos del activo a insertar en la base de datos, estos datos son: el idSucursal, descripcion, estado y empleado_id,
                    // que son valores obtenidos de $_POST.
                    $datas = array("idSucursal" => $_POST["idSucursalActivo"], 
                                    "descripcion" => $_POST["descripcionActivo"],
                                    "estado" => $_POST["estadoActivo"],
                                    "empleado_id" => $_POST["empleado_id"]);
                       //Se llama al método mdlAdd de la clase Activo, pasando como parámetros $table y $datas, para realizar la inserción en la base de datos.
                     //Si la inserción fue exitosa ($respuesta es igual a "ok"), se muestra un mensaje de éxito utilizando la librería SweetAlert2 y se redirige al usuario a la página 

                    $respuesta = Activo::mdlAdd($table, $datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'El activo se agregó correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'activos';
                            })

                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede agregar el activo',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'activos';
                    })
                    </script>";
                }
            }
        }
         //ctrShowActivo($item, $valor): Esta función recibe dos parámetros: $item, que es una cadena de texto que indica el campo de la tabla a buscar, y $valor, que es el valor a buscar en ese campo. La función utiliza el modelo Activo::mdlShow para buscar los datos en la tabla "activos"
        // y devuelve la respuesta obtenida.ctrShowActivo($item, $valor): Esta función recibe dos parámetros: $item,
        // que es una cadena de texto que indica el campo de la tabla a buscar, y $valor, que es el valor a buscar en ese campo. La función utiliza el modelo Activo::mdlShow para buscar los datos en la tabla "activos" y devuelve la respuesta obtenida.
        static public function ctrShowActivo($item, $valor){

            $tabla = "activos";
            
            $respuesta =Activo::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }

         //ctrSpecificActivo($item, $valor): Esta función también recibe dos parámetros: $item y $valor, 
        //que se utilizan para buscar un registro específico en la tabla "activos". Al igual que en la función anterior,
        static public function ctrSpecificActivo($item, $valor){

            $tabla = "activos";
            
            $respuesta =Activo::mdlSpecificShow($tabla, $item, $valor);
            return $respuesta;
        }



        
        //Esta función recibe dos parámetros: $activo y $codigoA. $activo es un arreglo con nuevos valores que se desean actualizar en la base de datos, y 
        //$codigoA es el código del activo que se desea actualizar.
        //se define una variable $table que contiene el nombre de la tabla donde
        // se encuentran los activos en la base de datos. Luego se llama al método mdlUpdateEmployer del modelo Activo y
        // se le pasan los parámetros $table, $activo y $codigoA
        //devuelve la respuesta del modelo a quien la haya llamado.
        static public function ctrUpdateOneActivo($activo,$codigoA){

            $table = "activos";
            
            $respuesta =Activo::mdlUpdateEmployer($table, $activo,$codigoA);
            return $respuesta;
        }



        
        //ctrUpdateActivo actualiza un activo en la base de datos. Primero se verifica que se haya enviado el parámetro
        static public function ctrUpdateActivo(){

            if(isset($_POST["codigoActivom"])){

                if(preg_match('/^[0-9]+$/', $_POST["codigoActivom"])){

                    $table = "activos";

                    $datas = array("codigo" => $_POST["codigoActivom"],
                                    "idSucursal" => $_POST["idSucursalActivom"], 
                                    "descripcion" => $_POST["descripcionActivom"],
                                    "estado" => $_POST["estadoActivom"],
                                    "empleado_id" => $_POST["empleado_idm"]);
                     //se crea un array con los datos actualizados del activo y
                    // se llama al método mdlUpdate de la clase Activo
                    $respuesta = Activo::mdlUpdate($table, $datas);
                    
                    //Si la respuesta es "ok", se muestra un mensaje de éxito con la librería SweetAlert y se redirecciona al usuario a la página de activos. Si hay un error, se muestra un mensaje de error con SweetAlert
                    // y se redirecciona también a la página de activos.
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'El activo se modificó correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'activos';
                            })
                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede modificar el activo',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'activos';
                    })
                    </script>";
                }
            }
        }

        static public function ctrDeleteActivo(){

            if(isset($_GET["idActivoE"])){

                $table = "activos";
                $data = $_GET["idActivoE"];
                
                $respuesta = Activo::mdlDelete($table, $data);
                //$respuesta = User::mdlPrueba($data);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'El activo se eliminó correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'activos';
                            }
                            
                        })
                    </script>";

                }
            
            }
            
            
        }
    }
    


?>  