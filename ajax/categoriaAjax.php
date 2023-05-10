<?php

require_once "../controller/categoriaControlador.php";
require_once "../model/categoriaModelo.php";
// llamada Ajax que recupera datos para una categoría específica basada en su ID de categoría

//clase "AjaxCategories" con una función "ajaxUpdateCategories()" que recupera los datos de la categoría a través del controlador utiliza "idCategories" y  devuelve como una respuesta JSON.


class AjaxCategories{

    /*EDITAR CATEGORIA*/

    public $idCategories;

    public function ajaxUpdateCategories(){

        $item = "codigo";
        $valor = $this->idCategories;

        $respuesta = ControllerCategories::ctrShowCategories($item, $valor);

        echo json_encode($respuesta);

    }

}

//Se verifica si se ha recibido un valor para "idCategories" a través del método POST.
//se crea un objeto "AjaxCategories" y se asigna el valor de "idCategories" a su propiedad correspondiente.
//Se llama a la función "ajaxUpdateCategories()" del objeto "AjaxCategories" para recuperar los datos de la categoría y devolverlos como una respuesta JSON.
if(isset($_POST["idCategories"])){

    $update =  new AjaxCategories();
    $update->idCategories = $_POST["idCategories"];
    $update->ajaxUpdateCategories();
}

?>
