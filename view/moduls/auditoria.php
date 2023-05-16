<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Movimiento de productos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/auditoria.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">  
</head>
<body>
    
    <div id="container pt-4" style="margin-top:100px; justify-content:center;">
    <h1 class="texto-imagen-reporte-venta correrIzquierda" style="text-align: center; font-family: 'Roboto Condensed', sans-serif !important;">Reporte de Movimientos de Stock.</h1>
        <div class="container mt-3 columnas-juntas2" >
            <div class="table-responsive roboto correrIzquierda">
            <h2>Ingresos de productos</h2>
                <table class="table table-bordered table-striped dt-responsive tablas" id="tabla" data-sort="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Descripción</th>
                            <th>Unidad de medida</th>
                            <th>Observaciones</th>
                            <th>Precio Neto</th>
                            <th>Precio Total</th>
                            <th>Usuario que lo ingresó</th>
                            <th>Fecha de ingreso</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;

                        $productosAudit = ControllerAudit::ctrShowAuditProducts($item, $valor);

                        foreach($productosAudit as $key => $auditProducts1) {
                            ?>
                            <tr>
                                <td><?php echo $auditProducts1['codigo']; ?></td>
                                <td><?php echo $auditProducts1['nombre']; ?></td>
                                <td><?php echo $auditProducts1['marca']; ?></td>
                                <td><?php echo $auditProducts1['descripcion']; ?></td>
                                <td><?php echo $auditProducts1['unidadmedida']; ?></td>
                                <td><?php echo $auditProducts1['observaciones']; ?></td>
                                <td><?php echo $auditProducts1['precioNeto']; ?></td>
                                <td><?php echo $auditProducts1['precioTotal']; ?></td>
                                <td><?php echo $auditProducts1['usuarioResponsable']; ?></td>
                                <td><?php echo $auditProducts1['fechaIngreso']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container mt-3 columnas-juntas2">
            
            <div class="table-responsive roboto correrIzquierda">
            <h2>Modificaciones de productos</h2>

                <table class="table table-bordered table-striped dt-responsive tablas" id="tabla" data-sort="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Descripción</th>
                            <th>Unidad de medida</th>
                            <th>Observaciones</th>
                            <th>Precio Neto</th>
                            <th>Precio Total</th>
                            <th>Usuario que lo Modificó</th>
                            <th>Fecha de Modificacion</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;

                        $productosAuditMod = ControllerAudit::ctrShowAuditProductsMod($item, $valor);

                        foreach($productosAuditMod as $key => $auditProducts2) {
                            ?>
                            <tr>
                                <td><?php echo $auditProducts2['codigo']; ?></td>
                                <td><?php echo $auditProducts2['nombre']; ?></td>
                                <td><?php echo $auditProducts2['marca']; ?></td>
                                <td><?php echo $auditProducts2['descripcion']; ?></td>
                                <td><?php echo $auditProducts2['unidadmedida']; ?></td>
                                <td><?php echo $auditProducts2['observaciones']; ?></td>
                                <td><?php echo $auditProducts2['precioNeto']; ?></td>
                                <td><?php echo $auditProducts2['precioTotal']; ?></td>
                                <td><?php echo $auditProducts2['usuarioResponsable']; ?></td>
                                <td><?php echo $auditProducts2['fechaModificado']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>

