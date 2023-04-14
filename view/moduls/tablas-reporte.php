

<!DOCTYPE html>
<html>

<head>
    
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


<link rel="stylesheet" href="css/boton.css">
<script src="../js/funciones.js"></script>
</head>
<body>

<?php
function generarTablaVentasMes() {
    $tabla = '<table id="tabla-ventas-mes" data-sort="table">
            <thead>
                <tr>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';
    /**Extraccion de datos para la tabla de movimientos */
    $facturas = ControladorVentas::ctrVentasMes();
    foreach ($facturas as $key => $factura) {
        /**Se deben buscar todos los detalles que tengan esa factura */
        /*Se debe extraer el nombre de el vendedor haciendo una consulta a la tabla ya que la factura ya lleva su id* */
        $itemUsuario = "cedula";
        $valorUsuario = $factura[3];
        $respuestaUsuario = ControllerUser::ctrShowUser($itemUsuario, $valorUsuario);
        /**Se le envia el id de la factura */
        $detalles = ControllerDetalle::ctrDetallesPorFactura($factura[0]);
        foreach ($detalles as $key2 => $detalle) {
            $producto = ControllerProduct::ctrNameProducts($detalle[2]);
            $tabla .= '<tr>
                            <td>' . $respuestaUsuario[2] . '</td>
                            <td>' . $factura[4] . '</td>
                            <td>' . $producto[1] . '</td>
                            <td>' . $detalle[3] . '</td>
                            <td>' . $detalle[6] . '</td>
                        </tr>';
        }
    }
    $tabla .= '</tbody></table>';
    return $tabla;
}
if (isset($_POST['accion']) && $_POST['accion'] == 'generarTablaVentasMes') {
    $tabla = generarTablaVentasMes();
    echo $tabla;
  }






?>
<div class="table-responsive roboto"> <!-- contenedor de la tabla -->
                    <table class="table" id="tabla-ventas-mes" data-sort="table">
                        <thead>
                            <tr>
                                <th>Vendedor</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /**Extraccion de datos para la tabla de movimientos */
                            $facturas = ControladorVentas::ctrVentasMes();
                            foreach ($facturas as $key => $factura) {
                                /**Se deben buscar todos los detalles que tengan esa factura */
                                /*Se debe extraer el nombre de el vendedor haciendo una consulta a la tabla ya que la factura ya lleva su id* */
                                $itemUsuario = "cedula";
                                $valorUsuario = $factura[3];
                                $respuestaUsuario = ControllerUser::ctrShowUser($itemUsuario, $valorUsuario);
                                /**Se le envia el id de la factura */
                                $detalles = ControllerDetalle::ctrDetallesPorFactura($factura[0]);
                                foreach ($detalles as $key2 => $detalle) {
                                    $producto = ControllerProduct::ctrNameProducts($detalle[2]);
                                    echo ('
                                <tr>
                                    <td>' . $respuestaUsuario[2] . '</td>
                                    <td>' . $factura[4] . '</td>
                                    <td>' . $producto[1] . '</td>
                                    <td>' . $detalle[3] . '</td>
                                    <td>' . $detalle[6] . '</td>
                                </tr>
                                
                                ');
                                }
                            }
                            ?>

                        </tbody>

                    </table>
                </div>












</body>

</html>




