<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/unidadMedida.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id= "container pt-4" style="margin-top: 100px;">

<div class="container mt-3">
  <h2 class="correrIzquierda" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Unidad de Medida</h2>

    <button class="btn btn-primary btnAgregarUnit correrIzquierda" data-bs-toggle="modal" data-bs-target="#modalAddUnit">
        Agregar Unidad de Medida
    </button>
  <div class="box-body">
  <div class="table-responsive roboto correrIzquierda">
  <table class="table tableMostrar" id="tabla" data-sort="table">
      <colgroup>
        <col style="width: 30%;">
        <col style="width: 30%;">
        <col style="width: 30%;">
      </colgroup>

        <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                    
                </tr>
        </thead>
                <tbody>

    <?php
    $item = null;
    $valor = null;
    
    $unit = ControllerUnit::ctrShowUnit($item, $valor);
    

    foreach($unit as $key => $unit1) { ?>
    <tr>

        <td><?php echo $unit1['codigo']; ?></td>
        <td><?php echo $unit1['nombre']; ?></td>
  

        <td>

          <div class="btn-group">
              <button style="margin: 5px" class="btn btn-warning btnUpdate btnUpdateUnit" idUnit = <?php echo $unit1['codigo']; ?>
              data-bs-toggle="modal" data-bs-target="#modalUpdateUnit"><i class="fa fa-pencil"></i></button>
              
              <button style="margin: 5px" class="btn btn-danger btnDelete btnDeleteUnit" codigoM = <?php echo $unit1['codigo']; ?>
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


<!--MODAL PARA AGREGAR UNIDAD DE MEDIDA-->


<div class="modal fade" id="modalAddUnit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">


        <div class="modal-header modalHeaderColor">
          <h4 class="modal-title">Agregar Unidad de Medida</h4>

        </div>

    </br>
        <div class="modal-body">

          <div class="box-body modalUnit">

            <!--AGREGAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <input type="text" class="form-control input-lg" id="nameUnit" name="nameUnit" style="border-radius: 5px;" placeholder="Ingresar unidad de medida" required>
              </div>

            </div>

        
          </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
        </div>

            <?php

                $addUnit = new ControllerUnit;
                $addUnit -> ctrCreateUnit();

            ?>

      </form>
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR Categorias ***************************-->

<div class="modal fade" id="modalUpdateUnit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">


        <div class="modal-header modalHeaderColor" >
          <h4 class="modal-title">Editar Unidad de Medida</h4>

        </div>


        <div class="modal-body">

          <div class="box-body modalUnit">

            <!--MODIFICAR DE CODIGO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="idUnitm" style="border-radius: 5px;" name="idUnitm" readonly required>
                

              </div>

            </div>

            <!--MODIFCAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <input type="text" class="form-control input-lg" id="nameUnitm" style="border-radius: 5px;" name="nameUnitm" placeholder="Editar unidad de medida" required>

              </div>

            </div>

          </div>

        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
            </div>

            <?php
                $updateUnit = new ControllerUnit;
                $updateUnit -> ctrUpdateUnit();

            ?>

      </form>
    </div>
  </div>
</div>

<?php
  
  $deleteUnit = new ControllerUnit;

  $deleteUnit -> ctrDeleteUnit() ;

?>




