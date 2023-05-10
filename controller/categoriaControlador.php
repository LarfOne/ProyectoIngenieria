<?php
    class ControllerCategories{
        //espera un parámetro llamado $codigo. 
        static public function ctrNameCategories($codigo){
            
            $respuesta = Categories::mdlNameCategories($codigo);//La clase llama al método mdlNameCategories de la clase Categories. Este método es responsable de buscar el nombre de la categoría correspondiente al código proporcionado en la base de datos.
            return $respuesta;//El método devuelve la variable $respuesta con el nombre de la categoría 
        }

        /**REGISTRO DE Categoriass*/
        //ctrCreateCategories comprueba si se ha enviado un formulario utilizando el método POST para agregar una nueva categoría.
        static public function ctrCreateCategories(){
            if(isset($_POST["nameCategories"])){

                if( preg_match('/^[0-9-a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["nameCategories"])){

                    $datas = array("nombre" => $_POST["nameCategories"]);


                    //La clase llama al método mdlAdd de la clase Categories. Este método es responsable de agregar
                    // los datos de la nueva categoría a la base de datos
                    $respuesta = Categories::mdlAdd($datas);
                    //Si la categoría se agrega correctamente, se muestra un mensaje de éxito y se redirige al usuario a la página "categories". Si ocurre un error al agregar la categoría, se muestra un mensaje de error y
                    // se redirige al usuario a la página "categories".
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
        //ctrShowCategories espera dos parámetros: $item y $valor. $item es el campo de la tabla "categoria" que se utilizará para buscar los datos correspondientes 
        //y $valor es el valor que se buscará en el campo especificado.
        static public function ctrShowCategories($item, $valor){

            $tabla = "categoria";
            
            $respuesta = Categories::mdlShow($tabla, $item, $valor);
            return $respuesta;//El método devuelve la variable $respuesta que contiene los datos de la categoría buscada.
        }

        //ctrUpdateCategories se ejecuta cuando se envía un formulario con el campo idCategoriesm a través del método POST
        static public function ctrUpdateCategories(){
           // idCategoriesm es un número válido, se crea un array llamado $datas que contiene los datos
           // que se actualizarán en la tabla de categorías. En este caso, el array contiene el codigo de la categoría y el nombre de la categoría actualizado.
            if(isset($_POST["idCategoriesm"])){

                if(preg_match('/^[0-9]+$/', $_POST["idCategoriesm"])){

                    $datas = array("codigo" => $_POST["idCategoriesm"], 
                                    "nombre" => $_POST["nameCategoriesm"]);
                                   
                    //La clase llama al método mdlUpdate de la clase Categories y le pasa el array $datas
                    $respuesta = Categories::mdlUpdate($datas);
                    //Si la actualización de la categoría se realiza correctamente, 
                    //se muestra un mensaje de éxito y se redirige al usuario a la página de categorías.
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
        //ctrDeleteCategories que es responsable de eliminar una categoría de la base de datos
        static public function ctrDeleteCategories(){

            if(isset($_GET["codigoE"])){
                
                $data = $_GET["codigoE"];
                
                $respuesta = Categories::mdlDelete($data);
                //verifica si el parámetro codigoE está establecido en la URL. Si existe, recupera el valor del parámetro y llama al método mdlDelete de la clase Categories, pasándole el valor del código de categoría como argumento. Si la respuesta de mdlDelete es "ok", muestra un mensaje de confirmación al usuario usando la biblioteca Swal y redirige al usuario a la página de categorías 
                //después de que el usuario haga clic en el botón de confirmación.
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
