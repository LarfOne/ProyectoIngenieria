<?php
    class ControllerCategories{
        static public function ctrNameCategories($codigo){
            
            $respuesta = Categories::mdlNameCategories($codigo);
            return $respuesta;
        }

        /**REGISTRO DE Categorias */
        static public function ctrCreateCategories(){
            if(isset($_POST["nameCategories"])){

                if( preg_match('/^[0-9-a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["nameCategories"])){

                    $datas = array("nombre" => $_POST["nameCategories"]);

                    $respuesta = Categories::mdlAdd($datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La Categoría se agrego correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'categories';
                            })

                        </script>";
                    }else{
                        echo "<script>
                    
                            Swal.fire({
                                title: 'Error al agregar la categoria',
                                icon: 'error',
                            }).then((result) => {
                                window.location = 'categories';
                            })
                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede agregar la Categoría',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'categories';
                    })
                    </script>";
                }
            }
        }

        static public function ctrShowCategories($item, $valor){

            $tabla = "categoria";
            
            $respuesta = Categories::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrUpdateCategories(){

            if(isset($_POST["idCategoriesm"])){

                if(preg_match('/^[0-9]+$/', $_POST["idCategoriesm"])){

                    $datas = array("codigo" => $_POST["idCategoriesm"], 
                                    "nombre" => $_POST["nameCategoriesm"]);
                                   

                    $respuesta = Categories::mdlUpdate($datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La Categoría se modifico correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'categories';
                            })
                        </script>";
                    }


                    

                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede modificar la Categoría',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'categories';
                    })
                    </script>";
                }
            }
        }

        static public function ctrDeleteCategories(){

            if(isset($_GET["codigoE"])){
                
                $data = $_GET["codigoE"];
                
                $respuesta = Categories::mdlDelete($data);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La Categoría se eliminó correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'categories';
                            }
                            
                        })
                    </script>";

                }
            
            }
        
        }
    }
