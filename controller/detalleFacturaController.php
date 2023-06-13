<?php

    class ControllerDetalle{   
        //parámetros: $item y $valor.   
        static public function ctrShowDetalleFactura($item, $valor){
            $tabla = "detallefactura";
            $respuesta = ModeloDetalle::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }


	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/
        //ctrMostrarSumaVentas es utilizado para mostrar la suma de productos vendidos
	static public function ctrMostrarSumaVentas(){

		$tabla = "detallefactura";
        //mdlSumaProcuctosVendidos del modelo ModeloDetalle pasando como argumento la variable $tabla
		$respuesta = ModeloDetalle::mdlSumaProcuctosVendidos ($tabla);

		return $respuesta;

	}


    
    //ctrCreateDetalle que se encarga de crear un registro de detalle de factura en la base de datos.
        static public function ctrCreateDetalle(){
            //comprueba si el formulario ha sido enviado (si se ha seleccionado al menos un producto). Si se ha enviado, se decodifica la cadena JSON 
            //que contiene los productos y se almacena en una matriz.
            if(isset($_POST["listaProductos"])){
                $array = json_decode($_POST['listaProductos'],true);
                
                $idFactura = $_POST["nuevaVenta"];
                $table = "detallefactura";

                $respuesta = ModeloDetalle::mdlIngresarDetalle($table, $array, $idFactura);
                 //La función devuelve "ok" si la inserción se realiza correctamente.
                if($respuesta == "ok"){
                    echo "<script>
                    
                        Swal.fire({
                            title: 'La Venta se realizó correctamente',
                            icon: 'success',
                        }).then((result) => {
                            window.location = 'ventas';
                        })

                    </script>";
                }else{

                    echo "<script>
                    
                    Swal.fire({
                        title: 'No se puede realizar la facturaDetalle',
                        icon: 'error',
                    }).then((result) => {
                        window.location = 'ventas';
                    })
                    </script>";
                }
            }
            

        }
         //ctrDetallesPorFactura y tiene un parámetro de entrada $valor, que se utiliza para buscar los detalles
        // de la factura correspondiente en la base de datos.
        static public function ctrDetallesPorFactura ($valor){
            $tabla = "detallefactura";
            $item = "idFactura";
            $respuesta = ModeloDetalle::mdlMostrarDetalleporIdFactura($tabla, $item, $valor);
            return $respuesta;
        }

    }






?>  