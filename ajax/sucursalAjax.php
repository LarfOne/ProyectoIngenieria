<?php

require_once "../controller/sucursalController.php";
require_once "../model/sucursalModel.php";

class AjaxSucursal{

    /*EDITAR SUCURSAL*/

    public $idSucursal;

    public function ajaxUpdateSucursal(){

        $item = "codigo";
        $valor = $this->idSucursal;

        $respuesta = ControllerSucursal::ctrShowSucursal($item, $valor);

        echo json_encode($respuesta);

    }

}


if(isset($_POST["idSucursal"])){

    $update =  new AjaxSucursal();
    $update->idSucursal = $_POST["idSucursal"];
    $update->ajaxUpdateSucursal();
}

?>
