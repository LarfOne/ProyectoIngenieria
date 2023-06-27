<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/clients.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id="container pt-4" style="margin-top: 100px;">

  <div class="container mt-3">
    <h2 class="correrIzquierda" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Clientes</h2>

    <button class="btn btn-primary btnAgregarCli correrIzquierda" data-bs-toggle="modal" data-bs-target="#modalAddClient" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">
        Agregar Cliente

    </button>
    <div class="box-body">
      <div class="table-responsive roboto correrIzquierda">
        <table class="table tableMostrar" id="tabla" data-sort="table">
          <thead>
            <tr>
              <th>Cedula</th>
              <th>Nombre Completo</th>
              <th>Telefono Cliente</th>
              <th>Email</th>
              <th>Direccion</th>
              <th>Acciones</th>

            </tr>
          </thead>

          <tbody>

            <?php
            $item = null;
            $valor = null;

            $client = ControllerClient::ctrShowClient($item, $valor);


            foreach ($client as $key => $client1) { ?>
              <tr>

                <td><?php echo $client1['cedula']; ?></td>
                <td><?php echo $client1['nomCliente']; ?></td>
                <td><?php echo $client1['telefonoCli']; ?></td>
                <td><?php echo $client1['email']; ?></td>
                <td><?php echo $client1['direccion']; ?></td>
                <td>

                  <div class="btn-group">
                    <button style="margin: 5px" class="btn btn-warning btnUpdate btnUpdateClient" idClient=<?php echo $client1['cedula']; ?> data-bs-toggle="modal" data-bs-target="#modalUpdateClient"><i class="fa fa-pencil"></i></button>

                    <button style="margin: 5px" class="btn btn-danger btnDelete btnDeleteClient" codigoC=<?php echo $client1['cedula']; ?>><i class="fa fa-times"></i></button>
                  </div>

                </td>


              </tr>

            <?php } ?>


          </tbody>

        </table>
      </div>
    </div>
  </div>

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
                <input type="text" class="form-control input-lg" id="idCliente" name="idCliente" style="border-radius: 5px;" placeholder="Ingresar cédula o cedula juridica" required>
                <input type="hidden" id="clientId">
              </div>

            </div>

            <!--AGREGAR DE NOMBRE DE CLIENTE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nomCliente" name="nomCliente" style="border-radius: 5px;" placeholder="Ingresar nombre completo" required>

              </div>

            </div>

            <!--AGREGAR DE TELEFONO DEL CLIENTE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" id="telefonoCli" name="telefonoCli" style="border-radius: 5px;" placeholder="Ingresar número de telefono" required>

              </div>

            </div>

            <!--AGREGAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" id="email" name="email" style="border-radius: 5px;" placeholder="Ingresar correo electrónico" required>

              </div>

            </div>


            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" id="direccion" name="direccion" style="border-radius: 5px;" placeholder="Ingresar dirección" required>

              </div>

            </div>




          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
        </div>

        <?php
            $direccion = "cliente";
            $addClient = new ControllerClient;
            $addClient->ctrCreateClient($direccion);

        ?>

      </form>
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR CLIENTE ***************************-->

<div class="modal fade" id="modalUpdateClient" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header modalHeaderColor" >
          <h4 class="modal-title">Editar Cliente</h4>
        </div>


        <div class="modal-body">

          <div class="box-body modalCli">

            <!--MODIFICAR DE CEDULA-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="idClientem" name="idClientem" style="border-radius: 5px;" placeholder="Editar cédula o cedula juridica" readonly required>


              </div>

            </div>

            <!--MODIFCAR DE NOMBRE DE CLIENTE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nomClientem" name="nomClientem" style="border-radius: 5px;" placeholder="Editar nombre" required>

              </div>

            </div>

            <!--MODIFICAR DE TELEFONO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" id="telefonoClim" name="telefonoClim" style="border-radius: 5px;" placeholder="Editar número de teléfono" required>

              </div>

            </div>

            <!--MODIFICAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" id="emailm" name="emailm" style="border-radius: 5px;" placeholder="Editar correo electrónico" required>

              </div>

            </div>

            <!--MODIFICAR DE DIRECCION-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" id="direccionm" name="direccionm" style="border-radius: 5px;" placeholder="Editar dirección" required>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
        </div>

        <?php
        $updateClient = new ControllerClient;
        $updateClient->ctrUpdateClient();

        ?>

      </form>
    </div>
  </div>
</div>

<?php

$deleteClient = new ControllerClient;

$deleteClient->ctrDeleteClient();

?>