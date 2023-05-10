<?php

require_once "../controller/categoriaControlador.php";
require_once "../model/categoriaModelo.php";

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
