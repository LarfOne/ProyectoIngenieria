<?php

require_once "../controller/clientController.php";
require_once "../model/clientModel.php";

class AjaxClient{
	/*=============================================
	EDITAR CLIENTE
	=============================================*/	
	public $idClient;

	public function ajaxUpdateClient(){

		$item = "cedula";
		$valor = $this->idClient;

		$respuesta = ControllerClient::ctrShowClient($item, $valor);

		echo json_encode($respuesta);
	}
}
/*=============================================
EDITAR CLIENTE
=============================================*/	
if(isset($_POST["idClient"])){

	$client = new AjaxClient();
	$client -> idClient = $_POST["idClient"];
	$client -> ajaxUpdateClient();

}