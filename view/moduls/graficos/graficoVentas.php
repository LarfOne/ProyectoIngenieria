<?php
error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;


}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();
foreach ($respuesta as $key => $values) {

        #Captura el año y el mes
        $fecha = substr($values["fechaFactura"],0,7);
        #mete las fechas en el  arrayFechas
        array_push($arrayFechas,$fecha);
	    #todas las ventas las ventas
	    $arrayVentas = array($fecha => $values["total"]);
        #Suma los pagos que ocurrieron el mismo mes
	    foreach ($arrayVentas as $ke => $values) {
            $sumaPagosMes[$ke]+=$values;	
	    }
       // var_dump($sumaPagosMes);
}


$noRepetirFechas = array_unique($arrayFechas);
?>


<!--=====================================
GRÁFICO DE VENTAS
======================================-->


<div class="box box-solid bg-teal-gradient">
	
	<div class="box-header">
		<h3 class="box-title">Gráfico de Ventas</h3>

	</div>
	<div class="box-body border-radius-none nuevoGraficoVentas">
		<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
    </div>
</div>

<script>
	
var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";


	    }

	    echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";

    }else{

      echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors: ['#112975','#ff3321'],
    lineWidth        : 4,
    hideHover        : 'auto',
    gridTextColor    : '#0332C8',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#0332C8'],
    gridLineColor    : '#0332C8',
    gridTextFamily   : 'Open Sans',
    preUnits         : '¢',
    gridTextSize     : 10
  });

</script>