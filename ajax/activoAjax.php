<?php

require_once "../controller/activosController.php";
require_once "../model/activoModel.php";

class AjaxActivo{

    /*EDITAR SUCURSAL*/

    public $codigo;
    
    public function ajaxUpdateActivo(){

        $item = "codigo";
        $valor = $this->codigo;

        $respuesta = ControllerActivos::ctrShowActivo($item, $valor);

        echo json_encode($respuesta);

    }

}


if(isset($_POST["codigo"])){

    $update =  new AjaxActivo();
    $update->codigo = $_POST["codigo"];
    $update->ajaxUpdateActivo();
}

?>
