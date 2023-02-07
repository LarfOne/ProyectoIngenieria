<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div class= "contenedor">

<div class="container mt-3">
  <h2>Control de Sucursal</h2>

    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddSucursal">
        Agregar Sucursal
    </button>

  <table class="table" id="tabla" data-sort="table">
    <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                    
                </tr>
                </thead>

        <tbody>

                <?php
                $item = null;
                $valor = null;
                
                $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
          

          foreach($sucursal as $key => $sucursal1) { ?>
          <tr>

              <td><?php echo $sucursal1['codigo']; ?></td>
              <td><?php echo $sucursal1['nombre']; ?></td>
              <td><?php echo $sucursal1['direccion']; ?></td>
              <td><?php echo $sucursal1['telefono']; ?></td>
              <td><?php echo $sucursal1['email']; ?></td>

              <td>

                <div class="btn-group">
                    <button style="margin: 5px" class="btn btn-warning btnUpdate btnUpdateSucursal" idSucursal = <?php echo $sucursal1['codigo']; ?>
                    data-toggle="modal" data-target="#modalUpdateSucursal"><i class="fa fa-pencil"></i></button>
                    
                    <button style="margin: 5px" class="btn btn-danger btnDelete btnDeleteSucursal" codigoM = <?php echo $sucursal1['codigo']; ?>
                    ><i class="fa fa-times"></i></button>
                </div>

              </td>


          </tr>

          <?php } ?>

        </tbody>

    </table>
  </div>
</div>

</div>


<!--MODAL PARA AGREGAR USUARIO-->


<div class="modal fade" id="modalAddSucursal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Sucursal</h4>
        </div>

    </br>
        <div class="modal-body">

          <div class="box-body">

            <!--AGREGAR DE CODIGO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="idSucursal" placeholder="Ingresar código de la sucursal" required>
                
              </div>

            </div>

            <!--AGREGAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nameSucursal" placeholder="Ingresar nombre" required>
                <input type="hidden" id="sucursalId">
              </div>

            </div>

            <!--AGREGAR DE DIRECCION-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="direccionSucursal" placeholder="Ingresar dirección" required>

              </div>

            </div>


            <!--AGREGAR DE TELEFONO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="telefonoSucursal" placeholder="Ingresar numero de telefono " required>

              </div>

            </div>

            <!--AGREGAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control input-lg" name="emailSucursal" placeholder="Ingresar correo electrónico" required>

              </div>

            </div>  

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
        </div>

            <?php

              $addSucursal = new ControllerSucursal;
              $addSucursal -> ctrCreateSucursal();

            ?>

      </form>
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR SUCURSAL ***************************-->

<div class="modal fade" id="modalUpdateSucursal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Editar Sucursal</h4>
        </div>


        <div class="modal-body">

          <div class="box-body">

            <!--MODIFICAR DE CODIGO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="idSucursalm" name="idSucursalm" value="" readonly>
                

              </div>

            </div>

            <!--MODIFCAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nameSucursalm" name="nameSucursalm" value="Ingresar nombre" required>

              </div>

            </div>

            <!--MODIFICAR DE DIRECCION-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="direccionSucursalm" name="direccionSucursalm" value="Ingresar la direccion" required>

              </div>

            </div>


            <!--MODIFICAR DE TELEFONO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="telefonoSucursalm" name="telefonoSucursalm" value="Ingresar el numero de telefono" required>

              </div>

            </div>

            <!--MODIFICAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="emailSucursalm" name="emailSucursalm" value="Ingresar correo electrónico" required>

              </div>

            </div>

          </div>

        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
            </div>

            <?php
                $updateSucursal = new ControllerSucursal;
                $updateSucursal -> ctrUpdateSucursal();

            ?>

      </form>
    </div>
  </div>
</div>

<?php
  
  $deleteSucursal = new ControllerSucursal;

  $deleteSucursal -> ctrDeleteSucursal() ;

?>




