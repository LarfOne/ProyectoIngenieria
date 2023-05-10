<?php

require_once "../controller/productController.php";
require_once "../model/productModel.php";
//AjaxProduct  tiene una función ajaxUpdateProduct() que recupera información sobre un producto con el controlador.La función espera que se le pase 
//el código de producto como parámetro y devuelve un JSON
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

//si se ha enviado un valor para el parámetro idProduct a través del método HTTP POST. Si se ha enviado, se crea una instancia de AjaxProduct y 
//se llama a la función ajaxUpdateProduct()
if(isset($_POST["idProduct"])){

    $update =  new AjaxProduct();
    $update->idProduct = $_POST["idProduct"];
    $update->ajaxUpdateProduct();
}

?>