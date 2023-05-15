<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="css/inventario.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">    

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<div id= "container pt-4" style="margin-top: 100px;">

<div class="container mt-3">
  <h2 class="correrIzquierda" style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Control de Inventario</h2>

  <div class="box-body">
  <div class="table-responsive roboto correrIzquierda">
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
            <button class="btn btn-warning btnUpdate" idInventario = <?php echo $inventario1['codigo']; ?> idProduct = <?php echo $inventario1['idProducto']; ?>>
            <a class="probar" href="editarInventario?codigoInventario=<?php echo $inventario1['codigo'];?>"><i class="fa fa-pencil"></i></a>
            </button>

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


<?php
  

  $deleteInventario = new ControllerInventario;
  $deleteInventario -> ctrDeleteInventario();

  $deleteProduct = new ControllerProduct;
  $deleteProduct -> ctrDeleteProduct();


?>

