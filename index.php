<?php
    require_once "controller/plantillaController.php";

    /** CONTROLADORES */
    require_once "controller/userController.php";
    require_once "controller/clientController.php";
    require_once "controller/categoriesController.php";
    require_once "controller/ventasController.php";
    require_once "controller/productController.php";
    require_once "controller/sucursalController.php";
    require_once "controller/activosController.php";
    require_once "controller/inventarioController.php";
    require_once "controller/unitController.php";
    require_once "controller/detalleFacturaController.php";
    require_once "controller/auditoriaController.php";
    

    /** MODELOS */
    require_once "model/userModel.php";
    require_once "model/clientModel.php";
    require_once "model/categoriesModel.php";
    require_once "model/ventaModel.php";
    require_once "model/productModel.php";
    require_once "model/sucursalModel.php";
    require_once "model/activoModel.php";
    require_once "model/inventarioModel.php";
    require_once "model/unitModel.php";
    require_once "model/detalleFacturaModel.php";
    require_once "model/auditoriaModel.php";

    $plantilla = new ControllerPlantilla();
    $plantilla -> ctrPlantilla();
?>