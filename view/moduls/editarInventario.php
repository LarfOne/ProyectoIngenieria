<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">
<?php $codigo = $_GET['codigo'] ?>
<div id="container pt-4" class="contenedorProducts" style="margin-top:90px;">
      <div class="container mt-3">

            <h1 class="texto" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Ajuste de Inventario</h1>

            <form class="col-md-12" role="form" enctype="multipart/form-data" method="POST" style="margin-top: -30px; !important">

                <div class="row align-items-center first">
                        <div class="col mt-5 mr-5">
                              <label>Codigo del producto.</label>
                              <input class="form-control input-sm mt-2" type="text" id="idProductoAjuste" name="idProductoAjuste" placeholder="Ingresar codigo" required readonly>
                              <input type="hidden" id="codigoInventarioAjuste" id="codigoInventarioAjuste" name="codigoInventarioAjuste">
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Nombre del producto.</label>
                              <input class="form-control input-sm mt-2" type="text" id="nameProductoAjuste" name="nameProductoAjuste" placeholder="Ingresar nombre" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Marca.</label>
                              <input class="form-control input-sm mt-2" type="text" id="marcaProductoAjuste" name="marcaProductoAjuste" placeholder="Ingresar marca" required>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Descripción.</label>
                              <textarea class="form-control input-sm mt-2" id="descriptionProductoAjuste" name="descriptionProductoAjuste" rows="2" placeholder="Descripcion"></textarea>
                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Cantidad.</label>
                              <input class="form-control input-sm mt-2" type="number" id="cantProductoAjuste" name="cantProductoAjuste" value="0" placeholder="Nuevos productos" required>
                        </div>
                  </div>


                  <div class="row align-items-center second">

                        <div class="col mt-5 mr-5">
                              <label>Existencia.</label>
                              <input class="form-control input-sm mt-2" type="number" id="existenciaAjuste" name="existenciaAjuste" placeholder="Existencia de productos" required>
                        </div>

                        <!-- Mandar a traer las sucursales -->
                        <?php
                        $item = null;
                        $valor = null;
                        $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
                        ?>
                        <div class="col mt-5 mr-5">
                              <label>Sucursal</label>
                              <select class="form-select input-lg mt-2" id="idSucursalAjuste" name="idSucursalAjuste">
                                    
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
                              <select class="form-select input-lg mt-2" id="unitProductoAjuste" name="unitProductoAjuste">
                              <option value="" >Seleccionar unidad.</option>
                                    <?php foreach ($unit as $unit1) { ?>
                                          <option value=<?php echo $unit1['codigo'] ?>><?php echo $unit1['nombre'] ?></option>
                                    <?php } ?>

                              </select>

                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Porcentaje de IVA</label>
                              <input class="form-control input-sm mt-2" type="number" id="porcProductoAjuste" value="13" name="porcProductoAjuste" placeholder="Ingresar porcentaje" required>
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
                              <input class="form-control input-sm mt-2" type="number" id="precioNetoAjuste" name="precioNetoAjuste" placeholder="Ingresar precio" required>
                        </div>

                        <div class="col mt-5 mr-5">
                              <label>Precio total.</label>
                              <input class="form-control input-sm mt-2" type="text" id="precioTotalAjuste" name="precioTotalAjuste" value="Precio Total" readonly required>

                        </div>
                        <div class="col mt-5 mr-5">
                              <label>Precio IVA.</label>
                              <input class="form-control input-sm mt-2" type="text" id="ivaProductoAjuste" name="ivaProductoAjuste" value="Ingresar precio" readonly>
                        </div>

                        <div class="col mt-5 mr-5 align-self-center w-25 p-3">
                              <label>Categoría.</label>
                              <select class="form-select input-lg mt-2 selectC" id="cateProductoAjuste" name="cateProductoAjuste">
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
                              <input type="file" class="form-control input-sm mt-2 imageProductos" id="imageProductosAjuste" name="imageProductosAjuste">
                              <p class="help-block pesoText">Peso maximo de la foto 10MB</p>
                              <img src="imagen/computadoraDefault.png" class="img-thumbnail imageTemp" width="100px">
                              <input type="hidden" name="fotoActualProducto" id="fotoActualProducto">
                        </div>
                        <div class="col mt-5 mr-5 align-self-center">
                              <label>Observaciones.</label>
                              <textarea class="form-control input-lg mt-2" id="obsProductoAjuste" name="obsProductoAjuste" rows="2" placeholder="Observaciones"></textarea>
                        </div>
                  </div>

                  <div class="button-container">

                        <button type="submit" class="button-save botonAjusteInventario">Modificar</button>
                        <a href="inventarios">
                              <button type="button" class="button-cancel botonAjusteInventario">Cancelar</button>
                        </a>
                        
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