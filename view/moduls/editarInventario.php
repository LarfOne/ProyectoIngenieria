<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/style.css">

<div id="container pt-4" class="contenedorProducts" style="margin-top:90px;">
    <div class="container mt-3">
        <h1 class="texto" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Editar Inventario</h1>
        <form class="col-md-12" role="form" method="POST" style="margin-top: -30px; !important">

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

            <div class="button-container">

                <button type="submit" class="button-save">Editar</button>

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