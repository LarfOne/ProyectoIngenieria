<link rel="stylesheet" type="text/css" href="css/menu.css">

<link href="https://fonts.googleapis.com/css?family=Fredoka+One|Pacifico|Vibur" rel="stylesheet">

<nav class="main-menu">

    <ul>

        <?php

        if ($_SESSION["role"] == "Administrador" || $_SESSION["role"] == "SuperAdmin") {

            echo '<li>
                    <a href="inicio">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Inicio
                        </span>
                    </a>
                
                </li>';

            echo '<li class="has-subnav">
                    <a href="users">
                        <i class="fa fa-user fa-2x"></i>
                        <span class="nav-text">
                            Usuarios
                        </span>
                    </a>
                </li>';

            echo '<li class="has-subnav">
                    <a href="categories">
                        <i class="fa fa-th fa-2x"></i>
                        <span class="nav-text">
                            Categorias
                        </span>
                    </a>
                    
                </li>';

                echo '<li class="has-subnav">
                    <a href="unidadMedida">
                    <i class="fa fa-crop" aria-hidden="true"></i>
                        <span class="nav-text">
                            Unidad de Medida
                        </span>
                    </a>
                    
                </li>';

                echo '<li class="has-subnav">
                    <a href="products">
                        <i class="fa fa-desktop fa-2x"></i>
                        <span class="nav-text">
                            Productos
                        </span>
                    </a>
                </li>';

                echo '<li>
                    <a href="sucursal">
                        <i class="fa fa-building-o fa-2x"></i>
                        <span class="nav-text">
                            Sucursales
                        </span>
                    </a>
                </li>';

                echo '<li>
                    <a href="cliente">
                        <i class="fa fa-users fa-2x"></i>
                        <span class="nav-text">
                            Clientes
                        </span>
                    </a>
                </li>';

                echo '<li class="has-subnav">
                    <a href="activos">
                        <i class="fa fa-cubes fa-2x"></i>
                        <span class="nav-text">
                            Activos
                        </span>
                    </a>
                
                </li>';

                echo '<li class="has-subnav">
                    <a href="inventarios">
                        <i class="fa fa-archive fa-2x"></i>
                        <span class="nav-text">
                            Inventario
                        </span>
                    </a>    
                </li>';

                echo '<li class="has-subnav">
                    <a href="ventas">
                        <i class="fa fa-money fa-2x"></i>
                        <span class="nav-text">
                            Ventas
                        </span>
                    </a>
                    
                </li>';

                echo '<li class="has-subnav">
                        <a href="auditoria">
                            <i class="fa fa-database fa-2x"></i>
                            <span class="nav-text">
                                auditoria
                            </span>
                        </a>
                        
                    </li>';

        }

        if ($_SESSION["role"] == "Usuario") {

            echo '<li>
                    <a href="inicio">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Inicio
                        </span>
                    </a>
                
                </li>';

                echo '<li class="has-subnav">
                    <a href="products">
                        <i class="fa fa-desktop fa-2x"></i>
                        <span class="nav-text">
                            Productos
                        </span>
                    </a>
                </li>';

                echo '<li>
                    <a href="cliente">
                        <i class="fa fa-users fa-2x"></i>
                        <span class="nav-text">
                            Clientes
                        </span>
                    </a>
                </li>';

                echo '<li class="has-subnav">
                    <a href="categories">
                        <i class="fa fa-th fa-2x"></i>
                        <span class="nav-text">
                            Categorias
                        </span>
                    </a>
                    
                </li>';

                
                echo '<li class="has-subnav">
                    <a href="inventarios">
                        <i class="fa fa-archive fa-2x"></i>
                        <span class="nav-text">
                            Inventario
                        </span>
                    </a>    
                </li>';

                echo '<li class="has-subnav">
                    <a href="ventas">
                        <i class="fa fa-money fa-2x"></i>
                        <span class="nav-text">
                            Ventas
                        </span>
                    </a>
                    
                </li>';

        }

        ?>
    </ul>

    
    <ul class="logout" style="margin-bottom: 71px;">
        <?php
        if ($_SESSION["role"] == "Administrador" || $_SESSION["role"] == "Usuario" || $_SESSION["role"] == "SuperAdmin") {
            echo '<li>
                        <a href="salir">
                            <i class="fa fa-power-off fa-2x"></i>
                            <span class="nav-text">
                                Salir
                            </span>
                        </a>
                    </li> ';
        }
        ?>
    </ul>
    

</nav>
