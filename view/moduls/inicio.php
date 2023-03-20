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


            <div class = "columnas-juntas">
                <div class="row justify-content-center", style="margin: rigth 200px;">

                    <!-- Column 1.x -->
                    <div class="col-sm">
                        <div id="perfil-usuario">
                            
                        <?php 
        
                        if($_SESSION['image'] != null){?>
                            <img src="<?php echo $_SESSION['image'];?>" alt="  Usuario logeado" class="imagen-usuario">
                        <?php } ?>
                        <?php
                        if($_SESSION['image'] == null){?>
                            <img src="imagen/pareja-usuarios.png" alt="  Usuario logeado" class="imagen-usuario">
                        <?php } ?>

                            <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Nombre de usuario:</h1>
                            <span class="hidden-sm"><?php  echo $_SESSION["nombre"]; ?></span>
                            <span class="hidden-sm"><?php  echo $_SESSION["apellidos"]; ?></span>
                            
                            <!--<input type="file" id="input-imagen" accept="image/*">-->
                            
                    
                        </div>
                        

                    </div>

                    <!-- Column 2.x -->
                    <div class="col-sm center">

                    <div id="cantidad-productos">
                            <img src="imagen/cantidad-productos.png" alt="Imagen de productos." class="cantidad-productos">
                            <h1 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Cantidad de Productos Almacenados: 60</h1>
                            
                            
                            <button></button>
                        </div>

                      
                    </div>

                </div>

            </div>

            
            <div class="container">
		    <div class="row">
			<div class="col-sm-12">
				<h1>Graficos.</h1>
			</div>
		</div>
		<div class="row">
			<div class="columna">
				<h2>Columna 1</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet orci non risus luctus euismod. Aliquam erat volutpat. Nam nec ex eu felis vestibulum commodo id eu dolor. Vestibulum sit amet nibh nec lectus bibendum commodo eu eget ex.</p>
			</div>
			<div class="columna">
				<h2>Columna 2</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet orci non risus luctus euismod. Aliquam erat volutpat. Nam nec ex eu felis vestibulum commodo id eu dolor. Vestibulum sit amet nibh nec lectus bibendum commodo eu eget ex.</p>
			</div>
			<div class="columna">
				<h2>Columna 3</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet orci non risus luctus euismod. Aliquam erat volutpat. Nam nec ex eu felis vestibulum commodo id eu dolor. Vestibulum sit amet nibh nec lectus bibendum commodo eu eget ex.</p>
			</div>
		</div>
	</div>        








            
    </div>
</div>
