<?php

class ModeloGrafico{

private $Conexion;
//constructor crea una instancia de la clase Conexion y establece una conexión a la base de datos. 
function __construct()
{
    
require_once('conexion.php');
$this->Conexion = new Conexion();
$this->Conexion->conectar();

}
function TraerDatosGraficos(){
//TraerDatosGraficos realiza una consulta a la base de datos para seleccionar todos los datos de la tabla "producto"
// y los devuelve en un arreglo.
$sql = "SELECT * FROM producto";
$array = array();
if($consulta = $this->Conexion->conexion->query($sql)){

    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        # code...

        $array[] = $consulta_VU;

 
    }
    return $array;//retorna un arreglo.
    $this->Conexion->cerrar();


}



}









}


?>