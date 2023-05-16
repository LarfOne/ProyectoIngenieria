<?php
// La clase tiene un método público llamado ajaxUpdateDetalle() que toma un valor de un parámetro de solicitud POST llamado "idFactura" 
//El método ajaxUpdateDetalle() luego imprime la respuesta de la llamada en formato JSON.

class AjaxDetalle{
    public $idFactura;

    public function ajaxUpdateDetalle(){

        $item = "idFactura";
        $valor = $this->codigo;

        $respuesta =ControladorVentas::ctrMostrarVentas($item, $valor);

        echo json_encode($respuesta);

    }

}
//if que verifica si se ha enviado un valor para el parámetro "idFactura" a través de una solicitud POST.
// Si se ha enviado un valor, crea una nueva instancia de la clase AjaxDetalle y llama al método ajaxUpdateDetalle() utilizando el valor enviado
if(isset($_POST["idFactura"])){

    $update =  new AjaxDetalle();
    $update->idFactura = $_POST["idFactura"];
    $update->ajaxUpdateDetalle();
}

?>