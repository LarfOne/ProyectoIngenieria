<?php 
    class ControllerAudit{

        static public function ctrShowAuditProducts($item, $valor){
            
            $tabla = "audit_producto";
            
            $respuesta = Auditoria::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }
        static public function ctrShowUser($item, $valor){

            $tabla = "empleado";
            
            $respuesta = User::mdlShow($tabla, $item, $valor);
            return $respuesta;
        }
    }

?>