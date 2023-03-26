<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">


<!DOCTYPE html>
<html>
<script src="graph.js"></script>

<div id="container pt-4" style="margin-top:100px;">

    <div id="container mt-3">

        <!-------------------------------Saludo ---->
        <!----- <div class="notification">
            <p> Bienvenido, <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?>
                    <span class="hidden-xs"><?php echo $_SESSION["apellidos"]; ?></span></span></p>
            <span class="progress"></span>
        </div>---->

        <div class="" style="margin-left:80px">
            <h2 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Bienvenido a StockLamp.</h2>
            <h4 style="text-align:left; font-family: 'Roboto Condensed', sans-serif !important;">Sistema de inventario.</h4>

            <?php




            ?>
            <div class="cardCont cards-4">
                <div class="card card-user">
                    <img src="imagen/user.png" class="card-img">
                    <a href="users" class="btn-perso btn-user">Usuarios</a>
                </div>
                <div class="card card-inventory">
                    <img src="imagen/inventario.png" class="card-img">
                    <a href="inventarios" class="btn-perso btn-inventory">Inventario</a>
                </div>
                <div class="card card-clients">
                    <img src="imagen/clientes.png" class="card-img">
                    <a href="clients" class="btn-perso btn-clients">Clientes</a>
                </div>
                <div class="card card-sells">
                    <img src="imagen/ventas.png" class="card-img">
                    <a href="ventas" class="btn-perso btn-sells">Ventas</a>
                </div>
            </div>


        </div>


        <div class="container2">
            <div class="row no-gutters" style="margin: rigth 200px;">

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

        </div>

        <div class="columnas-juntas2">
            <h1 class="textoreporte">Reportes</h1>
            <div class="row justify-content-center" , style="margin: rigth 200px;">

                <!-- Column 1.x -->
                <div class="col-md">
                    <div id="reporte1">
                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Stock máximo</h1>
                        <canvas id="stockMaximo"></canvas>
                        <script>
                            var ctx = document.getElementById("stockMaximo").getContext("2d");
                            var stockMaximo = new Chart(ctx, {
                                type: "bar",
                                data: {
                                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                                    datasets: [{
                                        label: "# of Votes",
                                        data: [<?php echo(3)?>, 19, 3, 5, 2, 3],
                                        backgroundColor: [
                                            "rgba(255, 99, 132, 0.2)",
                                            "rgba(54, 162, 235, 0.2)",
                                            "rgba(255, 206, 86, 0.2)",
                                            "rgba(75, 192, 192, 0.2)",
                                            "rgba(153, 102, 255, 0.2)",
                                            "rgba(255, 159, 64, 0.2)"
                                        ],
                                        borderColor: [
                                            "rgba(255, 99, 132, 1)",
                                            "rgba(54, 162, 235, 1)",
                                            "rgba(255, 206, 86, 1)",
                                            "rgba(75, 192, 192, 1)",
                                            "rgba(153, 102, 255, 1)",
                                            "rgba(255, 159, 64, 1)"
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- Column 2.x -->
                <div class="col-md">

                    <div id="reporte2">

                        <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Stock mínimo</h1>
                        <canvas id="stockMinimo"></canvas>
                        <script>
                            var ctx = document.getElementById("stockMinimo").getContext("2d");
                            var stockMinimo = new Chart(ctx, {
                                type: "bar",
                                data: {
                                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                                    datasets: [{
                                        label: "# of Votes",
                                        data: [12, 19, 3, 5, 2, 3],
                                        backgroundColor: [
                                            "rgba(255, 99, 132, 0.2)",
                                            "rgba(54, 162, 235, 0.2)",
                                            "rgba(255, 206, 86, 0.2)",
                                            "rgba(75, 192, 192, 0.2)",
                                            "rgba(153, 102, 255, 0.2)",
                                            "rgba(255, 159, 64, 0.2)"
                                        ],
                                        borderColor: [
                                            "rgba(255, 99, 132, 1)",
                                            "rgba(54, 162, 235, 1)",
                                            "rgba(255, 206, 86, 1)",
                                            "rgba(75, 192, 192, 1)",
                                            "rgba(153, 102, 255, 1)",
                                            "rgba(255, 159, 64, 1)"
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>

                        <button></button>
                    </div>


                </div>

            </div>
            <h1 style="text-align: left; font-family: 'Roboto Condensed', sans-serif !important;">Reporte de ventas Mensuales</h1>
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
                                    <td>' .$respuestaUsuario[2]. '</td>
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
</div>

<script>
    function CargarDatosGrafico() {
        $.ajax({
            url: 'graphController.php',
            type: 'POST'


        }).done(function(resp) {
            var titulo = [];
            var cantidad = [];
            var data = JSON.parse(resp);
            for (var i = 0; i < data.length; i++) {
                titulo.push(data[i][1]);
                cantidad.push(data[i][2]);
                alert(data);

            }


        })



    }
</script>




</html>