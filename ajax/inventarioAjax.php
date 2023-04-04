<?php

require_once "../controller/inventarioController.php";
require_once "../model/inventarioModel.php";

class AjaxInventario{

    /*EDITAR SUCURSAL*/

    public $idInventario;

    public function ajaxUpdateInventario(){ 

        $item = "codigo";
        $valor = $this->idInventario;

        $respuesta = ControllerInventario::ctrShowInventario($item, $valor);

        echo json_encode($respuesta);

    }

    public function ajaxInventarioPorProducto(){ 

        $item = "idProducto";

        $valor = $this->idInventario;

        $respuesta = ControllerInventario::ctrCodigoInventarioPorProducto($item, $valor);

        echo json_encode($respuesta);

    }

}


if(isset($_POST["idInventario"])){

    $update =  new AjaxInventario();
    $update->idInventario = $_POST["idInventario"];
    $update->ajaxUpdateInventario();

}

if(isset($_POST["idProducto"])){
    $obtener =  new AjaxInventario();
    $obtener->idInventario = $_POST["idProducto"];
    $obtener->ajaxInventarioPorProducto();

}



?>
