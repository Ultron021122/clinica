<?php
    date_default_timezone_set('America/Mexico_City');

    class diagnostico extends connection {

        protected $ID;
        protected $FechaTiempo_diagnostico;
        protected $Medicacion;
        protected $Observaciones;
        protected $Examen_fisico;
        protected $ID_medico;
        protected $ID_expediente;

        public function __construct(){
            parent::__construct();
        }

        public function select_diagnostico($ID_expediente) {
            $sql = "SELECT * FROM diagnostico WHERE ID_expediente='$ID_expediente'";
            $resultado = $this->_db->query($sql);
            if ($resultado) {
                return $resultado->fetch_all(MYSQLI_ASSOC);
                $resultado->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function allselect_diagnostico() {
            $sql = "SELECT * FROM diagnostico";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function set_registro($Medicacion, $Observaciones, $Examen_fisico, $ID_medico, $ID_expediente) {
            $FechaTiempo_diagnostico = date('y-m-d h:i:s');
            $sql = "INSERT INTO diagnostico(FechaTiempo_diagnostico, Medicacion, Observaciones, Examen_fisico, ID_medico, ID_expediente)VALUES($FechaTiempo_diagnostico, $Medicacion, $Observaciones, $Examen_fisico, $ID_medico, $ID_expediente)";
            if ($this->_db->query($sql)) {
                $resultado = $this->allselect_diagnostico();
                return $resultado;
                $this->_db->close();
            } else {
                return "ocurrio";
            }
        }

        public function search_editar_registro($ID) {
            $sql = "SELECT * citas WHERE ID='$ID'";
            $resultado = $this->_db->query($sql);
            if ($resultado) {
                return $resultado->fetch_all(MYSQLI_ASSOC);
                $resultado->close();
                $this->_db->close();
            } else {
                return "error";
            }
        }

        public function modificar_registro($ID, $FechaTiempo_diagnostico, $Medicacion, $Observaciones, $Examen_fisico, $ID_medico, $ID_expediente) {
            $sql = "UPDATE diagnostico SET FechaTiempo_diagnostico='$FechaTiempo_diagnostico', Medicacion='$Medicacion', Observaciones='$Observaciones', Examen_fisico='$Examen_fisico', ID_medico='$ID_medico', ID_expediente='$ID_expediente'";
            if ($this->_db->query($sql)) {
                $resultado = $this->allselect_diagnostico();
                return $resultado;
                $this->_db->close();
            } else {
                return "ocurrio";
            }
        }

        public function eliminar_registro($ID) {
            $sql = "DELETE FROM diagnostico WHERE ID = '$ID'";
            if ($this->_db->query($sql)) {
                $resultado = $this->allselect_diagnostico();
                return $resultado;
            } else {
                return "error";
            }
        }

        
    }
?>