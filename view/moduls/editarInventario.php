<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">

<div id="container pt-4" class="contenedorProducts" style="margin-top:90px;">
      <div class="container mt-3">

            <h1 class="texto" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Ajuste de Inventario</h1>

            <form class="col-md-12" role="form" method="POST" style="margin-top: -30px; !important">

                <div class="row align-items-center first">
                        <div class="col mt-5 mr-5">
                              <label>Codigo del producto.</label>
                              <input class="form-control input-sm mt-2" type="text" id="idProducto" name="idProducto" placeholder="Ingresar codigo" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Nombre del producto.</label>
                              <input class="form-control input-sm mt-2" type="text" id="nameProducto" name="nameProducto" placeholder="Ingresar nombre" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Marca.</label>
                              <input class="form-control input-sm mt-2" type="text" id="marcaProducto" name="marcaProducto" placeholder="Ingresar marca" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Descripción.</label>
                              <textarea class="form-control input-sm mt-2" id="descriptionProducto" name="descriptionProducto" rows="2" placeholder="Descripcion"></textarea>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Cantidad.</label>
                              <input class="form-control input-sm mt-2" type="text" id="cantProducto" name="cantProducto" placeholder="Nuevos productos" required>
                        </div>
                  </div>


                  <div class="row align-items-center second">

                        <div class="col mt-5 mr-5">
                              <label>Existencia.</label>
                              <input class="form-control input-sm mt-2" type="text" id="existencia" name="existencia" placeholder="Existencia de productos" required>
                        </div>

                        <!-- Mandar a traer las sucursales -->
                        <?php
                        $item = null;
                        $valor = null;
                        $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
                        ?>
                        <div class="col mt-5 mr-5">
                              <label>Sucursal</label>
                              <select class="form-select input-lg mt-2" id="idSucursal" name="idSucursal">
                                    
                              <option value="" >Seleccionar sucursal.</option>
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
                              <select class="form-select input-lg mt-2" id="unitProducto" name="unitProducto">
                              <option value="" >Seleccionar unidad.</option>
                                    <?php foreach ($unit as $unit1) { ?>
                                          <option value=<?php echo $unit1['codigo'] ?>><?php echo $unit1['nombre'] ?></option>
                                    <?php } ?>

                              </select>

                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Porcentaje de IVA</label>
                              <input class="form-control input-sm mt-2" type="number" id="porcProducto" value="13" name="porcProducto" placeholder="Ingresar porcentaje" onchange="obtenerPorcentaje()" required>
                        </div>
                  </div>

                  <?php

                  //Mandar a traer las categorias

                  $item = null;
                  $valor = null;
                  $category = ControllerCategories::ctrShowCategories($item, $valor);
                  ?>

                  <div class="row align-items-center third">
                        <div class="col mt-5 mr-5">
                              <label>Precio Neto.</label>
                              <input class="form-control input-sm mt-2" type="number" id="precioNeto" name="precioNeto" placeholder="Ingresar precio" onchange="obtenerPrecioNeto()" required>
                        </div>

                        <div class="col mt-5 mr-5">
                              <label>Precio total.</label>
                              <input class="form-control input-sm mt-2" type="text" id="precioTotal" name="precioTotal" value="Precio Total" readonly required>

                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Precio IVA.</label>
                              <input class="form-control input-sm mt-2" type="text" id="ivaProducto" name="ivaProducto" value="Ingresar precio" readonly>
                        </div>

                        <div class="col mt-5 mr-5 align-self-center w-25 p-3">
                              <label>Categoría.</label>
                              <select class="form-select input-lg mt-2 selectC" id="cateProducto" name="cateProducto">
                                    <option value="" >Seleccionar categoría.</option>
                                    <?php foreach ($category as $category1) { ?>
                                          <option value=<?php echo $category1['codigo'] ?>><?php echo $category1['nombre'] ?></option>
                                    <?php } ?>

                              </select>

                        </div>
                  </div>

                  <div class="row align-items-center four">
                        <div class="col mt-5 mr-5">
                              <label>Foto del producto.</label>
                              <input type="file" class="form-control input-sm mt-2 image" id="image" name="image">
                              <img src="view/img/plantilla/userDefault.png" class="img-thumbnail" width="100px">
                        </div>
                        <div class="col mt-5 mr-5 align-self-center">
                              <label>Observaciones.</label>
                              <textarea class="form-control input-lg mt-2" id="obsProducto" name="obsProducto" rows="2" placeholder="Observaciones"></textarea>
                        </div>
                  </div>

                  <div class="button-container">

                        <button type="submit" class="button-save">Modificar</button>

                        <button type="button" class="button-cancel">Cancelar</button>
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