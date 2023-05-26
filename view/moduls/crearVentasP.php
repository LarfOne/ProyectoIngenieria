<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="css/ventas.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>



<div id="container pt-4">
  <form role="form" method="post" class="formularioVenta">
  <script>
    const formularioVenta = document.querySelector('.formularioVenta');

      formularioVenta.addEventListener('submit', function(event) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let alMenosUnoSeleccionado = false;
        checkboxes.forEach(function(checkbox) {
          if (checkbox.checked) {
            alMenosUnoSeleccionado = true;
          }
        });
        if (!alMenosUnoSeleccionado) {
          event.preventDefault();
          alert('Por favor, selecciona al menos una opción de pago.');
        }
});
  </script>

    <div class="contVenta" >


      <header class="rowVenta">
        <div class="col-lg-6">

          <div id="col-sm-2">
            <img src="view/img/empresa/logoEmpresa.png" style="width: 110px;">
          </div>

          <div id="col-sm-2">

            <h2>MOUSE LAMP TECNOLOGIES</h2>
            <h3>CEDULA FISICA: 50389093520</h3>
            <h3>TELEFONO: 87170007</h3>
          </div>


        </div>
        <div class="col-md-6">
          <div class="datosVenta">

            <!--Seleccionar cliente que efectua la compra -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-select" id="idCliente" name="idCliente" required>
                  <option value="">Seleccionar cliente</option>

                  <?php
                  $item = null;
                  $valor = null;
                  $categorias = ControllerClient::ctrShowClient($item, $valor);
                  foreach ($categorias as $key => $value) { ?>

                    <option value=<?php echo $value['cedula'] ?>><?php echo $value['nomCliente'] ?></option>

                  <?php }
                  ?>
                </select>
                <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs botonCli" data-bs-toggle="modal" data-bs-target="#modalAddClient" data-dismiss="modal">Agregar cliente</button></span>
              </div>
            </div>

            <!--Datos del dependiente que efectua la venta -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" style="border-radius: 10px;" class="form-control" id="nombre" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                <input type="hidden" style="border-radius: 10px;" id="idEmpleado" name="idEmpleado" value="<?php echo $_SESSION["cedula"]; ?>">
                <input type="hidden" style="border-radius: 10px;" id="idSucursal" name="idSucursal" value="<?php echo $_SESSION["idSucursal"]; ?>">
              </div>
            </div>
          </div>
        </div>
      </header>


      <div class="articulo">


        <div class="col mt-3 mr-5">
          <label id="campos">Articulo</label>
          <input class="form-control input-sm mt-2" type="number" id="idProducto" name="idProducto" placeholder="Ingresar codigo">
        </div>

        <div class="col mt-5 mr-5">
          <button type="button" class="btn btn-primary btnAgregarProducto1">Agregar</button>
        </div>

        <div class="col mt-3 mr-5">
          <label id="campos">Cantidad</label>
          <input class="form-control input-sm mt-2" type="number" min=1 value=1 id="cantidadProducto" name="cantidadProducto" placeholder="Ingresar codigo" required>
        </div>

        <div class="col mt-3 mr-5 form-group row factura">

        </div>

        <div class="col mt-3 mr-5 form-group row metodoPago">
          <label id="campos">Metodos de pago: </label>
          <label id="campos">
            <input type="checkbox" id="checkEfectivo" name="Efectivo" value="Efectivo"> Efectivo
          </label>
          <label id="campos">
            <input type="checkbox" id="checkTarjeta" name="Tarjeta" value="Tarjeta"> Tarjeta
          </label>
          <label id="campos">
            <input type="checkbox" id="checkSinpe" name="Sinpe" value="Sinpe"> Sinpe Movil
          </label>
        </div>
      </div>

      <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

      <section class="tablaVenta">
        <div class="tablaVendidos">
          <table class="table tableU" id="tablitaC" data-sort="table">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Descuento %</th>
                <th>Precio Unitario</th>
                <th>SubTotal</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody class="tablita">

            </tbody>

          </table>

        </div>
      </section>
      <input type="hidden" id="listaProductos" name="listaProductos">
      <div class="saleCalculations">

        <div class="col-xs-8 pull-right">
          <table class="table tablaD">
            <thead>
              <tr class="thead_tableD">
                <th class="total-texto">Descuento %</th>
                <th class="total-texto">Impuesto %</th>
                <th class="total-texto">SubTotal</th>
                <th class="total-texto">Total</th>
              </tr>
            </thead>

            <tbody>
              <tr class="tbody_tableD">
                <!--DESCUENTO DE VENTA-->
                <td>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg" id="nuevoDescuentoVenta" name="nuevoDescuentoVenta" value=0 min=0 max=100 required>
                    <input type="hidden" name="descuentoVenta" id="descuentoVenta">
                  </div>
                </td>
                <!--IMPUESTO DE VENTA-->
                <td>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value=0 min=0 max=100 required>
                    <input type="hidden" name="impuestoVenta" id="impuestoVenta">
                  </div>
                </td>
                <!--SUBTOTAL DE VENTA-->
                <td>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg" id="nuevoSubTotalVenta" name="nuevoSubTotalVenta" value=0 min=0 max=100000000 readonly>
                  </div>
                </td>
                <!--TOTAL DE VENTA-->
                <td>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" value=0 min=0 max=100000000 readonly>
                  </div>
                </td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="botonesVenta">

        <a href="ventas">

          <button type="button" class="btn1 btnVentaCancelar">Cancelar</button>



          <button type="submit" class="btn1  btnVentaGuardar">Guardar</button>
        </a>
      </div>

    </div>
  </form>
  <?php

  $crearVenta = new ControladorVentas();
  $crearVenta->ctrCrearVenta();
  ?>


</div>

<!--MODAL PARA AGREGAR USUARIO-->


<div class="modal fade" id="modalAddClient" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header modalHeaderColor" >
          <h4 class="modal-title">Agregar Cliente</h4>
        </div>

        </br>
        <div class="modal-body">

          <div class="box-body modalCli">

            <!--AGREGAR DE CEDULA-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="cedula" style="border-radius: 5px;" placeholder="Ingresar cédula" required>
                <input type="hidden" id="clientId">
              </div>

            </div>

            <!--AGREGAR DE NOMBRE DE CLIENTE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nomCliente" style="border-radius: 5px;" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!--AGREGAR DE APELLIDOS-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="apellidos" style="border-radius: 5px;" placeholder="Ingresar apellidos " required>

              </div>

            </div>



            <!--AGREGAR DE TELEFONO DEL CLIENTE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="telefonoCli" style="border-radius: 5px;" placeholder="Ingresar número de telefono" required>

              </div>

            </div>

            <!--AGREGAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="email" style="border-radius: 5px;" placeholder="Ingresar correo electrónico" required>

              </div>

            </div>


            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="direccion" style="border-radius: 5px;" placeholder="Ingresar dirección " required>

              </div>

            </div>




          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
        </div>

        <?php

        $addClient = new ControllerClient;
        $addClient->ctrCreateClient();

        ?>

      </form>
    </div>
  </div>
</div>