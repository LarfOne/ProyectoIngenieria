<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


<link rel="stylesheet" href="css/boton.css">

<div id= "container pt-4" style="margin-top: 100px;">

<div class="container mt-3">
  <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Inventario</h2>

    <!--<button class="btn btn-primary" style="margin:0px, 0px, 100px, 100px !important" data-toggle="modal" data-target="#modalAddUser">
        Agregar Usuario
    </button>-->

  <div class="box-body">
  <div class="table-responsive roboto">
  <table class="table" id="tabla" data-sort="table">
    <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Sucursal</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>

    <?php
    $item = null;
    $valor = null;

    $inventario = ControllerInventario::ctrShowInventario($item, $valor);
    

    foreach($inventario as $key => $inventario1) { ?>
    <tr>

    <?php $sucursal = ControllerSucursal::ctrNameSucursal($inventario1['idSucursal']);
          $producto = ControllerProduct::ctrNameProducts($inventario1['idProducto']);
    ?>

        <td><?php echo $inventario1['codigo']; ?></td>
        <td><?php echo $sucursal['nombre']; ?></td>
        <td><?php echo $producto['nombre']; ?></td>
        <td><?php echo $inventario1['cantidad']; ?></td>


        <td>

          <div class="btn-group">
            <button  class="btn btn-warning btnUpdate btnUpdateInventario" idInventario = <?php echo $inventario1['codigo']; ?>  idProduct = <?php echo $inventario1['idProducto']; ?>
              data-bs-toggle="modal" data-bs-target="#modalUpdateInventario"><i class="fa fa-pencil"></i></button>

              <!--<button  class="btn btn-warning btnUpdateInventario" idInventario = <?php echo $inventario1['codigo']; ?>
              data-toggle="modal" data-target="#modalUpdateInventario"><i class="fa fa-pencil"></i></button>-->

              <button class="btn btn-danger btnDelete btnDeleteInventario" codigoIventarioM = <?php echo $inventario1['codigo']; ?> codigoProductM = <?php echo $inventario1['idProducto']; ?>
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


<!--*************************** MODAL MODIFICAR INVENTARIO ***************************-->

<div class="modal fade" id="modalUpdateInventario" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content mProducto">


      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Ajuste Inventario</h4>
        </div>


        <div class="modal-body">

          <div class="box-body">

          <div class="row align-items-center first">
                  <div class="col mt-5 mr-5">
                        <label>Codigo del producto</label>
                        <input type="text" class="form-control input-lg" id="idProducto" name="idProducto" placeholder="Ingresar Codigo" required readonly>
                        <input type="hidden" id="codigoInventario" name="codigoInventario">
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Nombre del producto</label>
                        <input type="text" class="form-control input-lg" id="nameProducto" name="nameProducto" placeholder="Ingresar Nombre" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Marca</label>
                        <input type="text" class="form-control input-lg" id="marcaProducto" name="marcaProducto" placeholder="Ingresar la marca" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Descripcion</label>
                        <textarea class="form-control rounded-0" id="descriptionProducto" name="descriptionProducto" rows="3"></textarea>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Cantidad</label>
                        <input type="text" class="form-control input-lg" id="cantProducto" name="cantProducto" placeholder="Cantidad Productos" required>
                  </div>
            </div>


            <div class="row align-items-center second">
                  <div class="col mt-5 mr-5">
                        <label>Existencia</label>
                        <input type="text" class="form-control input-lg" id="existProducto" name="existProducto" placeholder="Existencia Actual" required readonly>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Minimo en almacen</label>
                        <input type="text" class="form-control input-lg" id="minProducto" name="minProducto" placeholder="Minimo" required>
                  </div>
                  <!-- Mandar a traer las sucursales -->
                  <?php
                  $item = null;
                  $valor = null;
                  $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
                  ?>

                  <div class="col mt-5 mr-5">
                        <label>Sucursal</label>
                        <select class="form-control input-lg" id="idSucursal" name="idSucursal">
                              <?php foreach ($sucursal as $sucursal1) { ?>
                                    <option value=<?php echo $sucursal1['codigo'] ?>><?php echo $sucursal1['nombre'] ?></option>
                              <?php } ?>
                        </select>
                  </div>
                  <!-- Mandar a traer las unidades -->
                  <?php
                  $item = null;
                  $valor = null;
                  $unit = ControllerUnit::ctrShowUnit($item, $valor);
                  ?>

                  <div class="col mt-5 mr-5">
                        <label>Unidad</label>
                        <select class="form-control input-lg" name="unitProducto">

                              <?php foreach ($unit as $unit1) { ?>
                                    <option value=<?php echo $unit1['codigo'] ?>><?php echo $unit1['nombre'] ?></option>
                              <?php } ?>

                        </select>

                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Porcentaje de IVA</label>
                        <input type="text" class="form-control input-lg" id="porcProducto" name="porcProducto" placeholder="Ingresar Porcentaje" required>
                  </div>
            </div>


            <div class="row align-items-center third">
                  <div class="col mt-5 mr-5">
                        <label>Precio compra</label>
                        <input type="text" class="form-control input-lg" id="precioProducto" name="precioProducto" placeholder="Ingresar Precio" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Ganancia</label>
                        <input type="text" class="form-control input-lg" id="gananciaProducto" name="gananciaProducto" placeholder="Ingresar Ganancia" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Porcentaje de Ganancia</label>
                        <input type="text" class="form-control input-lg" id="porGananProducto" name="porGananProducto" placeholder="Ingresar porcentaje" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Precio IVA</label>
                        <input type="text" class="form-control input-lg" id="ivaProducto" name="ivaProducto" placeholder="" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Foto del producto</label>
                        <input type="file" class="image" name="image">
                        <img src="view/img/plantilla/userDefault.png" class="img-thumbnail" width="100px">
                  </div>
            </div>
            
            <!-- Mandar a traer las categorias -->
            <?php
            $item = null;
            $valor = null;
            $category = ControllerCategories::ctrShowCategories($item, $valor);
            ?>

            <div class="row align-items-center four">
                  <div class="col mt-5 mr-5 align-self-center w-25 p-3">
                        <label>Categoria</label>
                        <select class="form-control input-lg selectC" name="cateProducto">

                              <?php foreach ($category as $category1) { ?>
                                    <option value=<?php echo $category1['codigo'] ?>><?php echo $category1['nombre'] ?></option>
                              <?php } ?>

                        </select>

                  </div>
                  <div class="col mt-5 mr-5 align-self-center">
                        <label>Observaciones</label>
                        <textarea class="form-control rounded-0" id="obsProducto" name="obsProducto" rows="3"></textarea>
                  </div>
            </div>

          </div>

        </div>


                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-right cerrarM" data-bs-dismiss="modal">Salir</button>
                                <button type="submit" class="btn btn-success pull-left" data-bs-dismiss="modal">Ajuste Inventario</button>
                              </div>

                              <?php

                                    $updateProducto = new ControllerProduct;
                                    $updateProducto -> ctrUpdateProduct();

                                    $updateInventario = new ControllerInventario;
                                    $updateInventario -> ctrUpdateInventario();
                              ?>

      </form>
    </div>
  </div>
</div>


<?php
  
  

  $deleteInventario = new ControllerInventario;
  $deleteInventario -> ctrDeleteInventario();

  $deleteProduct = new ControllerProduct;
  $deleteProduct -> ctrDeleteProduct();


  

?>

