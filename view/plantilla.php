<?php
session_start(); //para usar variables de session
?>

<!DOCTYPE html>
<html>

<head>

  <title>StockLamp</title>
  <link rel="icon" href="view/img/empresa/logoBlanco.png ">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/style.css">
  <!--LINK TABLA-->


  <!--SCRIPT TABLA-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  
  
  <!--SCRIPT CHARTJS--->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js" integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!--LINKcabecera-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!--SCRIPT CABECERA-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">

  <!-- ION ICONS -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</head>



<!--CUERPO DEL DOCUMENTO-->


<!--sidebar-collapse= para que inicie en mini-->

<body class="hold-transition skin-blue sidebar-mini login-page">


  <?php

  /**Se verifica si el usuario ya inicio sesion */
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    include "moduls/cabecera.php";
    include "moduls/menu.php";

    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "users" ||
        $_GET["ruta"] == "categories" ||
        $_GET["ruta"] == "products" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "createVenta" ||
        $_GET["ruta"] == "reportVenta" ||
        $_GET["ruta"] == "sucursal" ||
        $_GET["ruta"] == "salir" ||
        $_GET["ruta"] == "activos" ||
        $_GET["ruta"] == "inventarios" ||
        $_GET["ruta"] == "crearVentasP" ||
        $_GET["ruta"] == "auditoria" ||
        $_GET["ruta"] == "clients"
      ) {
        include "moduls/" . $_GET["ruta"] . ".php";
      } else {
        include "moduls/404.php";
      }
    } else {
      include "moduls/inicio.php";
    }
    include "moduls/footer.php";
  } else {
    include "moduls/login.php";
  }


  ?>


  </div>
  <!-- ./wrapper -->
  <script src="view/js/ventas.js"></script>
  <script src="view/js/user.js"></script>
  <script src="view/js/sucursal.js"></script>
  <script src="view/js/inventario.js"></script>
  <script src="view/js/table.js"></script>
  <script src="view/js/categories.js"></script>
  <script src="view/js/activo.js"></script>
  <script src="view/js/clients.js"></script>
  <script src="view/js/product.js"></script>
  <script src="view/js/menu.js"></script>
</body>

</html>