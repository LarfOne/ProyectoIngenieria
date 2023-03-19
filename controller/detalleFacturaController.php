<?php

    class ControllerDetalle{

        static public function ctrCreateDetalle(){
            
            if(isset($_POST["listaProductos"])){
                $array = json_decode($_POST['listaProductos'],true);
                
                $idFactura = $_POST["nuevaVenta"];
                $table = "detallefactura";

                $respuesta = ModeloDetalle::mdlIngresarDetalle($table, $array, $idFactura);

                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La Venta se realizo correctamente',
                            icon: 'success',
                        }).then((result) => {
                            window.location = 'ventas';
                        })

                    </script>";
                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede realizar la factura',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'ventas';
                    })
                    </script>";
                }
            }
            

        }
        static public function ctrDetallesPorFactura ($valor){
            $tabla = "detallefactura";
            $item = "idFactura";
            $respuesta = ModeloDetalle::mdlMostrarDetalleporIdFactura($tabla, $item, $valor);
            return $respuesta;
        }

    }






?>  