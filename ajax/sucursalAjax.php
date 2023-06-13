<?php

require_once "../controller/sucursalControlador.php";
require_once "../model/sucursalModelo.php";

//AjaxSucursal tiene un método ajaxUpdateSucursal que utiliza el controlador ControllerSucursal para obtener la información de la sucursal correspondiente al código proporcionado y la devuelve un JSON.

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

//El código verifica si el parámetro idSucursal ha sido enviado a través de POST,
// y si es así, crea una nueva instancia de AjaxSucursal, establece el valor de idSucursal
// y llama al método ajaxUpdateSucursal
if(isset($_POST["idSucursal"])){

    $update =  new AjaxSucursal();
    $update->idSucursal = $_POST["idSucursal"];
    $update->ajaxUpdateSucursal();
}

?>
