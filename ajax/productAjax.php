<?php

require_once "../controller/productController.php";
require_once "../model/productModel.php";

class AjaxProduct{

    /*EDITAR producto*/

    public $idProduct;

    public function ajaxUpdateProduct(){

        $item = "codigo";
        $valor = $this->idProduct;

        $respuesta = ControllerProduct::ctrShowProduct($item, $valor);

        echo json_encode($respuesta);

    }

}


if(isset($_POST["idProduct"])){

    $update =  new AjaxProduct();
    $update->idProduct = $_POST["idProduct"];
    $update->ajaxUpdateProduct();
}

?>