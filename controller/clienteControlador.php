

<?php

class ControllerClient{

	//ctrNameClient que recibe de parámetro $cedula, que se utiliza para buscar un cliente por su número de id. 
	//El método llama al método estático mdlNameClient de la clase Client, pasándole el valor de $cedula como argumento. Luego,
	// el método devuelve la respuesta de mdlNameClient,
	static public function ctrNameClient($cedula){
		
		$respuesta = Client::mdlNameClient($cedula);
		return $respuesta;

	}

	/**REGISTRO DE CLIENTES*/
	static public function ctrCreateClient(){
		//"ctrCreateClient", la cual es responsable de agregar un nuevo cliente en la base de datos.
		if(isset($_POST["cedula"])){
			

			if(preg_match('/^[0-9]+$/', $_POST["cedula"])  
			   ){

				$table = "cliente";

			   
				//crea un array asociativo llamado $datas que contiene los datos 
				//del cliente ingresados en el formulario de registro. 
				$datas = array("cedula" => $_POST["cedula"], 
								"nomCliente" => $_POST["nomCliente"], 
								"apellidos" => $_POST["apellidos"],
								"telefonoCli" => $_POST["telefonoCli"],
								"email" => $_POST["email"],
								"direccion" => $_POST["direccion"]
								);
				//mdlAddCli ejecuta la consulta SQL para insertar los datos del cliente en la base de datos
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
	//$item: El campo de la tabla por el cual se buscará el cliente.
	//$valor: El valor correspondiente al campo por el cual se buscará el cliente.
	static public function ctrShowClient($item, $valor){

		$tabla = "cliente";
		//que se encarga de hacer la consulta a la base de datos) y se retorna la respuesta obtenida.
		$respuesta = Client::mdlShow($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrUpdateClient(){

		if(isset($_POST["cedulam"])){// verifica si se ha enviado un formulario con la información del cliente a actualizar
			//validación sobre el valor de cedulam para asegurarse de que solo contenga letras, números, espacios y caracteres especiales en español. 
			if(preg_match('/^[a-zA-Z-Z0-9ÑñáéíóúÁÉÍÓÚ ]+$/', $_POST["cedulam"])){

				$table = "cliente";
				//$datas que contiene los nuevos datos del cliente
				$datas = array("cedula" => $_POST["cedulam"], 
				"nomCliente" => $_POST["nomClientem"], 
				"apellidos" => $_POST["apellidosm"],
				"telefonoCli" => $_POST["telefonoClim"],
				"email" => $_POST["emailm"],
				"direccion" => $_POST["direccionm"]
				);



				//mdlUpdate de la clase Client para actualizar los datos del cliente en la base de datos. Este método recibe como parámetros el nombre de la tabla (cliente) y el array $datas con los nuevos datos del cliente.
				$respuesta = Client::mdlUpdate($table, $datas);
				//se muestra un mensaje de éxito
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
				//se muestra un mensaje de error.
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