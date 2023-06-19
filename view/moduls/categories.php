<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/categorias.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id= "container pt-4" style="margin-top: 100px;">

<div class="container mt-3">
  <h2 class="correrIzquierda" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Categorías</h2>

    <button class="btn btn-primary btnAgregarCat correrIzquierda" data-bs-toggle="modal" data-bs-target="#modalAddCategories">
        Agregar Categoría
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
    
    $categories = ControllerCategories::ctrShowCategories($item, $valor);
    

    foreach($categories as $key => $categories1) { ?>
    <tr>

        <td><?php echo $categories1['codigo']; ?></td>
        <td><?php echo $categories1['nombre']; ?></td>
  

        <td>

          <div class="btn-group">
              <button style="margin: 5px" class="btn btn-warning btnUpdate btnUpdateCategories" idCategories = <?php echo $categories1['codigo']; ?>
              data-bs-toggle="modal" data-bs-target="#modalUpdateCategories"><i class="fa fa-pencil"></i></button>
              
              <button style="margin: 5px" class="btn btn-danger btnDelete btnDeleteCategories" codigoM = <?php echo $categories1['codigo']; ?>
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


<!--MODAL PARA AGREGAR CATEGORIAS-->


<div class="modal fade" id="modalAddCategories" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">


        <div class="modal-header modalHeaderColor">
          <h4 class="modal-title">Agregar Categorías</h4>

        </div>

    </br>
        <div class="modal-body">

          <div class="box-body modalCat">

            <!--AGREGAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <input type="text" class="form-control input-lg" id="nameCategories" name="nameCategories" style="border-radius: 5px;" placeholder="Ingresar Categoria" required>
              </div>

            </div>

        
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
        </div>

            <?php

              $addCategories = new ControllerCategories;
              $addCategories -> ctrCreateCategories();

            ?>

      </form>
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR Categorias ***************************-->

<div class="modal fade" id="modalUpdateCategories" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">


        <div class="modal-header modalHeaderColor" >
          <h4 class="modal-title">Editar Categorías</h4>

        </div>


        <div class="modal-body">

          <div class="box-body modalCat">

            <!--MODIFICAR DE CODIGO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="idCategoriesm" style="border-radius: 5px;" name="idCategoriesm" readonly required>
                

              </div>

            </div>

            <!--MODIFCAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <input type="text" class="form-control input-lg" id="nameCategoriesm" style="border-radius: 5px;" name="nameCategoriesm" placeholder="Editar Categoria" required>

              </div>

            </div>

     

          </div>

        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-success pull-right" data-dismiss="modal">Guardar</button>
            </div>

            <?php
                $updateCategories = new ControllerCategories;
                $updateCategories -> ctrUpdateCategories();

            ?>

      </form>
    </div>
  </div>
</div>

<?php
  
  $deleteCategories = new ControllerCategories;

  $deleteCategories -> ctrDeleteCategories() ;

?>




