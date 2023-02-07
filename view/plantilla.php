<?php
  session_start(); //para usar variables de session
?>

<!DOCTYPE html>
<html>
<head>

  <title>Stock-Lamp</title>
  <link rel="icon" href="view/img/empresa/logoBlanco.png ">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/style.css">
  <!--<link rel="stylesheet" type="text/css" href="css/menu.css">-->
  <!--LINK TABLA-->


  <!--SCRIPT TABLA-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <!--SCRIPT CHARTJS--->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



  <!--LINKcabecera-->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    

  <!--SCRIPT CABECERA-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>



<!--CUERPO DEL DOCUMENTO-->


<!--sidebar-collapse= para que inicie en mini-->
<body class="hold-transition skin-blue sidebar-mini login-page">

  <?php

  /**Se verifica si el usuario ya inicio sesion */
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]=="ok"){
    include "moduls/cabecera.php";
    include "moduls/menu.php";

    if(isset($_GET["ruta"])){
      
      if($_GET["ruta"] == "inicio"||
          $_GET["ruta"] == "users"||
          $_GET["ruta"] == "categories"||
          $_GET["ruta"] == "products"||
          $_GET["ruta"] == "ventas"||
          $_GET["ruta"] == "createVenta"||
          $_GET["ruta"] == "reportVenta"||  
          $_GET["ruta"] == "sucursal"||
          $_GET["ruta"] == "salir"||
          $_GET["ruta"] == "activos"||
          $_GET["ruta"] == "inventarios"||
          $_GET["ruta"] == "clients"){
        include "moduls/".$_GET["ruta"].".php";

      }else{
        include "moduls/404.php";
      }

    }else{
      include "moduls/inicio.php";
    }
    include "moduls/footer.php";

  }else{
    include "moduls/login.php";
  }


  ?>

  <!-- ./wrapper -->
  <script src ="view/js/ventas.js"></script>
  <script src ="view/js/user.js"></script>
  <script src ="view/js/sucursal.js"></script>
  <script src ="view/js/inventario.js"></script>
  <script src ="view/js/table.js"></script>
  <script src ="view/js/categories.js"></script>
  <script src ="view/js/activo.js"></script>
  <script src ="view/js/clients.js"></script>
  <script src ="view/js/product.js"></script>
  <script src ="view/js/menu.js"></script>
</body>
</html>

