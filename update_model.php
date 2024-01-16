<?php
    class Update_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function Update_text($data1, $data2, $data3, $data4, $data5){
            $consult = $this->conexion->query("CALL SP_Update_text('$data1', '$data2', '$data3', '$data4', '$data5')");
            return $consult;
        }
    }
?>

