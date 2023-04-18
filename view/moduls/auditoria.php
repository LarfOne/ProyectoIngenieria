<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Tablas de movimiento</title>
</head>
<body>

<div id="container pt-4" style="margin-top:100px;">
    <div id="container mt-3">
    <h3>Movimiento de productos</h3>

    <div class="box-body">
      <div class="table-responsive" style="width:1000px; margin-left:auto; margin-right:auto;">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
                <tr>
                    <th style="color:green;">Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Descripcion</th>
                    <th>Precio total</th>
                    <th>Fecha de ingreso</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $item = null;
            $valor = null;

            $productos = ControllerAudit::ctrShowAuditProducts($item, $valor);
            //$productos = ControllerUser::ctrShowUser($item, $valor);
            //$productos = ControllerUser::ctrShowUser($item, $valor);

            foreach($productos as $key => $auditProducts1) { ?>
            <tr>
                <td><?php echo $auditProducts1['codigo']; ?></td>
                <td><?php echo $auditProducts1['nombre']; ?></td>
                <td><?php echo $auditProducts1['marca']; ?></td>
                <td><?php echo $auditProducts1['descripcion']; ?></td>
                <td><?php echo $auditProducts1['precioTotal']; ?></td>
                <td><?php echo $auditProducts1['fecgaIngreso']; ?></td>
            </tr>

            <?php } ?>

            </tbody>
        </table>
        </div>
        </div>
    </div>

</div>
</body>
</html>
