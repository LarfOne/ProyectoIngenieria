<?php
    class ControllerActivos{
        
   
        /**REGISTRO DE ACTIVOS */
        static public function ctrCreateActivo(){
            if(isset($_POST["idSucursal"])){

                if(preg_match('/^[0-9]+$/', $_POST["idSucursal"])){

                    $table = "activos";

                    

                    $datas = array("idSucursal" => $_POST["idSucursal"], 
                                    "descripcion" => $_POST["descripcion"],
                                    "estado" => $_POST["estado"],
                                    "empleado_id" => $_POST["empleado_id"]);

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

        static public function ctrShowActivo($item, $valor){

            $tabla = "activos";
            
            $respuesta =Activo::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }


        static public function ctrSpecificActivo($item, $valor){

            $tabla = "activos";
            
            $respuesta =Activo::mdlSpecificShow($tabla, $item, $valor);
            return $respuesta;
        }




        static public function ctrUpdateOneActivo($activo,$codigoA){

            $table = "activos";
            
            $respuesta =Activo::mdlUpdateEmployer($table, $activo,$codigoA);
            return $respuesta;
        }




        static public function ctrUpdateActivo(){

            if(isset($_POST["codigom"])){

                if(preg_match('/^[0-9]+$/', $_POST["codigom"])){

                    $table = "activos";

                    $datas = array("codigo" => $_POST["codigom"],
                                    "idSucursal" => $_POST["idSucursalm"], 
                                    "descripcion" => $_POST["descripcionm"],
                                    "estado" => $_POST["estadom"],
                                    "empleado_id" => $_POST["empleado_idm"]);

                    $respuesta = Activo::mdlUpdate($table, $datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'El activo se modifico correctamente',
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
                            title: 'El activo se elimino correctamente',
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