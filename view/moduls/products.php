<link rel="stylesheet" href="css/boton.css">

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/products.css">
<div class= "contenedor">
   
      <h2 style="text-align: center">Ingreso de Productos</h2>
      
      <form class="col-md-12 row" role="form" method="POST">

                        <div class = "col-md-4 columnas">
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Codigo del producto</label>
                                 
                                    <div class="input-group">
                                          <input type="text" class="form-control input-lg" name="idProducto" placeholder="Ingresar código" required>
                                    </div>
                                 
                              </div>
                              
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Nombre del producto</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="nameProducto" placeholder="Ingresar nombre" required>
                                    </div>

                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Marca</label>
                                 
                                    <div class="input-group">
                                          <input type="text" class="form-control input-lg" name="marcaProducto" placeholder="Ingresar marca" required>
                                    </div>
                                 
                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Descripcion</label>

                                    <div class="input-group">
                                          
                                          <textarea class="form-control rounded-0" name="descriptionProducto" rows="3"></textarea>
                                    </div>

                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Cantidad</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="cantProducto" placeholder="Cantidad productos" required>
                                    </div>

                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Existencia presente</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="existProducto" placeholder="Existencia actual" required>
                                    </div>

                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Minimo en almacen</label>

                                    <div class="input-group">
                                       
                                          <input type="text" class="form-control input-lg" name="minProducto" placeholder="Mínimo" required>
                                    </div>

                              </div>

                              <?php
                                $item = null;
                                $valor = null;
                                    $sucursal = ControllerSucursal::ctrShowSucursal($item, $valor);
                              ?>
                              
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Sucursal</label>

                                    <div class="input-group">
                                          
                                    <select class="form-control input-lg" name="idSucursal">

                                    <?php foreach($sucursal as $sucursal1) { ?>
                                                <option value=<?php echo $sucursal1['codigo']?>><?php echo $sucursal1['nombre']?></option>
                                    <?php } ?>

                                    </select>
                                    </div>

                              </div>

                              <?php
                                $item = null;
                                $valor = null;
                                    $unit = ControllerUnit::ctrShowUnit($item, $valor);
                              ?>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Unidad de medida</label>

                                    <div class="input-group">
                                          
                                    <select class="form-control input-lg" name="unitProducto">

                                    <?php foreach($unit as $unit1) { ?>
                                                <option value=<?php echo $unit1['codigo']?>><?php echo $unit1['nombre']?></option>
                                    <?php } ?>

                                    </select>
                                    </div>

                              </div>

                        </div>

                        <div class = "col-md-4 columnas">
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Porcentaje de IVA</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="porcProducto" placeholder="Ingresar porcentaje" required>
                                    </div>

                              </div>
                              
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Precio compra</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="precioProducto" placeholder="Ingresar precio" required>
                                    </div>

                              </div>
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Ganancia</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="gananciaProducto" placeholder="Ingresar ganancia" required>
                                    </div>

                              </div>
                              <div class="form-group">
                                 <label class="col-md-4 control-label">%Ganancia</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="porGananProducto" placeholder="Ingresar porcentaje" required>
                                    </div>

                              </div>
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Precio IVA</label>

                                    <div class="input-group">
                                          
                                          <input type="text" class="form-control input-lg" name="ivaProducto" placeholder="" required>
                                    </div>

                              </div>


                              <div style="margin-top: 200px; margin-left: 130px">

                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i>Registrar</button>
                                    
                                    <button type="button" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i>Cancelar</button>
                              </div>
                           
                        </div>
                           
                        
                           
                        <div class = "col-md-4 columnas">
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Foto del producto</label>

                                    <input type="file" class="image" name="image">
                                    <img src="view/img/plantilla/userDefault.png" class="img-thumbnail" width="100px">
 
                              </div>

                              <?php
                                $item = null;
                                $valor = null;
                                    $category = ControllerCategories::ctrShowCategories($item, $valor);
                              ?>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Categorias</label>

                                    <div class="input-group">
                                          
                                          <select class="form-control input-lg" name="cateProducto">

                                                <?php foreach($category as $category1) { ?>
                                                            <option value=<?php echo $category1['codigo']?>><?php echo $category1['nombre']?></option>
                                                <?php } ?>

                                          </select>
                                          
                                    </div>

                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Observaciones</label>

                                    <div class="input-group">
                                          
                                          <textarea class="form-control rounded-0" name="obsProducto" rows="3"></textarea>
                                    </div>

                              </div>
                        </div>
            <?php

              $addProducto = new ControllerProduct;
              $addProducto -> ctrCreateProduct();

              $addInventario = new ControllerInventario;
              $addInventario -> ctrCreateInventario();
                                                      
            ?>

      </form>

</div>
