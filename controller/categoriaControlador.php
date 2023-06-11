<?php
    class ControllerCategories{
        static public function ctrNameCategories($codigo){
            
            $respuesta = Categories::mdlNameCategories($codigo);
            return $respuesta;
        }

        /**REGISTRO DE Categorias */
         //ctrCreateCategories comprueba si se ha enviado un formulario utilizando el método POST para agregar una nueva categoría.
        static public function ctrCreateCategories(){
            if(isset($_POST["nameCategories"])){

                if( preg_match('/^[0-9-a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,60}$/', $_POST["nameCategories"])){

                    $datas = array("nombre" => $_POST["nameCategories"]);
                     //La clase llama al método mdlAdd de la clase Categories. Este método es responsable de agregar
                    // los datos de la nueva categoría a la base de datos
                    $respuesta = Categories::mdlAdd($datas);
                     //Si la categoría se agrega correctamente, se muestra un mensaje de éxito y se redirige al usuario a la página "categories". Si ocurre un error al agregar la categoría, se muestra un mensaje de error y
                    // se redirige al usuario a la página "categories"
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'La Categoría se agregó correctamente',
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
        //y $valor es el valor que se buscará en el campo especificado
        static public function ctrShowCategories($item, $valor){

            $tabla = "categoria";
            
            $respuesta = Categories::mdlShow($tabla, $item, $valor);
            return $respuesta;//El método devuelve la variable $respuesta que contiene los datos de la categoría buscada
        }

         //ctrUpdateCategories se ejecuta cuando se envía un formulario con el campo idCategoriesm a través del método POST
        static public function ctrUpdateCategories(){
            // idCategoriesm es un número válido, se crea un array llamado $datas que contiene los datos
           // que se actualizarán en la tabla de categorías. En este caso, el array contiene el codigo de la categoría y el nombre de la categoría actualizado
            if(isset($_POST["idCategoriesm"])){

                if(preg_match('/^[0-9]{1,10}$/', $_POST["idCategoriesm"])){
                    if(preg_match('/^[0-9-a-zA-ZÑñáéíóúÁÉÍÓÚ ]{1,60}$/', $_POST["nameCategoriesm"])){

                        $datas = array("codigo" => $_POST["idCategoriesm"], 
                                        "nombre" => $_POST["nameCategoriesm"]);
                                    

                        $respuesta = Categories::mdlUpdate($datas);
                        
                        if($respuesta == "ok"){
                            echo "<script>
                            
                                Swal.fire({
                                    title: 'La Categoría se modificó correctamente',
                                    icon: 'success',
                                }).then((result) => {
                                    window.location = 'categories';
                                })
                            </script>";
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
            }
        }

        static public function ctrDeleteCategories(){

            if(isset($_GET["codigoE"])){
                
                $data = $_GET["codigoE"];
                //verifica si el parámetro codigoE está establecido en la URL. Si existe, recupera el valor del parámetro y llama al método mdlDelete de la clase Categories, pasándole el valor del código de categoría como argumento. Si la respuesta de mdlDelete es "ok", muestra un mensaje de confirmación al usuario usando la biblioteca Swal y redirige al usuario a la página de categorías 
                //después de que el usuario haga clic en el botón de confirmación
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
