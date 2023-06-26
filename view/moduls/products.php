<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/producto.css">





<div id="container pt-4" class="contenedorProducts" style="margin-top:90px;">

      <div class="container mt-3">

            <h1 class="texto" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Ingreso de productos</h1>

            <form id="formProducto" class="col-md-12" role="form" enctype="multipart/form-data" method="POST" style="margin-top: -30px;">

                  <div class="row align-items-center first">
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Codigo del producto.</label>
                              <input class="form-control input-sm mt-2" type="text" id="idProducto" name="idProducto" placeholder="Ingresar codigo" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Nombre del producto.</label>
                              <input class="form-control input-sm mt-2" type="text" id="nameProducto" name="nameProducto" placeholder="Ingresar nombre" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Marca.</label>
                              <input class="form-control input-sm mt-2" type="text" id="marcaProducto" name="marcaProducto" placeholder="Ingresar marca" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Descripción.</label>
                              <textarea class="form-control input-sm mt-2" id="descriptionProducto" name="descriptionProducto" rows="2" placeholder="Descripcion" style="resize: none;" required></textarea>
                        </div>
                  </div>


                  <div class="row align-items-center second">

                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Cantidad.</label>
                              <input class="form-control input-sm mt-2" type="text" id="cantProducto" min="1" name="cantProducto" placeholder="Cantidad de productos" required>
                        </div>

                        <!-- Mandar a traer las sucursales -->
                        <?php
                        $item = null;
                        $valor = null;
                        $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
                        ?>
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Sucursal</label>
                              <select class="form-select input-lg mt-2" id="idSucursalProducto" name="idSucursalProducto" required>

                                    <option value="">Seleccionar sucursal.</option>
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
                              <label class="labelFormProduct">Unidad</label>
                              <select class="form-select input-lg mt-2" id="unitProducto" name="unitProducto" required>
                                    <option value="">Seleccionar unidad.</option>
                                    <?php foreach ($unit as $unit1) { ?>
                                          <option value=<?php echo $unit1['codigo'] ?>><?php echo $unit1['nombre'] ?></option>
                                    <?php } ?>

                              </select>

                        </div>
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Porcentaje de IVA</label>
                              <input class="form-control input-sm mt-2" type="text" id="porcProducto" value="13" name="porcProducto" placeholder="Ingresar porcentaje" required>
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
                              <label class="labelFormProduct">Precio Neto.</label>
                              <input class="form-control input-sm mt-2" type="number" id="precioNeto" name="precioNeto" placeholder="Ingresar precio" required>
                        </div>

                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Precio total.</label>
                              <input class="form-control input-sm mt-2" type="text" id="precioTotal" name="precioTotal" value="Precio Total" readonly required>

                        </div>
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Precio IVA.</label>
                              <input class="form-control input-sm mt-2" type="text" id="ivaProducto" name="ivaProducto" value="Ingresar precio" readonly>
                        </div>

                        <div class="col mt-5 mr-5 align-self-center w-25 p-3">
                              <label class="labelFormProduct">Categoría.</label>
                              <select class="form-select input-lg mt-2 selectC" id="cateProducto" name="cateProducto" required>
                                    <option value="">Seleccionar categoría.</option>
                                    <?php foreach ($category as $category1) { ?>
                                          <option value=<?php echo $category1['codigo'] ?>><?php echo $category1['nombre'] ?></option>
                                    <?php } ?>

                              </select>

                        </div>
                  </div>

                  <div class="row align-items-center four">
                        <!--FOTO-->
                        <div class="col mt-5 mr-5">
                              <label class="labelFormProduct">Foto del producto.</label>
                              
                              <input type="file" class="form-control input-sm mt-2 imageProductos" name="imageProductos">
                              <p class="help-block pesoText">Peso maximo de la foto 10MB</p>
                              <img src="imagen/computadoraDefault.png" class="img-thumbnail imageTemp" width="100px">
                        </div>
                        <div class="col mt-5 mr-5 align-self-center">
                              <label class="labelFormProduct">Observaciones.</label>
                              <textarea class="form-control input-lg mt-2" id="obsProducto" name="obsProducto" rows="2" placeholder="Observaciones" style="resize: none; height:160px;"></textarea>
                        </div>

                        <div class="button-container">

                              <button type="submit" class="btn1 button-save">Registrar</button>
                              
                              <a href="inventarios">
                                    <button type="button" class="btn1 button-cancel">Cancelar</button>
                              </a>
                              
                        </div>

                  </div>

                  <?php
                        $addProducto = new ControllerProduct;
                        $addProducto->ctrCreateProduct();
                  ?>
            </form>
      </div>
</div>