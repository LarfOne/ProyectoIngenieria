<?php


class AjaxDetalle{
    public $idFactura;

    public function ajaxUpdateDetalle(){

        $item = "idFactura";
        $valor = $this->codigo;

        $respuesta =ControladorVentas::ctrMostrarVentas($item, $valor);

        echo json_encode($respuesta);

    }

}
if(isset($_POST["idFactura"])){

    $update =  new AjaxDetalle();
    $update->idFactura = $_POST["idFactura"];
    $update->ajaxUpdateDetalle();
}

?>