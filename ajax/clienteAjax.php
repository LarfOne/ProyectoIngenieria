<?php

require_once "../controller/clienteControlador.php";
require_once "../model/clienteModelo.php";
// AjaxClient que tiene un método ajaxUpdateClient().
// El método no acepta parámetros, variable llamada $idClient 
//con un valor recibido desde un parámetro de solicitud POST llamado "idClient".
class AjaxClient{
	/*=============================================
	EDITAR CLIENTE
	=============================================*/	
	public $idClient;
//ajaxUpdateClient() imprime la respuesta en formato JSON. En general, el código 
//se utiliza para actualizar un cliente utilizando una llamada AJAX.
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