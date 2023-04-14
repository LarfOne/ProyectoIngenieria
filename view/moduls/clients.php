<link rel="stylesheet" href="css/boton.css">
<<<<<<< HEAD
<link rel="stylesheet" href="css/clients.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    
=======
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
>>>>>>> origin/laryBranch

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id="container pt-4" style="margin-top: 100px;">

  <div class="container mt-3">
    <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Clientes</h2>

<<<<<<< HEAD
    <button class="btn btn-primary btnAgregarCli" data-bs-toggle="modal" data-bs-target="#modalAddClient" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">
        Agregar Cliente
=======
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddClient" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">
      Agregar Cliente
>>>>>>> origin/laryBranch
    </button>
    <div class="box-body">
      <div class="table-responsive roboto">
        <table class="table" id="tabla" data-sort="table">
          <thead>
            <tr>
              <th>Cedula</th>
              <th>Nombre</th>
              <th>Apellidos</th>
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
                <td><?php echo $client1['apellidos']; ?></td>

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

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Agregar Cliente</h4>
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
                <input type="text" class="form-control input-lg" name="email" style="border-radius: 5px;" placeholder="Ingresar correo electrónico" required>

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
          <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
        </div>

        <?php

        $addClient = new ControllerClient;
        $addClient->ctrCreateClient();

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

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Editar Cliente</h4>
        </div>


        <div class="modal-body">

          <div class="box-body modalCli">

            <!--MODIFICAR DE CEDULA-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="cedulam" name="cedulam" style="border-radius: 5px;" value="Ingresar Cedula" readonly>


              </div>

            </div>

            <!--MODIFCAR DE NOMBRE DE CLIENTE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nomClientem" name="nomClientem" style="border-radius: 5px;" value="Ingresar nombre" required>

              </div>

            </div>




            <!--MODIFICAR DE APELLIDOS-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="apellidosm" name="apellidosm" style="border-radius: 5px;" value="Ingresar los apellidos" required>

              </div>

            </div>



            <!--MODIFICAR DE TELEFONO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="telefonoClim" name="telefonoClim" style="border-radius: 5px;" value="Ingresar número de teléfono" required>

              </div>

            </div>

            <!--MODIFICAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="emailm" name="emailm" style="border-radius: 5px;" value="Ingresar correo electrónico" required>

              </div>

            </div>

            <!--MODIFICAR DE DIRECCION-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="direccionm" name="direccionm" style="border-radius: 5px;" value="Ingresar dirección" required>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
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