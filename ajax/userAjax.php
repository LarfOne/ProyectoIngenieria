<?php

require_once "../controller/userController.php";
require_once "../model/userModel.php";

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


if(isset($_POST["idEmpleado"])){

    $update =  new AjaxUser();
    $update->idEmpleado = $_POST["idEmpleado"];
    $update->ajaxUpdateUser();
}

?>