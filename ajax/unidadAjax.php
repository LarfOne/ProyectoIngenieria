<?php

require_once "../controller/unitController.php";
require_once "../model/unitModel.php";
// llamada Ajax que recupera datos para una unidad de medida específica basada en su ID de unidad de medida

//clase "AjaxUnidad" con una función "ajaxUpdateUnit()" que recupera los datos de la unidad de medida a través del controlador utiliza "idUnit" y  devuelve como una respuesta JSON.
class AjaxUnidad{

    /*EDITAR Unidad de medida*/

    public $idUnit;

    public function ajaxUpdateUnit(){

        $item = "codigo";
        $valor = $this->idUnit;

        $respuesta = ControllerUnit::ctrShowUnit($item, $valor);

        echo json_encode($respuesta);

    }

}


if(isset($_POST["idUnit"])){

    $update =  new AjaxUnidad();
    $update->idUnit = $_POST["idUnit"];
    $update->ajaxUpdateUnit();
}

?>
