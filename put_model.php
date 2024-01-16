
<?php
    class Put_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function studios($data1, $data2, $data3, $data4, $data5){
            $consult = $this->conexion->query("CALL Studios('$data1', '$data2', '$data3', '$data4', '$data5')");
            return $consult;
        }

        public function gallery($data1){
            $consult = $this->conexion->query("CALL Gallery('$data1')");
            return $consult;
        }
        
    }
?>
