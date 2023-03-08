<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">
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

            <div class="cardCont cards-4">
                <div class="card card-user">
                    <img src="imagen/user.png" class="card-img">
                    <a href="users"  class="btn-perso btn-user">Usuarios</a>
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


            <div class = "container row justify-content-rigth", style = "width: 50em 0; margin: 2.25rem;">
                <div class="row justify-content-centejkkkkr">

                    <!-- Column 1.x -->
                    <div class="col-sm">

                        <!-- Column 1.1 -->
                        <div class="container", style = "width: 50em 0;">
                            <center><img src="{{ url_for('static', filename = 'img/integrant.jpg') }}" class="img-fluid" style = "background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;"><br/><br/></center>
                            <h2 class="text-center">Manuel Manolo</h2>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi provident autem, facere itaque incidunt voluptatum enim totam eveniet non ratione odit cum nostrum quas minima, illo quasi veritatis fugit maiores?</p>
                        </div>
                        <br/>

                        <!-- Column 1.2 -->
                        <div class="container", style = "width: 50em 0;">
                            <center><img src="{{ url_for('static', filename = 'img/integrant.jpg') }}" class="img-fluid" style = "background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;"><br/><br/></center>
                            <h2 class = "text-center">Samanta Bucamarit</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente error labore facere exercitationem voluptatibus laboriosam, ad nam, rerum dignissimos amet voluptates, quos nisi iste fuga accusamus libero? Neque, laborum.</p>
                        </div>

                    </div>

                    <!-- Column 2.x -->
                    <div class="col-sm center">

                        <!-- Column 2.1 -->
                        <div class="container cener", style = "width: 50em 0;">
                            <center><img src="{{ url_for('static', filename = 'img/integrant.jpg') }}" class="img-fluid" style = "background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;"><br/><br/></center>
                            <h2 class="text-center">Pepito de los Palotes</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic fugit nostrum eius perspiciatis tempora temporibus eveniet doloribus itaque delectus, culpa necessitatibus, facilis, voluptates molestias! Placeat quidem optio cum numquam.</p>
                        </div>
                        <br/>

                        <!-- Column 2.2 -->
                        <div class="container", style = "width: 50em 0;">
                            <center><img src="{{ url_for('static', filename = 'img/integrant.jpg') }}" class="img-fluid" style = "background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;"><br/><br/></center>
                            <h2 class="text-center">Benganito Florencia</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta saepe laboriosam ad molestiae, dignissimos id facere qui tempore sed, ratione et deleniti ipsum velit quisquam reiciendis a minima officia eligendi.</p>
                        </div>

                    </div>

                </div>

            </div>
    </div>
</div>
