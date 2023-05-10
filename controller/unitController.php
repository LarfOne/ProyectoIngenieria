<?php
    class ControllerUnit{

        /**REGISTRO DE EMPLEADOS */
            static public function ctrCreateUnit()
            {

                    $table = "unidadmedida";

                    $datas = array("codigo" => $_POST["idUnit"], 
                                    "nombre" => $_POST["nameUnit"]);

                    $respuesta = Unit::mdlAddUnit($table, $datas);
                    
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
            

        static public function ctrShowUnit($item, $valor){

            $tabla = "unidadmedida";
            
            $respuesta = Unit::mdlShowUnit($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateUnit(){

            if(isset($_POST["idUnitm"])){

                if(preg_match('/^[0-9]+$/', $_POST["idUnitm"])){

                    $table = "unidadmedida";

                    $datas = array("codigo" => $_POST["idUnitm"], 
                                    "nombre" => $_POST["nameUnitm"]);

                    $respuesta = Unit::mdlUpdateUnit($table, $datas);
                    
                    if($respuesta == "ok"){
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

        static public function ctrDeleteUnit(){

            if(isset($_GET["idUnitE"])){

                $table = "unidadmedida";
                $data = $_GET["idUnitE"];
                
                $respuesta = Unit::mdlDeleteUnit($table, $data);

                if($respuesta == "ok"){
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