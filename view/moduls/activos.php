<link rel="stylesheet" href="css/boton.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id="container pt-4" style="margin-top: 80px;">
    <div class="container mt-3">
        <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Activos</h2>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddActivo" style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">
            Agregar Activos
        </button>
        <div class="box-body">
        <div class="table-responsive roboto">
        <table id="tabla" class="table"  data-sort="table">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>id Sucursal</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Empleado id</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $item = null;
                    $valor = null;

                    $activos = ControllerActivos::ctrShowActivo($item, $valor);


                    foreach ($activos as $key => $activo) { ?>
                        <tr>


                        <?php $sucursal = ControllerSucursal::ctrNameSucursal($activo['idSucursal']);
                        $empleado = ControllerUser::ctrNameUser($activo['empleado_id']);
                             ?>

                            <td><?php echo $activo['codigo']; ?></td>
                            <td><?php echo $activo['idSucursal']; ?></td>
                            <td><?php echo $activo['descripcion']; ?></td>
                            <td><?php echo $activo['estado']; ?></td>
                            <td><?php echo $activo['empleado_id']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button style="margin: 5px" class="btn btn-warning btnUpdate btnUpdateActivo" codigo=<?php echo $activo['codigo']; ?>
                                     data-toggle="modal fade" data-target="#modalUpdateActivo"><i class="fa fa-pencil"></i></button>

                                    <button style="margin: 5px" class="btn btn-danger btnDelete btnDeleteActivo" codigo=<?php echo $activo['codigo']; ?>>
                                    <i class="fa fa-times"></i></button>
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


<!--MODAL PARA AGREGAR Activos-->


<div class="modal fade" id="modalAddActivo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">


            <form role="form" method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Agregar Activo</h4>
                </div>

                </br>
                <div class="modal-body">

                    <div class="box-body">

                        <!--AGREGAR DE codigo-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg" name="codigo" placeholder="Ingresar código" required>

                            </div>

                        </div>

                        <!--AGREGAR id de sucursal-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                <input type="text" class="form-control input-lg" name="idSucursal" placeholder="Ingresar id de sucursal" required>

                            </div>

                        </div>

                        <!--AGREGAR DE Descripcion-->
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                <input type="text" class="form-control input-lg" name="descripcion" placeholder="Ingresar descripción" required>

                            </div>

                        </div>

                        <!--AGREGAR DE estado-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="estado" placeholder="Ingresar estado" required>

                            </div>

                        </div>

                        <!--AGREGAR DE empleadoid-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control input-lg" name="empleado_id" placeholder="Ingresar cédula del empleado" required>

                            </div>

                        </div>



                        <div class="modal-footer">
                            <!---salir no esta funcionando-->
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








<!--*************************** MODAL MODIFICAR ACTIVO ***************************-->

<div class="modal fade" id="#modalUpdateActivo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Editar Activo</h4>
                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!--MODIFICAR DE Codigo-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg" id="codigom" name="codigom" value="Ingresar el codigo" required>
                            </div>

                        </div>

                        <!--MODIFCAR DE id sucursal-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                <input type="text" class="form-control input-lg" id="idSucursalm" name="idSucursalm" value="Ingresar id de sucursal" required>

                            </div>

                        </div>

                        <!--MODIFICAR DE Descripcion-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                <input type="text" class="form-control input-lg" id="descripcionm" name="descripcionm" value="Ingresar descripción" required>

                            </div>

                        </div>


                        <!--MODIFICAR DE estado-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" id="estadom" name="estadom" value="Ingresar estado" required>

                            </div>

                        </div>

                        <!--MODIFICAR DE empleado_id-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control input-lg" id="empleado_idm" name="empleado_idm" value="Ingresar cédula del empleado" required>

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