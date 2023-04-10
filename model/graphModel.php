<?php

class ModeloGrafico{

private $Conexion;
function __construct()
{
    
require_once('conexion.php');
$this->Conexion = new Conexion();
$this->Conexion->conectar();

}
function TraerDatosGraficos(){

$sql = "SELECT * FROM producto";
$array = array();
if($consulta = $this->Conexion->conexion->query($sql)){

    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        # code...

        $array[] = $consulta_VU;

 
    }
    return $array;
    $this->Conexion->cerrar();


}



}









}


?>