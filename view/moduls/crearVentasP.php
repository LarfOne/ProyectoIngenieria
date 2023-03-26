<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    
<link rel="stylesheet" href="css/ventas.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div class="contenedor">
    <div class="content-wrapper contVenta" style="padding: 15px 10px 30px 10px !important;">

        <header class="headerVentas">

            <div class="info">
                <img src="view/img/empresa/logoEmpresa.png" style="width: 150px;">
                <div class="">
                    <h1>MOUSE LAMP TECNOLOGIES</h1>
                    <h3>CEDULA FISICA: 50389093520</h3>
                    <h3>TELEFONO: 87170007</h3>
                </div>
            </div>

            <div class="datosVenta">

                <!--Seleccionar cliente que efectua la compra -->
                <div class="form-group">                   
                    <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>                    
                        <select class="form-control" id="idCliente" name="idCliente" required>
                        <option value="">Seleccionar cliente</option>

                        <?php
                        $item = null;
                        $valor = null;
                        $categorias = ControllerClient::ctrShowClient($item, $valor);
                        foreach ($categorias as $key => $value) {?>

                            <option value=<?php echo $value['cedula']?>><?php echo $value['nomCliente']?></option>

                        <?php }
                        ?>
                        </select>                      
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs botonCli" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>                    
                    </div>                  
                </div>

                <!--Datos del dependiente que efectua la venta -->
                <div class="form-group">                   
                    <div class="input-group">                 
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" class="form-control" id="nombre" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                        <input type="hidden" id = "idEmpleado" name="idEmpleado" value="<?php echo $_SESSION["cedula"]; ?>">
                        <input type="hidden" id = "idSucursal" name="idSucursal" value="<?php echo $_SESSION["idSucursal"]; ?>">
                    </div>
                </div> 

                <!--Codigo incrementable de la factura -->
                <div class="form-group">                 
                  <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php
                    $item = null;
                    $valor = null;
                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="1" readonly>';
                  
                    }else{
                        
                      foreach ($ventas as $key => $value) { 

                      }
                      $codigo = $value["codigo"] + 1;
                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                    }
                    ?>      

                  </div>               
                </div>          
            </div>
        </header>

        <div class="articulo">
            <div class="arti">

                <div class="col mt-5 mr-5">
                    <label>Articulo</label>
                    <input class="form-control input-sm mt-2" type="text" name="idProducto" placeholder="Ingresar codigo" required>
                </div>

                <div class="col mt-5 mr-5">
                    <label>Cantidad</label>
                    <input class="form-control input-sm mt-2" type="text" name="idProducto" placeholder="Ingresar codigo" required>
                </div>

                <div class="col mt-5 mr-5 form-group row factura">
                    <label>Tipo Factura</label>
                    <div class="input-group">
                        <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                            <option value="">Tipo Factura</option>
                            <option value="Electronica">Electronica</option>
                            <option value="Normal">Normal</option>                 
                        </select>    
                    </div>
                   
                </div>

                <div class="col mt-5 mr-5 form-group row">  
                    <label>Tipo Factura</label>                                      
                        <div class="input-group">                  
                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                <option value="">Seleccione método de pago</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="TC">Tarjeta Crédito</option>
                                <option value="TD">Tarjeta Débito</option>                  
                            </select>    
                        </div>

                        <div class="cajasMetodoPago">
                            <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                        </div>      
                </div>
            </div>
        </div>

        <section class="tablaVenta"> 
            <div class="tablaVendidos">
                <table class="table tableU" id="tabla" data-sort="table">
                    <thead>
                        <tr>
                            <th >Codigo</th>
                            <th>Descripcion</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>% Descuento</th>
                            <th>Descuento</th>
                            <th>SubTotal I.V.I</th>
                        </tr>
                </thead>

                
                </table>

            </div>
        </section>

        <section class="valores">

            <div class="col-xs-8 pull-right">
                    
                <table class="table">
                    <thead>
                        <tr>
                            <th>Total</th>      
                        </tr>
                    </thead>

                    <tbody>                   
                        <tr>
                           <td style="width: 50%">                            
                                <div class="input-group">                          
                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                                    <input type="hidden" name="totalVenta" id="totalVenta">                                                  
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

        <div class="botonesVenta">
  
            <button type="submit" class="btnVentaGuardar">Guardar venta</button>
           
            <button type="button" class="btnVentaCancelar">Cancelar</button>
            
        </div>

    </div>
</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControllerClient();
        $crearCliente -> ctrCreateClient();

      ?>

    </div>

  </div>

</div>