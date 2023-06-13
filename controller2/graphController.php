<?php
    require 'graphModel.php';
    $MG = new ModeloGrafico();
    $consulta = $MG ->TraerDatosGraficos();
    echo json_encode($consulta);


?>