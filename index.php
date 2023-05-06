<?php
    require_once "controller/plantillaController.php";

    /** CONTROLADORES */
    require_once "controller/userController.php";
    require_once "controller/clienteControlador.php";
    require_once "controller/categoriaControlador.php";
    require_once "controller/ventasController.php";
    require_once "controller/productController.php";
    require_once "controller/sucursalControlador.php";
    require_once "controller/activoControlador.php";
    require_once "controller/inventarioController.php";
    require_once "controller/unitController.php";
    require_once "controller/detalleFacturaController.php";
    

    /** MODELOS */
    require_once "model/userModel.php";
    require_once "model/clienteModelo.php";
    require_once "model/categoriaModelo.php";
    require_once "model/ventaModel.php";
    require_once "model/productModel.php";
    require_once "model/sucursalModelo.php";
    require_once "model/activoModel.php";
    require_once "model/inventarioModel.php";
    require_once "model/unitModel.php";
    require_once "model/detalleFacturaModel.php";

    $plantilla = new ControllerPlantilla();
    $plantilla -> ctrPlantilla();
?>