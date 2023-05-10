<?php 
//El método ctrShowAuditProducts espera dos parámetros: $item y $valor. Estos parámetros se utilizarán para buscar y filtrar datos en la tabla "audit_producto".
    class ControllerAudit{

        static public function ctrShowAuditProducts($item, $valor){
            
            $tabla = "audit_producto";// $tabla contiene el nombre de la tabla "audit_producto". Este nombre de tabla se utiliza en el método mdlShowAuditProduct.
            
            $respuesta = Auditoria::mdlShowAuditProduct($tabla, $item, $valor);
            return $respuesta;//La variable $respuesta contiene el resultado de la búsqueda y filtrado de datos realizados en la tabla "audit_producto".
        }
    }

?>