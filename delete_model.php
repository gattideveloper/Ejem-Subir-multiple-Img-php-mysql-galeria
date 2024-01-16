
<?php
    class Delete_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function Delete_studios($data1){
            $consult = $this->conexion->query("CALL SP_Delete_studios('$data1')");
            return $consult;
        }
        
        public function Delete_gallery($data1){
            $consult = $this->conexion->query("CALL SP_Delete_gallery('$data1')");
            return $consult;
        }
    }
?>
