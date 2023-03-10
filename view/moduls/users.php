<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">  
<link rel="stylesheet" href="css/style.css">  

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id= "container pt-4" style="margin-top: 100px;">

  <div class="container mt-3 fondoUser">
    <h2 class="cUser" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Usuario</h2>

    <div class="tablaUs" >
      <button class="btn btn-primary btnAgregarU" style="margin:0px, 0px, 100px, 100px !important" data-bs-toggle="modal" data-bs-target="#modalAddUser" style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">
          Agregar Usuario
      </button>
      
      <div class="table-responsive roboto rU">
          <table class="table tableU" id="tabla" data-sort="table">
            <thead>
                <tr>
                  <th >Cedula</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>C.C</th>
                  <th>Sucursal</th>
                  <th>direccion</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                      
                </tr>
            </thead>

            <tbody>

              <?php
              $item = null;
              $valor = null;
      
              $empleados = ControllerUser::ctrShowUser($item, $valor);
      

              foreach($empleados as $key => $empleado1) { ?>
              
              <tr>

                <td><?php echo $empleado1['cedula']; ?></td>
                <td><?php echo $empleado1['nombre']; ?></td>
                <td><?php echo $empleado1['apellidos']; ?></td>
                <td><?php echo $empleado1['email']; ?></td>
                <td><?php echo $empleado1['role']; ?></td>
                <td><?php echo $empleado1['cuentaBancaria']; ?></td>
                <td><?php echo $empleado1['idSucursal']; ?></td>
                <td><?php echo $empleado1['direccion']; ?></td>
                <?php 
                
                if($empleado1['image'] != null){?>
                  <td><img src="<?php echo $empleado1['image']; ?>" class="img-thumbnail" width="40px"></td>
                  <?php } ?>
                  <?php
                  if($empleado1['image'] == null){?>
                  <td><img src="imagen/userDefault.png" class="img-thumbnail" width="40px"></td>
                  <?php } ?>
                
                <td>
                  <div class="btn-group">
                      <button  class="btn btn-warning btnUpdate btnUpdateUser" idEmpleado = <?php echo $empleado1['cedula']; ?>
                      data-bs-toggle="modal" data-bs-target="#modalUpdateUser"><i class="fa fa-pencil"></i></button>
                      
                      <button  class="btn btn-danger btnDelete btnDeleteUser" idEmpleado = <?php echo $empleado1['cedula']; ?>
                      ><i class="fa fa-times background-color: #FF0038;"></i></button>
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


<div class="modal fade" id="modalAddUser" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content ">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Agregar Usuario</h4>
        </div>

        <div class="modal-body">

          <div class="box-body modalC">

            <!--AGREGAR DE Cedula-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="idUser" placeholder="Ingresar c??dula" required>
                
              </div>

            </div>

            <!--AGREGAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nameUser" placeholder="Ingresar nombre" required>
                <input type="hidden" id="userId">
              </div>

            </div>

            <!--AGREGAR DE APELLIDO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="lastNameUser" placeholder="Ingresar apellidos" required>

              </div>

            </div>


            <!--AGREGAR DE sucursal-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-lg" name="sucursalUser" placeholder="Ingresar sucursal a la que pertenece" required>

              </div>

            </div>

            <!--AGREGAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control input-lg" name="emailUser" placeholder="Ingresar correo electr??nico" required>

              </div>

            </div>

            <!--AGREGAR DE ROLE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="roleUser">

                  <option value="">Selecionar Perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Usuario">Usuario</option>

                </select>

              </div>

            </div>

            <!--AGREGAR DE PASSWORD-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="passwordUser" placeholder="Ingresar contrase??a" required>

              </div>

            </div>

            <!--AGREGAR DE CUENTA BANCARIA-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
                <input type="text" class="form-control input-lg" name="cuentaUser" placeholder="Ingresar cuenta bancaria" required>

              </div>

            </div>

            <!--AGREGAR DE DIRECCION-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="directionUser" placeholder="Ingresar direcci??n" required>

              </div>

            </div>

            <!--AGREGAR DE FOTO-->
            <div class="form-group subirFoto">

              <span class="input-group-addon iconoFoto"><i class="fa fa-user-circle-o"></i> Subir Foto x</span>

                  <input type="file" class="image" name="image">

                  <p class="help-block pesoText">Peso maximo de la foto 10MB</p>
                
              <img src="imagen/userDefault.png" class="img-thumbnail imageTemp" width="100px">
              

            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Guardar</button>
        </div>

            <?php

              $addUser = new ControllerUser;
              $addUser -> ctrCreateUser();

            ?>

      </form>
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR USUARIO ***************************-->

<div class="modal fade" id="modalUpdateUser" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Editar Usuario</h4>
        </div>


        <div class="modal-body">

          <div class="box-body">

            <!--MODIFICAR DE Cedula-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="idUserm" name="idUserm" value="" readonly>
                

              </div>

            </div>

            <!--MODIFCAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nameUserm" name="nameUserm" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!--MODIFICAR DE APELLIDO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="lastNameUserm" name="lastNameUserm" value="Ingresar apellidos" required>

              </div>

            </div>


            <!--MODIFICAR DE sucursal-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="sucursalUserm" name="sucursalUserm" value="Ingresar sucursal a la que pertenece" required>

              </div>

            </div>

            <!--MODIFICAR DE EMAIL-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="emailUserm" name="emailUserm" value="Ingresar correo electr??nico" required>

              </div>

            </div>

            <!--MODIFICAR DE ROLE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="roleUserm" name="roleUserm">

                  <option value="">Seleccionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Usuario">Usuario</option>

                </select>

              </div>

            </div>

            <!--MODIFICAR DE PASSWORD-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                
                <input type="password" class="form-control input-lg" id="passwordUserm" name="passwordUserm" placeholder="Ingresar la nueva contrasena">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>

            <!--MODIFICAR DE PASSWORD
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                
                <input type="text" class="form-control input-lg" id="passwordActual" name="passwordActual" value="Ingresar la nueva contrasena" required>
                
              </div>
            </div>
-->

            <!--MODIFICAR DE CUENTA BANCARIA-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="cuentaUserm" name="cuentaUserm" value="Ingresar cuenta bancaria" required>
                
              </div>

            </div>

            <!--MODIFICAR DE DIRECCION-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="directionUserm" name="directionUserm" value="Ingresar direcci??n" required>

              </div>

            </div>

            <!--MODIFICAR DE FOTO-->
            <div class="form-group">

              <div class="panel">Subir Foto</div>
              <input type="file" class="image" name="imageUpdate">

              <p class="help-block">Peso maximo de la foto 10MB</p>
              <img src="imagen/userDefault.png" class="img-thumbnail imageTemp" width="100px">
              
              <input type = "hidden" name="fotoActual" id = "fotoActual">

            </div>

          </div>

        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
            </div>

            <?php
                $updateUser = new ControllerUser;
                $updateUser -> ctrUpdateUser();

            ?>

      </form>
    </div>
  </div>
</div>

<?php
  
  

  $deleteUser = new ControllerUser;

  $deleteUser -> ctrDeleteUser();

?>

