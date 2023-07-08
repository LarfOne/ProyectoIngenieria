<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ventas.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div id= "container pt-4" style="margin: 100px 0px 0px 25px;">
        <div class="content-wrapper" style="padding: 15px !important;">
            <div class="content-wrapper">
                <section class="content">
                    <h2 class="correrIzquierda" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Facturas</h2>
                    <div class="box">
                        <div class="box-header with-border correrIzquierda">
                            <a href="crearVentasP">
                                <button class="btn btn-primary navbar-right btnAgregarVentas" style="margin: 7px;margin-bottom: 20px; " style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Agregar venta</button>
                            </a>
                        </div>
                        <div class="box correrIzquierda" style="margin: 0px;"></div>
                         <div class="box-body">
                            <div class="table-responsive roboto correrIzquierda">
                                <table id="tabla" class="table table-bordered table-striped dt-responsive tablas tableMostrar" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Código factura</th>
                                            <th>Cliente</th>
                                            <th>Sucursal</th>
                                            <th>Vendedor</th>
                                            <th>Fecha factura</th>
                                            <th>Sub total</th>
                                            <th>Impuesto</th>
                                            <th>Descuenso</th>
                                            <th>Total</th>
                                            <th>MP_Tipo</th>
                                            <th>Sinpe</th>
                                            <th>Efectivo</th>
                                            <th>Tarjeta</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
                                        foreach ($respuesta as $key => $value) {
                                            echo '<tr>
                                                <td>'.$value["codigo"].'</td>';
                                            $itemCliente = "cedula";
                                            $valorCliente = $value["idCliente"];
                                            $respuestaCliente = ControllerClient::ctrShowClient($itemCliente, $valorCliente);
                                            echo '<td>'.$respuestaCliente["nomCliente"].'</td>';
                                            $itemSucursal = "codigo";
                                            $valorSucursal = $value["idSucursal"];
                                            $respuestaCliente = ControllerSucursal::ctrShowSucursal($itemSucursal, $valorSucursal);
                                            echo '<td>'.$respuestaCliente["nombre"].'</td>';
                                            $itemUsuario = "cedula";
                                            $valorUsuario = $value["idEmpleado"];
                                            $respuestaUsuario = ControllerUser::ctrShowUser($itemUsuario, $valorUsuario);
                                            echo '<td>'.$respuestaUsuario["nombre"].'</td>
                                                <td>'.$value["fechaFactura"].'</td>
                                                <td>¢ '.number_format($value["subTotal"],2).'</td>
                                                <td>¢ '.number_format($value["impuesto"],2).'</td>
                                                <td>¢ '.number_format($value["descuento"],2).'</td>
                                                <td>¢ '.number_format($value["total"],2).'</td>
                                                <td>'.$value["metodoPago"].'</td>
                                                <td>¢ '.number_format($value["sinpe"],2).'</td>
                                                <td>¢ '.number_format($value["efectivo"],2).'</td>
                                                <td>¢ '.number_format($value["tarjeta"],2).'</td>
                                                <td>
                                                    <div class="btn-group">
                                                                                <button class="btn btn-success btnImprimirFactura" codigoVenta="'.$value['codigo'].'" codigoVenta="'.$value['codigo'].'">
                                                            <a class="probar" href="extensiones/tcpdf/pdf/factura.php?codigo='.$value['codigo'].'">  <i class="fa fa-file" style="color: white;"></i></a>
                                                        </button>
                                        
                                        
                                        <button class="btn btn-info btnImprimirTicket" codigoVenta="'.$value['codigo'].'" codigoVenta="'.$value['codigo'].'">
                                                            <a class="probar" href="extensiones/tcpdf/pdf/ticket.php?codigo='.$value['codigo'].'"> <i class="fa fa-print" style="color: black;"></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            $eliminarVenta = new ControladorVentas();
                            $eliminarVenta -> ctrEliminarVenta();
                            ?>       
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
