

<?php

class ControllerClient{


	static public function ctrNameClient($cedula){
		
		$respuesta = Client::mdlNameClient($cedula);
		return $respuesta;

	}

	/**REGISTRO DE Clientes*/
	static public function ctrCreateClient(){
		if(isset($_POST["cedula"])){
			

			if(preg_match('/^[0-9]+$/', $_POST["cedula"])  
			   ){

				$table = "cliente";

			   

				$datas = array("cedula" => $_POST["cedula"], 
								"nomCliente" => $_POST["nomCliente"], 
								"apellidos" => $_POST["apellidos"],
								"telefonoCli" => $_POST["telefonoCli"],
								"email" => $_POST["email"],
								"direccion" => $_POST["direccion"]
								);

				$respuesta = Client::mdlAddCli($table, $datas);
				
				if($respuesta == "ok"){
					echo "<script>
					
						Swal.fire({
							title: 'El cliente se agregó correctamente',
							icon: 'success',
						}).then((result) => {
							window.location = 'cliente';
						})

					</script>";
				}


				

			}else{

				echo "<script>
				
				Swal.fire({
					title: 'No se puede agregar el Cliente',
					icon: 'error',
				}).then((result) => {
					window.location = 'cliente';
				})
				</script>";
			}
		}
	}

	static public function ctrShowClient($item, $valor){

		$tabla = "cliente";
		
		$respuesta = Client::mdlShow($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrUpdateClient(){

		if(isset($_POST["cedulam"])){

			if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["cedulam"])){

				$table = "cliente";

				$datas = array("cedula" => $_POST["cedulam"], 
				"nomCliente" => $_POST["nomClientem"], 
				"apellidos" => $_POST["apellidosm"],
				"telefonoCli" => $_POST["telefonoClim"],
				"email" => $_POST["emailm"],
				"direccion" => $_POST["direccionm"]
				);




				$respuesta = Client::mdlUpdate($table, $datas);
				
				if($respuesta == "ok"){
					echo "<script>
					
						Swal.fire({
							title: 'El Cliente se modificó correctamente',
							icon: 'success',
						}).then((result) => {
							window.location = 'cliente';
						})
					</script>";
				}


				

			}else{

				echo "<script>
				
				Swal.fire({
					title: 'No se puede modificar el Cliente',
					icon: 'error',
				}).then((result) => {
					window.location = 'cliente';
				})
				</script>";
			}
		}
	}

	static public function ctrDeleteClient(){

		if(isset($_GET["codigoE"])){

			$table = "cliente";
			$data = $_GET["codigoE"];
			
			$respuesta =Client::mdlDeleteClient($table, $data);

			if($respuesta == "ok"){
				echo "<script>
				
					Swal.fire({
						title: 'El Cliente se eliminó correctamente',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						closeOnConfirm: false,
						icon: 'success',
					}).then((result) => {
						if(result.value){
							window.location = 'cliente';
						}
						
					})
				</script>";

			}
		
		}
		   
	}
	
	static public function ctrClientesCantidad (){
		$tabla = "cliente";
		$item = "cedula";
		$respuesta = Client::mdlMostrarCantidadCliente($tabla, $item);
		return $respuesta;
	}
}



?>  