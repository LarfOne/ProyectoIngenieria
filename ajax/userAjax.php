<?php

require_once "../controller/userController.php";
require_once "../model/userModel.php";
// "AjaxUser" que tiene una función llamada "ajaxUpdateUser" que recupera información del usuario mediante una solicitud al controlador
//devuelve un JSON
class AjaxUser{

    /**EDITAR USUARIOS */

    public $idEmpleado;

    public function ajaxUpdateUser(){

        $item = "cedula";
        $valor = $this->idEmpleado;

        $respuesta = ControllerUser::ctrShowUser($item, $valor);

        echo json_encode($respuesta);

    }

}
//se instancia un objeto de la clase "AjaxUser" y se llama a la función "ajaxUpdateUser" para actualizar la información del usuario 
//en la base de datos.

if(isset($_POST["idEmpleado"])){

    $update =  new AjaxUser();
    $update->idEmpleado = $_POST["idEmpleado"];
    $update->ajaxUpdateUser();
}

?>