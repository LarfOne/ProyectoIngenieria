<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">


<link rel="stylesheet" href="css/boton.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<!DOCTYPE html>
<html>

<head>

    <script src="view/moduls/tablas-reporte.php"></script>
    <!-- Tema del plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css" integrity="sha512-VVb8DE0ldEd7VLeZlruBzGvO8WgSp4i4y12MKTtyE7vB8WjSVDUiORZkkMZQx6Uymvj6gC/w6AC1Hw/R2G5l5A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <script src="graph.js"></script>

    <div id="container pt-4" style="margin-top:100px;">

        <div id="container mt-3">


            <div class="cards" style="margin-left:80px">
                <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Bienvenido a StockLamp.</h2>
                <h4 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Sistema de inventario.</h4>

                <?php




                ?>
<div class="cardCont">
<div class="card card-user">
    <img src="imagen/user.png" class="card-img">
    <a href="users" class="btn-perso btn-user">Usuarios</a>
</div>
<div class="card card-inventory">
    <img src="imagen/inventario.png" class="card-img">
    <a href="inventarios" class="btn-perso btn-inventory">Inventario</a>
</div>
<div class="card card-cliente">
    <img src="imagen/clientes.png" class="card-img">
    <a href="cliente" class="btn-perso btn-clients">Clientes</a>
</div>
<div class="card card-sells">
    <img src="imagen/ventas.png" class="card-img">
    <a href="ventas" class="btn-perso btn-sells">Ventas</a>
</div>

</div>




            </div>
            <!--contenedor de 2 columnas debajo de las cards-->

            <div class="row1">

                <!-- Column 1.x -->

                <div id="perfil1">
                    <h1 class="nota" style="">Codigo Servicio al Cliente.</h1>
                    <img src="imagen/mouseLamp.png" alt="  Logo empresa" class="imagen-empresa">
                    <span class="hidden-sm1"><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellidos"]; ?></span>
                    <!-- <span class="hidden-sm1"><?php echo $_SESSION["apellidos"]; ?></span>-->



                </div>
                <div id="perfil1">
                    <h1 class="nota" style="">Acá tengo que hacer algo jeje.</h1>
                    <img src="imagen/mouseLamp.png" alt="  Logo empresa" class="imagen-empresa">
                    
                    <!-- <span class="hidden-sm1"><?php echo $_SESSION["apellidos"]; ?></span>-->



                </div>



                

            </div>


            



            <div class="row2">

                <!-- Column 1.x -->
                <div class="col-md-4 flex-fill">
                    <div id="perfil-usuario">

                        <?php

                        if ($_SESSION['image'] != null) { ?>
                            <img src="<?php echo $_SESSION['image']; ?>" alt="  Usuario logeado" class="imagen-usuario">
                        <?php } ?>
                        <?php
                        if ($_SESSION['image'] == null) { ?>
                            <img src="imagen/pareja-usuarios.png" alt="  Usuario logeado" class="imagen-usuario">
                        <?php } ?>

                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Nombre de usuario:</h1>
                        <span class="hidden-sm"><?php echo $_SESSION["nombre"]; ?></span>
                        <span class="hidden-sm"><?php echo $_SESSION["apellidos"]; ?></span>

                        <!--<input type="file" id="input-imagen" accept="image/*">-->


                    </div>


                </div>

                <!-- Column 2.x -->
                <div class="col-md-4 flex-fill">

                    <div id="cantidad-productos">
                        <img src="imagen/cantidad-productos.png" alt="Imagen de productos." class="imagen-productos">

                        <?php
                        $productosCantidad = ControllerInventario::ctrProductosCantidad("inventario", "idProducto");
                        $cantidad = $productosCantidad[0]["COUNT(DISTINCT idProducto)"];

                        ?>
                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Cantidad de Productos Almacenados:<?php echo $cantidad; ?></h1>


                        <button></button>
                    </div>


                </div>
                <div class="col-md-4 flex-fill">
                    <div id="cantidad-clientes">
                        <img src="imagen/clientes.png" alt="Imagen de productos." class="imagen-clientes">

                        <?php
                        $clientes = ControllerClient::ctrClientesCantidad("cliente", "cedula");
                        $cantidad = $clientes[0]["COUNT(DISTINCT cedula)"];

                        ?>
                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Cantidad de Clientes Almacenados:<?php echo $cantidad; ?></h1>


                        <button></button>
                    </div>



                </div>


            </div>


            <h1 style="text-align: center; font-family: 'Roboto Condensed', sans-serif !important; ">Reportes.</h1>


<div class="row columnas-juntas2-2 ">
<div class="col-sm-12 col-md-6">
    <h3 class="box-title" style="text-align: center; font-family: 'Roboto Condensed', sans-serif !important;">Ventas</h3>
    <?php include "graficos/graficoVentas.php"; ?>
</div>
<div class="col-sm-12 col-md-6">
    <h3 class="box-title" style="text-align: center; font-family: 'Roboto Condensed', sans-serif !important;">Total de ventas de los empleados</h3>
    <div id="bar-chart1" style="height: 250px;"></div>
    <?php include "graficos/ventasEmpleados.php"; ?>
</div>
</div>


<div class="container">
<div class="row align-items-center justify-content-between">
    <div class="col-md-9">
    <h3 class="mb-0 text-left" style="text-align: center; font-family: 'Roboto Condensed', sans-serif !important;">Seleccione el rango de fecha para mostrar en los graficos</h3>
    </div>
    <div class="col-md-3 mb-3 mb-md-0 text-right">
    <div class="card card-grafic1 border border-primary">
        <div id="daterange-btn2">
        <i class="glyphicon glyphicon-calendar"></i>&nbsp;
        <span></span> <b class="caret"></b>
        </div>
    </div>
    </div>
</div>
</div>




            <br>
            <div class="columnas-juntas2">

                <div class="texto-imagen">

                    <h1 class="texto-imagen-reporte-venta" style="text-align: left; font-family: 'Roboto Condensed', sans-serif !important;">Reporte de ventas Mensuales.</h1>
                    <img src="imagen/ventas.png" alt="  Logo ventas" class="imagen-venta1">


                </div>



                <div class="table-responsive roboto"> <!-- contenedor de la tabla -->

                    <table class="table" id="tabla" data-sort="table">
                        <thead>
                            <tr>
                                <th>Vendedor</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /**Extraccion de datos para la tabla de movimientos */
                            $facturas = ControladorVentas::ctrVentasMes();
                            foreach ($facturas as $key => $factura) {
                                /**Se deben buscar todos los detalles que tengan esa factura */
                                /*Se debe extraer el nombre de el vendedor haciendo una consulta a la tabla ya que la factura ya lleva su id* */
                                $itemUsuario = "cedula";
                                $valorUsuario = $factura[3];
                                $respuestaUsuario = ControllerUser::ctrShowUser($itemUsuario, $valorUsuario);
                                /**Se le envia el id de la factura */
                                $detalles = ControllerDetalle::ctrDetallesPorFactura($factura[0]);
                                foreach ($detalles as $key2 => $detalle) {
                                    $producto = ControllerProduct::ctrNameProducts($detalle[2]);
                                    echo ('
                                <tr>
                                    <td>' . $respuestaUsuario[2] . '</td>
                                    <td>' . $factura[4] . '</td>
                                    <td>' . $producto[1] . '</td>
                                    <td>' . $detalle[3] . '</td>
                                    <td>' . $detalle[6] . '</td>
                                </tr>
                                
                                ');
                                }
                            }
                            ?>

                        </tbody>

                    </table>
                </div>


            </div>
            <div class="columnas-juntas2">

                <div class="texto-imagen">

                    <h1 class="texto-imagen-reporte-venta" style="text-align: left; font-family: 'Roboto Condensed', sans-serif !important;">Reporte de Movimientos de Stock.</h1>
                    <img src="imagen/imagen-movimiento-stock.png" alt="  Logo movimientos" class="imagen-movimiento">


                </div>



                <div class="table-responsive roboto"> <!-- contenedor de la tabla -->

                    <table class="table" id="tabla" data-sort="table">
                        <thead>
                            <tr>
                                <th>Vendedor</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /**Extraccion de datos para la tabla de movimientos */
                            $facturas = ControladorVentas::ctrVentasMes();
                            foreach ($facturas as $key => $factura) {
                                /**Se deben buscar todos los detalles que tengan esa factura */
                                /*Se debe extraer el nombre de el vendedor haciendo una consulta a la tabla ya que la factura ya lleva su id* */
                                $itemUsuario = "cedula";
                                $valorUsuario = $factura[3];
                                $respuestaUsuario = ControllerUser::ctrShowUser($itemUsuario, $valorUsuario);
                                /**Se le envia el id de la factura */
                                $detalles = ControllerDetalle::ctrDetallesPorFactura($factura[0]);
                                foreach ($detalles as $key2 => $detalle) {
                                    $producto = ControllerProduct::ctrNameProducts($detalle[2]);
                                    echo ('
                <tr>
                    <td>' . $respuestaUsuario[2] . '</td>
                    <td>' . $factura[4] . '</td>
                    <td>' . $producto[1] . '</td>
                    <td>' . $detalle[3] . '</td>
                    <td>' . $detalle[6] . '</td>
                </tr>
                
                ');
                                }
                            }
                            ?>

                        </tbody>

                    </table>
                </div>


            </div>


        </div>

</body>


</html>