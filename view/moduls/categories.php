<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div class= "container pt-4" style="margin-top: 80px;">

<div class="container mt-3">
  <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Categorias</h2>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddCategories">
        Agregar Categoría
    </button>
  <div class="box-body">
  <div class="table-responsive roboto">
  <table class="table" id="tabla" data-sort="table">
    <thead>
                <tr>
                    <th>Codigo</th>
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

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Categories</h4>
        </div>

    </br>
        <div class="modal-body">

          <div class="box-body">

            <!--AGREGAR DE CODIGO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="idCategories" placeholder="Ingresar código de la categoría" required>
                
              </div>

            </div>

            <!--AGREGAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nameCategories" placeholder="Ingresar nombre" required>
                <input type="hidden" id="categoriesId">
              </div>

            </div>

        
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
        </div>

            <?php

              $addCategories = new ControllerCategories;
              $addCategories -> ctrCreateCategories();

            ?>

      </form>
    </div>
  </div>
</div>

<!--*************************** MODAL MODIFICAR Categories ***************************-->

<div class="modal fade" id="modalUpdateCategories" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Editar Categories</h4>
        </div>


        <div class="modal-body">

          <div class="box-body">

            <!--MODIFICAR DE CODIGO-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="idCategoriesm" name="idCategoriesm" value="" readonly>
                

              </div>

            </div>

            <!--MODIFCAR DE NOMBRE-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nameCategoriesm" name="nameCategoriesm" value="Ingresar nombre" required>

              </div>

            </div>

     

          </div>

        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-success pull-right" data-bs-dismiss="modal">Guardar</button>
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




