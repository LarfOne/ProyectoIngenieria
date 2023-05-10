<?php

require_once "../controller/categoriaControlador.php";
require_once "../model/categoriaModelo.php";
// llamada Ajax que recupera datos para una categoría específica basada en su ID de categoría

//clase "AjaxCategories" con una función "ajaxUpdateCategories()" que recupera los datos de la categoría a través del controlador utiliza "idCategories" y  devuelve como una respuesta JSON.
class AjaxCategories{

    /*EDITAR CATEGORIA*/

    public $idCategories;

    public function ajaxUpdateCategories(){

        $item = "codigo";
        $valor = $this->idCategories;

        $respuesta = ControllerCategories::ctrShowCategories($item, $valor);

        echo json_encode($respuesta);

    }

}


if(isset($_POST["idCategories"])){

    $update =  new AjaxCategories();
    $update->idCategories = $_POST["idCategories"];
    $update->ajaxUpdateCategories();
}

?>
