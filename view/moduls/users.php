<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/user.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id="container pt-4" style="margin-top: 100px;">
  <div class="container mt-3">
    <h2 class="cUser" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Usuario</h2>
    <div class="tablaUs">
      <button class="btn btn-primary btnAgregarU correrIzquierda" style="margin:0px, 0px, 100px, 100px !important" data-bs-toggle="modal" data-bs-target="#modalAddUser" style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">
        Agregar Usuario
      </button>
      <div class="table-responsive roboto correrIzquierda ">
        <table class="table tableU" id="tabla" data-sort="table">
          <thead>
            <tr>
              <th>Cedula</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Email</th>
              <th>Role</th>
              <th>C.C</th>
              <th>Sucursal</th>
              <th>Direccion</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;
            $empleados = ControllerUser::ctrShowUser($item, $valor);
            foreach ($empleados as $key => $empleado1) {
              $sucursal = ControllerSucursal::ctrNameSucursal($empleado1['idSucursal']) ?>
              <tr>
                <td><?php echo $empleado1['cedula']; ?></td>
                <td><?php echo $empleado1['nombre']; ?></td>
                <td><?php echo $empleado1['apellidos']; ?></td>
                <td><?php echo $empleado1['email']; ?></td>
                <td><?php echo $empleado1['role']; ?></td>
                <td><?php echo $empleado1['cuentaBancaria']; ?></td>
                <td><?php echo $sucursal['nombre']; ?></td>
                <td><?php echo $empleado1['direccion']; ?></td>
                <?php
                if ($empleado1['estado'] == 'Activo') { ?>
                  <td style=" padding: 5px !important;margin: 5% auto; ">✔️</td>
                <?php } ?>
                <?php
                if ($empleado1['estado'] == 'Inactivo') { ?>
                  <td>❌</td>
                <?php } ?>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnUpdate btnUpdateUser" idEmpleado=<?php echo $empleado1['cedula']; ?> data-bs-toggle="modal" data-bs-target="#modalUpdateUser"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnDelete btnDeleteUser" idEmpleado=<?php echo $empleado1['cedula']; ?>><i class="fa fa-times background-color: #FF0038;"></i></button>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
  </div>
</div>
<!--Este input es para obtener el role del usuario que esta logeado para poder editar-->
<input type="hidden" id="sessionRole" name="sessionRole" value=<?php echo $_SESSION["role"]; ?> >

<!--MODAL PARA AGREGAR USUARIO-->



<div class="modal fade" id="modalAddUser" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content ">
        <form role="form" method="POST" enctype="multipart/form-data">
          <div class="modal-header modalHeaderColor">
            <h4 class="modal-title">Agregar Usuario</h4>
          </div>
          <div class="modal-body">
            <div class="box-body modalC">
              <!--AGREGAR DE Cedula-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" style="border-radius: 5px;" data-bs-toggle="tooltip" title="El número de cédula debe tener máximo 10 dígitos." class="form-control input-lg" id="idUser" name="idUser" placeholder="Ingresar cédula" >
                </div>
              </div>
              <!--AGREGAR DE NOMBRE-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" style="border-radius: 5px;" data-bs-toggle="tooltip" title="El nombre debe tener máximo 45 dígitos." class="form-control input-lg" id="nameUser" name="nameUser" placeholder="Ingresar el nombre" >
                  
                </div>
              </div>
              <!--AGREGAR DE APELLIDO-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" style="border-radius: 5px;" data-bs-toggle="tooltip" title="El apellido debe tener máximo 45 dígitos." class="form-control input-lg" id="lastNameUser" name="lastNameUser" placeholder="Ingresar apellidos" >
                </div>
              </div>
              <?php
              $item = null;
              $valor = null;
              $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
              ?>
              <!--AGREGAR DE sucursal-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="border-radius: 5px;"><i class="fa fa-building"></i></span>
                  <!--<input type="text" class="form-control input-lg" name="sucursalUser" placeholder="Ingresar sucursal a la que pertenece" required>-->
                  <select class="form-select input-lg" id="sucursalUser" name="sucursalUser" >
                    <option value="">Seleccionar sucursal.</option>
                    <?php foreach ($sucursal as $sucursal1) { ?>
                      <option value=<?php echo $sucursal1['codigo'] ?>><?php echo $sucursal1['nombre'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!--AGREGAR DE EMAIL-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" style="border-radius: 5px;" class="form-control input-lg" id="emailUser" name="emailUser" placeholder="Ingresar correo electrónico" >
                </div>
              </div>
              <?php
                if ($_SESSION["role"] == "Administrador" || $_SESSION["role"] == "Usuario") { ?>
              <!--AGREGAR DE ROLE-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-select input-lg" style="border-radius: 5px;" id="roleUser" name="roleUser" >
                    <option value="">Selecionar Perfil.</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php
                if ($_SESSION["role"] == "SuperAdmin") { ?>
              <!--AGREGAR DE ROLE-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-select input-lg" style="border-radius: 5px;" id="roleUser" name="roleUser" >
                    <option value="">Selecionar Perfil.</option>
                    <option value="SuperAdmin">Super Administrador</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                  </select>
                </div>
              </div>
              <?php } ?>
              <!--AGREGAR DE PASSWORD-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" style="border-radius: 5px;" class="form-control input-lg" id="passwordUser" name="passwordUser" placeholder="Ingresar contraseña" >  
                </div>
                <p id="password-error" style="color: red; font-size: 12px; display: none;">La contraseña debe tener al menos 8 caracteres.</p>
              </div>
              <!--AGREGAR DE CUENTA BANCARIA-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
                  <input type="text" style="border-radius: 5px;" class="form-control input-lg" id="cuentaUser" name="cuentaUser" placeholder="Ingresar cuenta bancaria" >
                </div>
              </div>
              <!--AGREGAR DE TELEFONO-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input type="text" class="form-control input-lg" id="telefonoUser" name="telefonoUser" placeholder="Ingresar el telefono" required>
                </div>
              </div>
              <!--AGREGAR DE DIRECCION-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input type="text" style="border-radius: 5px;" class="form-control input-lg" id="directionUser" name="directionUser" placeholder="Ingresar dirección" >
                </div>
              </div>
              <!--AGREGAR ESTADO-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                  <select class="form-select input-lg" id="estadoUser" id="estadoUser" name="estadoUser" >
                    <option value="">Seleccionar estado.</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                  </select>
                </div>
              </div>
              <!--AGREGAR DE FOTO-->
              <div class="form-group subirFoto">
                <span class="input-group-addon iconoFoto"><i class="fa fa-user-circle-o"></i> Subir Foto x</span>
                <input type="file" class="imageUser" id="imageUser" name="imageUser">
                <p class="help-block pesoText">Peso maximo de la foto 10MB</p>
                <img src="imagen/userDefault.png" class="img-thumbnail imageTemp" width="100px">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left"  data-bs-dismiss="modal" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Salir</button>
            <button type="submit" class="btn btn-success pull-right" data-dismiss="modal" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Guardar</button>
          </div>
          <?php
          $addUser = new ControllerUser;
          $addUser->ctrCreateUser();
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
          <div class="modal-header modalHeaderColor">
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <div class="modal-body">
            <div class="box-body modalC">
              <!--MODIFICAR DE Cedula-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" id="idUserm" name="idUserm" readonly required>
                </div>
              </div>
              <!--MODIFCAR DE NOMBRE-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" data-bs-toggle="tooltip" title="Nombre del empleado" class="form-control input-lg" id="nameUserm" name="nameUserm" placeholder="Ingresar nombre" required>
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
                <span class="input-group-addon" style="border-radius: 5px;"><i class="fa fa-building"></i></span>
                    <!--<input type=" text" class="form-control input-lg" id="sucursalUserm" name="sucursalUserm" value="Ingresar sucursal a la que pertenece" required>-->
                      <select class="form-select input-lg" id="sucursalUserm" name="sucursalUserm" required>
                        <option value="">Seleccionar sucursal.</option>
                        <?php foreach ($sucursal as $sucursal1) { ?>
                          <option value=<?php echo $sucursal1['codigo'] ?>><?php echo $sucursal1['nombre'] ?></option>
                        <?php } ?>
                      </select>
                </div>
              </div>
              <!--MODIFICAR DE EMAIL-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" id="emailUserm" name="emailUserm" placeholder="Ingresar correo electrónico" required>
                </div>
              </div>
              <?php
                if ($_SESSION["role"] == "Administrador" || $_SESSION["role"] == "Usuario") { ?>
              <!--MODIFICAR DE ROLE-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-select input-lg" style="border-radius: 5px;" id="roleUserm" name="roleUserm" required>
                    <option value="">Selecionar Perfil.</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php
                if ($_SESSION["role"] == "SuperAdmin") { ?>
              <!--MODIFICAR DE ROLE-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select class="form-select input-lg" style="border-radius: 5px;" id="roleUserm" name="roleUserm" required>
                    <option value="">Selecionar Perfil.</option>
                    <option value="SuperAdmin">Super Administrador</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                  </select>
                </div>
              </div>
              <?php } ?>
              <!--MODIFICAR DE PASSWORD-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" style="border-radius: 5px;" class="form-control input-lg" id="passwordUserm" name="passwordUserm" placeholder="Ingresar la nueva contraseña">
                  <input type="hidden" id="passwordActual" name="passwordActual">
                </div>
                <p id="password-errorm" style="color: red; font-size: 12px; display: none;">La contraseña debe tener al menos 8 caracteres.</p>
              </div>
              <!--MODIFICAR DE CUENTA BANCARIA-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-credit-card-alt"></i>
                  </span>
                  <input type="text" class="form-control input-lg" id="cuentaUserm" name="cuentaUserm" placeholder="Ingresar cuenta bancaria" required>
                </div>
              </div>
              <!--MODIFICAR DE TELEFONO-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input type="text" class="form-control input-lg" id="telefonoUserm" name="telefonoUserm" placeholder="Ingresar el telefono" required>
                </div>
              </div>
              <!--MODIFICAR DE DIRECCION-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input type="text" class="form-control input-lg" id="directionUserm" name="directionUserm" placeholder="Ingresar dirección" required>
                </div>
              </div>
              <!--MODIFICAR DE ESTADO-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                  <select class="form-select input-lg" id="estadoUserm" name="estadoUserm" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                  </select>
                </div>
              </div>
              <!--MODIFICAR DE FOTO-->
              <div class="form-group">
                <span class="input-group-addon iconoFoto"><i class="fa fa-user-circle-o"></i> Subir nueva foto</span>
                <input type="file" class="imageUser" id="imageUpdateUser" name="imageUpdateUser">
                <p class="help-block">Peso maximo de la foto 10MB</p>
                <img src="imagen/userDefault.png" class="img-thumbnail imageTemp" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-success pull-right" id="btnModificarUser" data-dismiss="modal">Guardar</button>
          </div>
          <?php
          $updateUser = new ControllerUser;
          $updateUser->ctrUpdateUser();
          if ($_SESSION["estado"] == "Inactivo") {
            session_destroy();
            echo '<script>
                  window.location = "ingreso"
                  </script>';
          }
          ?>
        </form>
    </div>
  </div>
</div>

  
  <?php
  $deleteUser = new ControllerUser;
  $deleteUser->ctrDeleteUser();
  ?>