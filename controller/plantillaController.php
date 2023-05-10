<?php
//Al llamar al método ctrPlantilla(), se incluirá el archivo view/plantilla.php que contiene la estructura
// básica de la interfaz de usuario de la aplicación, 
class ControllerPlantilla{

    public function ctrPlantilla(){
        include "view/plantilla.php";
    }

}

?>

