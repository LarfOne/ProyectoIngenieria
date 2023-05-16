<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/style.css">

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
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
    $('.carousel').carousel({
        interval: 1000 // Cambia aquí el tiempo en milisegundos entre cada slide
    });
</script>


<!DOCTYPE html>
<html>

<head>

</head>

<body>
    

    <div id="container pt-4" style="margin-top:100px;">

        <div id="container mt-3">


            <div class="cards" style="margin-left:80px">
                <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Bienvenido a StockLamp.</h2>
                <h4 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Sistema de inventario.</h4>

                <?php




                ?>
                <!-- CARDS DEL PRINCIPIO CLIENTES, VENTAS, USUARIOS, INVENTARIO  -->
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


                <!-- CARDS #2 EMPLEADO Y SECUENCIA DE IMAGENES -->
                <div class="cardCont">
                    <div class="card card-empleado">
                        <div class="col-md-6">
                            <img src="imagen/mouseLamp.png" class="card-img2">

                        </div>
                        <div class="col-md-6">

                            <span class="hidden-sm1"><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellidos"]; ?></span>

                        </div>
                    </div>
                    <div class="card carrusel">
                        <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner mx-auto">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="imageneshome/diseno-grafico.png" class="tamanoimg img-fluid mr-3" alt="..." "  >
                                        </div>
                                        <div class=" col-md-6">

                                            <h5 class="titulo-carrusel">Diseño y desarrollo de software.</h5>


                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="imageneshome/ethernet.png" class="tamanoimg img-fluid mr-3" alt="...">
                                        </div>
                                        <div class="col-md-6">

                                            <h5 class="titulo-carrusel">Telecomunicaciones.</h5>


                                        </div>


                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="imageneshome/dispositivos.png" class="tamanoimg img-fluid mr-3" alt="...">
                                        </div>
                                        <div class="col-md-6">

                                            <h5 class="titulo-carrusel">Soporte técnico.</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="color:dimgray; "></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- CARDS #3 FOTO DE USUARIO, NUMERO DE CLIENTES Y NUMERO DE PRODUCTOS  -->
                <div class="cardCont">
                    <div class="card card-usuariologueado2">
                        <?php

                        if ($_SESSION['image'] != null) { ?>
                            <img src="<?php echo $_SESSION['image']; ?>" alt="  Usuario logeado" class="card-img22">
                        <?php } ?>
                        <?php
                        if ($_SESSION['image'] == null) { ?>
                            <img src="imagen/pareja-usuarios.png" alt="  Usuario logeado" class="imagen-usuario">
                        <?php } ?>


                    </div>
                    <div class="card card-usuariologueado">
                        <img src="imagen/cantidad-productos.png" alt="Imagen de productos." class="card-img">

                        <?php
                        $productosCantidad = ControllerInventario::ctrProductosCantidad("inventario", "idProducto");
                        $cantidad = $productosCantidad[0]["COUNT(DISTINCT idProducto)"];

                        ?>
                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Cantidad de Productos Almacenados:<?php echo $cantidad; ?></h1>

                    </div>
                    <div class="card card-usuariologueado">
                        <img src="imagen/clientes.png" alt="Imagen de productos." class="card-img">

                        <?php
                        $clientes = ControllerClient::ctrClientesCantidad("cliente", "cedula");
                        $cantidad = $clientes[0]["COUNT(DISTINCT cedula)"];

                        ?>
                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Cantidad de Clientes Almacenados:<?php echo $cantidad; ?></h1>

                    </div>


                </div>

                <!-- CARDS DE REPORTES DE VENTAS-->
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