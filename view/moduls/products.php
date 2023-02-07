<link rel="stylesheet" href="css/boton.css">

<link rel="stylesheet" href="css/style.css">

<div class="container pt-4" style="margin-top:80px;">
      <h1 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Ingreso de productos</h1>
      <form class="container roboto" action="POST" role="form">
            <div class="row align-items-center">
                  <div class="col mt-5 mr-5">
                        <label>Codigo del producto</label>
                        <input class="form-control input-sm mt-2" type="text" name="idProducto" placeholder="Ingresar codigo" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Nombre del producto</label>
                        <input class="form-control input-sm mt-2" type="text" name="nameProducto" placeholder="Ingresar nombre" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Marca</label>
                        <input class="form-control input-sm mt-2" type="text" name="marcaProducto" placeholder="Ingresar marca" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Descripcion</label>
                        <textarea class="form-control" name="descriptionProducto" rows="2" placeholder="Descripcion"></textarea>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Cantidad</label>
                        <input class="form-control input-sm mt-2" type="text" name="cantProducto" placeholder="Cantidad de productos" required>
                  </div>
            </div>
            <div class="row align-items-center">
                  <div class="col mt-5 mr-5">
                        <label>Existencia</label>
                        <input class="form-control input-sm mt-2" type="text" name="existProducto" placeholder="Existencia actual" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Minimo de producto</label>
                        <input class="form-control input-sm mt-2" type="text" name="minProducto" placeholder="Minimo" required>
                  </div>
                  <!-- Mandar a traer las sucursales -->
                  <?php
                  $item = null;
                  $valor = null;
                  $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
                  ?>

                  <div class="col mt-5 mr-5">
                        <label>Sucursal</label>
                        <select class="form-control input-lg" name="idSucursal">
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
                        <input class="form-control input-sm mt-2" type="text" name="porcProducto" placeholder="Ingresar porcentaje" required>
                  </div>
            </div>
            <div class="row align-items-center">
                  <div class="col mt-5 mr-5">
                        <label>Precio compra</label>
                        <input class="form-control input-sm mt-2" type="text" name="precioProducto" placeholder="Ingresar precio" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Ganancia</label>
                        <input class="form-control input-sm mt-2" type="text" name="gananciaProducto" placeholder="Ingresar ganancia" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Porcentaje de Ganancia</label>
                        <input class="form-control input-sm mt-2" type="text" name="porGananProducto" placeholder="Ingresar porcentaje" required>
                  </div>
                  <div class="col mt-5 mr-5">
                        <label>Precio IVA</label>
                        <input class="form-control input-sm mt-2" type="text" name="ivaProducto" placeholder="Ingresar precio" required>
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

            <div class="row align-items-center">
                  <div class="col mt-5 mr-5 align-self-center w-25 p-3">
                        <label>Categoria</label>
                        <select class="form-control input-lg" name="cateProducto">

                              <?php foreach ($category as $category1) { ?>
                                    <option value=<?php echo $category1['codigo'] ?>><?php echo $category1['nombre'] ?></option>
                              <?php } ?>

                        </select>

                  </div>
                  <div class="col mt-5 mr-5 align-self-center">
                        <label>Observaciones</label>
                        <textarea class="form-control" name="obsProducto" rows="2" placeholder="Observaciones"></textarea>
                  </div>
            </div>
            <div class="button-container">

                  <button type="submit" class="button-save">Registrar</button>

                  <button type="button" class="button-cancel">Cancelar</button>
            </div>

            <?php

            $addProducto = new ControllerProduct;
            $addProducto->ctrCreateProduct();

            $addInventario = new ControllerInventario;
            $addInventario->ctrCreateInventario();

            ?>
      </form>


</div>