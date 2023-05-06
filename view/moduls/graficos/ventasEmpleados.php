<?php

//buscar por rango de fechas
if(isset($_GET["fechaInicial"])){

    $item2 = $_GET["fechaInicial"];
    $valor2 = $_GET["fechaFinal"];

}else{

$$item2 = null;
$valor2 = null;
}


$valor = null;
$item = null;

$ventas = ControladorVentas::ctrRangoFechasVentas($item2, $valor2);


$usuarios = ControllerUser::ctrShowUser($item, $valor);

$arrayVendedores = array();
$arraylistaVendedores = array();

/* Recorrido de todas las facturas */
foreach ($ventas as $key => $valueVentas) {
/* Recorrido de todas los usuarios*/
foreach ($usuarios as $key => $valueUsuarios) {


    /* Facturas que pertenecen al mismo empleado */

    if($valueUsuarios["cedula"] == $valueVentas["idEmpleado"]){

        #Capturamos los vendedores en un array
        array_push($arrayVendedores, $valueUsuarios["nombre"]);

        #Capturamos las nombres y los valores totales en un mismo array
        $arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["total"]);

         #Sumamos los totales de cada vendedor

        foreach ($arraylistaVendedores as $key => $value) {

            $sumaTotalVendedores[$key] += $value;

         }

    }
  
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayVendedores);

?>


<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php
    if($noRepetirFechas != null){
        foreach($noRepetirNombres as $value){

            echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";
      
          }
    }else{

        echo "{ y: '0', ventas: '0' }";
      }
  ?>
  ],

  barColors: ['#0332C8'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '¢',
  hideHover: 'auto',
  gridTextFamily   : 'Open Sans',
  backgroundColor: '#fff'
});


</script>