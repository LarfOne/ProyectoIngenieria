<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/activos.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id= "container pt-4" style="margin-top: 100px;">

  <div class="container mt-3">
      <h2 class="correrIzquierda" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Activos</h2>
      
      <button class="btn btn-primary btnAgregarAct correrIzquierda" data-bs-toggle="modal" data-bs-target="#modalAddActivo" style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">
            Agregar Activos
        </button>

        <div class="table-responsive roboto correrIzquierda">
          <table class="table" id="tabla" data-sort="table">
            <thead>
                  <tr>
                        <th>Codigo</th>
                        <th>Sucursal</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Empleado</th>
                        <th>Acciones</th>
                      
                  </tr>
            </thead>

            <tbody>

                  <?php
                  $item = null;
                  $valor = null;
                  
                  $activos = ControllerActivos::ctrShowActivo($item, $valor);
            

            foreach($activos as $key => $activo) {
              $sucursal = ControllerSucursal::ctrNameSucursal($activo['idSucursal']);
              $user = ControllerUser::ctrNameUser($activo['empleado_id'])?>
            <tr>

                <td><?php echo $activo['codigo']; ?></td>
                <td><?php echo $sucursal['nombre']; ?></td>
                <td><?php echo $activo['descripcion']; ?></td>
                <td><?php echo $activo['estado']; ?></td>
                

                <?php if ($activo['empleado_id']!=NULL) { ?>
                  <td><?php echo $user['nombre']." ".$user['apellidos']; ?></td>
                <?php } ?>

                <?php if ($activo['empleado_id']==NULL) { ?>
                <td>Libre</td>
                <?php } ?>




  


                <td>

                  <div class="btn-group">
                      <button style="margin: 5px" class="btn btn-warning btnUpdate btnUpdateActivo" codigo=<?php echo $activo['codigo']; ?>
                      data-bs-toggle="modal" data-bs-target="#modalUpdateActivo"><i class="fa fa-pencil"></i></button>
                      
                      <button style="margin: 5px" class="btn btn-danger btnDelete btnDeleteActivo" codigo=<?php echo $activo['codigo']; ?>
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

</div>


<!--MODAL PARA AGREGAR ACTIVOS-->


<div class="modal fade" id="modalAddActivo" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header modalHeaderColor">
          <h4 class="modal-title">Agregar Activos</h4>
        </div>

    </br>
        <div class="modal-body">

          <div class="box-body modalAct">

            <!--AGREGAR id de sucursal-->

            <?php
                  $item = null;
                  $valor = null;
                  $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
            ?>

            <div class="form-group">

              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-building"></i></span>
                  <!--<input type="text" class="form-control input-lg" name="idSucursal" placeholder="Ingresar id de sucursal" required>-->
                  <select class="form-control input-lg" id="idSucursal" style="border-radius: 5px;" name="idSucursal">
                              <?php foreach ($sucursal as $sucursal1) { ?>
                                    <option value=<?php echo $sucursal1['codigo'] ?>><?php echo $sucursal1['nombre'] ?></option>
                              <?php } ?>
                  </select>
              </div>

            </div>

            <!--AGREGAR DE Descripcion-->
            <div class="form-group">

              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map"></i></span>
                  <input type="text" style="border-radius: 5px;" class="form-control input-lg" name="descripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>

            <!--AGREGAR DE estado-->
            <div class="form-group">

              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" style="border-radius: 5px;" class="form-control input-lg" name="estado" placeholder="Ingresar estado" required>

              </div>

            </div>

            <?php
                  $item = null;
                  $valor = null;
                  $user = ControllerUser::ctrShowUser($item, $valor);
            ?>

            <!--AGREGAR DE empleadoid-->
            <div class="form-group">

              <div class="input-group">

                  <span style="border-radius: 5px;" class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <!--<input type="text" class="form-control input-lg" name="empleado_id" placeholder="Ingresar cédula del empleado">-->
                  <select class="form-control input-lg" id="empleado_id" name="empleado_id" style="border-radius: 5px;">
                            <?php foreach ($user as $user1) { ?>

                              <?php if ($user1['estado']!='Inactivo') { ?>

                                <option value=<?php echo $user1['cedula'] ?>><?php echo $user1['nombre']." ".$user1['apellidos'] ?></option>

                                <?php } ?>                                
                            <?php } ?>
                  </select>

              </div>

            </div>


          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
        </div>

        <?php

          $addActivo = new ControllerActivos;
          $addActivo->ctrCreateActivo();

        ?>

      </form>
      
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR SUCURSAL ***************************-->

<div class="modal fade" id="modalUpdateActivo" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header modalHeaderColor" >
          <h4 class="modal-title">Editar Activos</h4>
        </div>


        <div class="modal-body">

          <div class="box-body modalAct">

                        <!--MODIFICAR DE Codigo-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" style="border-radius: 5px;" class="form-control input-lg" id="codigom" name="codigom" value="Ingresar el codigo" readonly>
                            </div>

                        </div>

                        <!--MODIFCAR DE id sucursal-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                <!--<input type="text" class="form-control input-lg" id="idSucursalm" name="idSucursalm" value="Ingresar id de sucursal" required>-->
                                <select class="form-control input-lg" id="idSucursalm" name="idSucursalm" style="border-radius: 5px;">
                                  <?php foreach ($sucursal as $sucursal1) { ?>
                                        <option value=<?php echo $sucursal1['codigo'] ?>><?php echo $sucursal1['nombre'] ?></option>
                                  <?php } ?>
                                </select>

                            </div>

                        </div>

                        <!--MODIFICAR DE Descripcion-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                <input type="text" class="form-control input-lg" id="descripcionm" name="descripcionm" style="border-radius: 5px;" value="Ingresar descripción" required>

                            </div>

                        </div>


                        <!--MODIFICAR DE estado-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" id="estadom" name="estadom" style="border-radius: 5px;" value="Ingresar estado" required>

                            </div>

                        </div>
                        
                        <!--MODIFICAR DE empleado_id-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <!--<input type="text" class="form-control input-lg" id="empleado_idm" name="empleado_idm" value="Ingresar cédula del empleado" required>-->
                                <select class="form-control input-lg" id="empleado_idm" name="empleado_idm" style="border-radius: 5px;">
                                          <?php foreach ($user as $user1) { ?>
                                              <?php if ($user1['estado']!='Inactivo') { ?>
                                                <option value=<?php echo $user1['cedula'] ?>><?php echo $user1['nombre']." ".$user1['apellidos'] ?></option>
                                              <?php } ?>
                                          <?php } ?>
                                </select>
                            </div>

                        </div>

          </div>

        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
            </div>

            <?php
                $updateActivo = new ControllerActivos;
                $updateActivo->ctrUpdateActivo();

            ?>

      </form>
    </div>
  </div>
</div>

<?php
  
  $deleteActivo = new ControllerActivos;

  $deleteActivo -> ctrDeleteActivo() ;

?>
