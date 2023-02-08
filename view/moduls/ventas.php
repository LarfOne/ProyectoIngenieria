
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


<div id= "container pt-4" style="margin-top: 80px">
<div class="content-wrapper" style="padding: 15px !important;">
<div class="content-wrapper">

  <section class="content-header">
    
  </section>

  <section class="content">
    <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Facturas</h2>
    <div class="box">

      <div class="box-header with-border">
  
        <a href="createVenta">

          <button class="btn btn-primary navbar-right" style="margin: 7px;margin-bottom: 20px; " style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">
            
            Agregar venta

          </button>

        </a>

      </div>


      <div class="box" style="margin: 0px;">
      
      </div>

      <div class="box-body">
      <div class="table-responsive roboto">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
             
         <th style="width:10px" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">#</th>
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
           

           echo '<tr>

                  <td>'.($key+1).'</td>


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

                  <td>$ '.number_format($value["subTotal"],2).'</td>

                  <td>$ '.number_format($value["impuesto"],2).'</td>

                  <td>$ '.number_format($value["descuento"],2).'</td>
                  
                  <td>$ '.number_format($value["total"],2).'</td>
                  
                  

                  <td>

                    <div class="btn-group">
                        
                    <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                    <i class="fa fa-print"></i>

                    
                      <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["codigo"].'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

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
