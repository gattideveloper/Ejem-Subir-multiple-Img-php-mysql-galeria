<?php
    class Get_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function Get_studios($data1, $data2, $data3){
            $consult = $this->conexion->query("CALL Get_studios('$data1', '$data2', '$data3')");
            return $consult;
        }        

        public function Get_patient($data1){
            $consult = $this->conexion->query("CALL Get_patient('$data1')");
            return $consult;
        }

        public function Get_destiny($data1){
            $consult = $this->conexion->query("CALL Get_destiny('$data1')");
            return $consult;
        }

        public function gallery($data1){
            $consult = $this->conexion->query("CALL Get_gallery('$data1')");
            return $consult;
        }

        public function studie($data1){
            $consult = $this->conexion->query("CALL Get_studie('$data1')");
            return $consult;
        }

        public function GET_studies($data1){
            $consult = $this->conexion->query("CALL SP_GET_studies('$data1')");
            return $consult;
        }

        public function Get_studieDestino($data1){
            $consult = $this->conexion->query("CALL SP_Get_studieDestino('$data1')");
            return $consult;
        }

        public function Get_DataStudie($data1, $data2, $data3){
            $consult = $this->conexion->query("CALL SP_Get_DataStudie('$data1', '$data2', '$data3')");
            return $consult;
        }

        public function Get_EditStudie($data1, $data2, $data3){
            $consult = $this->conexion->query("CALL SP_Get_EditStudie('$data1', '$data2', '$data3')");
            return $consult;
        }
    }
?>