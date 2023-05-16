<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/auditoria.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">  

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


<div class="correrIzquierda" id="container pt-4" style="margin-top:100px;">
    <div class="container mt-3" >
        <h2>Movimiento de productos</h2>

        <div class="table-responsive roboto" >
            <table class="table" id="tabla" data-sort="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Descripción</th>
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

                    foreach($productosAudit as $key => $auditProducts1) { ?>
                    <tr>
                        <td><?php echo $auditProducts1['codigo']; ?></td>
                        <td><?php echo $auditProducts1['nombre']; ?></td>
                        <td><?php echo $auditProducts1['marca']; ?></td>
                        <td><?php echo $auditProducts1['descripcion']; ?></td>
                        <td><?php echo $auditProducts1['precioNeto']; ?></td>
                        <td><?php echo $auditProducts1['precioTotal']; ?></td>
                        <td><?php echo $auditProducts1['usuarioIngresa']; ?></td>
                        <td><?php echo $auditProducts1['fechaIngreso']; ?></td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>

        
    </div>
</div>