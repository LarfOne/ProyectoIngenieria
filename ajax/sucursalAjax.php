<?php

require_once "../controller/sucursalControlador.php";
require_once "../model/sucursalModelo.php";

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
