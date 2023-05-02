<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">  

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id= "container pt-4" style="margin-top: 100px;">

  <div class="container mt-3">
  <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Factura</h2>

    <div class="box-header with-border">  
              <a href="crearVentasP">
                <button class="btn btn-primary navbar-right btnAgregarVentas" style="margin: 7px;margin-bottom: 20px; " style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">  
                  Agregar venta
                </button>
              </a>
    </div>
      
      <div class="table-responsive roboto rU">
          <table class="table tableU" id="tabla" data-sort="table">
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
                    <th>Acciones</th>
                  
                      
                </tr>
            </thead>

            <tbody>

              <?php
              $item = null;
              $valor = null;
      
              $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
              

              foreach ($respuesta as $key => $value) {
                
                $itemCliente = "cedula";
                $valorCliente = $value["idCliente"];
                $respuestaCliente = ControllerClient::ctrShowClient($itemCliente, $valorCliente);

                $itemSucursal = "codigo";
                $valorSucursal = $value["idSucursal"];
                $respuestaSucursal = ControllerSucursal::ctrShowSucursal($itemSucursal, $valorSucursal);

                $itemUsuario = "cedula";
                $valorUsuario = $value["idEmpleado"];
                $respuestaUsuario = ControllerUser::ctrShowUser($itemUsuario, $valorUsuario);

              
              ?>
              <tr>

                <td><?php echo $value['codigo']; ?></td>
                <td><?php echo $respuestaCliente['nomCliente']; ?></td>
                <td><?php echo $respuestaSucursal['nombre']; ?></td>
                <td><?php echo $respuestaUsuario['nombre']; ?></td>
                <td><?php echo $value['fechaFactura']; ?></td>
                <td><?php echo '¢ '.number_format($value["subTotal"],2); ?></td>
                <td><?php echo '¢ '.number_format($value["impuesto"],2); ?></td>
                <td><?php echo '¢ '.number_format($value["descuento"],2); ?></td>
                <td><?php echo '¢ '.number_format($value["total"],2); ?></td>
                
                <td>
                  <div class="btn-group">
                                
                    <button class="btn btn-success btnImprimirFactura" codigoVenta = <?php echo $value['codigo']; ?>>
    
                    <i class="fa fa-file"></i></button>
    
                                
                    <button class="btn btn-info btnImprimirTicket" codigoVenta = <?php echo $value['codigo']; ?>>
    
                    <i class="fa fa-print"></i></button>
    
    
    
                    <button class="btn btn-warning btnEditarVenta" idVenta=<?php echo $value['codigo']; ?>><i class="fa fa-pencil"></i></button>
    
                    <button class="btn btn-danger btnEliminarVenta" idVenta=<?php echo $value['codigo']; ?>><i class="fa fa-times"></i></button>
    
                  </div>  

                </td>
              </tr>

            <?php } ?>

            </tbody>
          </table>
    </div>
  </div>
</div>

