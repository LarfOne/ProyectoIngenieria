<?php

require_once "../controller/inventarioController.php";
require_once "../model/inventarioModel.php";

class AjaxInventario{

    /*EDITAR SUCURSAL*/

    public $idInventario;
    public $idProducto;
 //recibe el ID de un producto y llama al controlador correspondiente para obtener el código del inventario asociado a ese producto. Luego, devuelve 
    //la respuesta en formato JSON.
    public function ajaxUpdateInventario(){ 

        $item = "codigo";
        $valor = $this->idInventario;

        $respuesta = ControllerInventario::ctrShowInventario($item, $valor);

        echo json_encode($respuesta);

    }

    public function ajaxInventarioPorProducto(){ 

        $item = "idProducto";

        $valor = $this->idProducto;

        $respuesta = ControllerInventario::ctrCodigoInventarioPorProducto($item, $valor);

        echo json_encode($respuesta);

    }

}
// verifica si se ha enviado una solicitud POST con el parámetro "idInventario" o "idProducto"
//devuelve en JSON

if(isset($_POST["idInventario"])){

    $update =  new AjaxInventario();
    $update->idInventario = $_POST["idInventario"];
    $update->ajaxUpdateInventario();

}

if(isset($_POST["idProducto"])){
    
    $obtener =  new AjaxInventario();
    $obtener->idProducto = $_POST["idProducto"];
    $obtener->ajaxInventarioPorProducto();

}

?>
