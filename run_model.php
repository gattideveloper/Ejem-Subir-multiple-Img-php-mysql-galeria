<?php
    class Run_Model{
        private $conexion;
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function destiny(){
            $consult = $this->conexion->query("CALL Destiny()");
            return $consult;
        }

        public function paciente(){
            $consult = $this->conexion->query("CALL Paciente()");
            return $consult;
        }
        
        public function Run_Studies(){
            $consult = $this->conexion->query("CALL SP_Run_Studies()");
            return $consult;
        }
    }
?>
