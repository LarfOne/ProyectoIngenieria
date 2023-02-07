<?php
    class ControllerInventario{
        
        static public function ctrShowInventario($item, $valor){

            $tabla = "inventario";
            
            $respuesta = Inventario::mdlShowInventario($tabla, $item, $valor);
            return $respuesta;
        }

        static public function ctrCreateInventario()
	    {
            if (isset($_POST["idProducto"])) {

                if(preg_match('/^[0-9]+$/', $_POST["idProducto"])){
            
                    $table = "inventario";

                    $datas = array(
                        "idSucursal" => $_POST["idSucursal"],
                        "idProducto" => $_POST["idProducto"],
                        "cantidad" => $_POST["cantProducto"],
                        "existencia" => $_POST["existProducto"],
                        "minimo" => $_POST["minProducto"]
                    );

                    $respuesta = Inventario::mdlAdd($table, $datas);
                }
            }

	    }


        static public function ctrUpdateInventario(){

            if(isset($_POST["codigoInventario"])){

                    $table = "inventario";

                    $datas = array("codigo" => $_POST["codigoInventario"], 
                                    "idSucursal" => $_POST["idSucursal"], 
                                    "idProducto" =>  $_POST["idProducto"],    
                                    "cantidad" => $_POST["cantProducto"],
                                    "existencia" => $_POST["existProducto"],
                                    "minimo" => $_POST["minProducto"]);

                    $respuesta = Inventario::mdlUpdateInventario($table, $datas);
                    
                    if($respuesta == "ok"){
                        echo "<script>
                        
                            Swal.fire({
                                title: 'El inventario se modifico correctamente',
                                icon: 'success',
                            }).then((result) => {
                                window.location = 'inventarios';
                            })
                        </script>";
                    }
            }
        }

        static public function ctrDeleteInventario(){

            if(isset($_GET["codigoInventarioE"])){

                $table = "inventario";
                $data = $_GET["codigoInventarioE"];
                
                $respuesta = Inventario::mdlDelete($table, $data);
                //$respuesta = User::mdlPrueba($data);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'El inventario se elimino correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false,
                            icon: 'success',
                        }).then((result) => {
                            if(result.value){
                                window.location = 'inventarios';
                            }
                            
                        })
                    </script>";

                }
            
            }
            
            
        }
    }
    


?>