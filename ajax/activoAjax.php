<?php

require_once "../controller/activoControlador.php";
require_once "../model/activoModel.php";
//código PHP para llamada Ajax que recupera datos para un objeto "Activo"
// específico basado en su valor de "codigo" (código). El código incluye lo siguiente:

// "ajaxUpdateActivo()" que recupera los datos del objeto "Activo" a través del controlador utilizando el "codigo" y los devuelve como una respuesta JSON.

class AjaxActivo{

    /*EDITAR ACTIVO*/

    public $codigo;
    
    public function ajaxUpdateActivo(){

        $item = "codigo";
        $valor = $this->codigo;

        $respuesta = ControllerActivos::ctrShowActivo($item, $valor);

        echo json_encode($respuesta);

    }

}
//Se verifica si ha recibido un valor para "codigo" a través del método POST.
//se crea un objeto "AjaxActivo" y se asigna el valor de "codigo" a su propiedad correspondiente.
//Se llama a "ajaxUpdateActivo()" del objeto "AjaxActivo" para recuperar los datos del objeto "Activo" y devolverlos como una respuesta JSON.

if(isset($_POST["codigo"])){

    $update =  new AjaxActivo();
    $update->codigo = $_POST["codigo"];
    $update->ajaxUpdateActivo();
}

?>

