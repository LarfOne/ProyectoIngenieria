<?php 
    class ControllerAudit{
        static public function ctrShowAuditProducts($item, $valor){
            
            $tabla = "audit_producto";// $tabla contiene el nombre de la tabla "audit_producto". Este nombre de tabla se utiliza en el método mdlShowAuditProduct
            
            $respuesta = Auditoria::mdlShowAuditProduct($tabla, $item, $valor);
            return $respuesta;
        }
    }

?>