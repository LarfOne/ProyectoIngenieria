<?php 
    class ControllerAudit{

        static public function ctrShowAuditProducts($item, $valor){
            
            $tabla = "audit_producto";
            
            $respuesta = Auditoria::mdlShowAuditProduct($tabla, $item, $valor);
            return $respuesta;
        }
    }

?>