<?php
    class paciente extends connection {

        protected $Curp;
        protected $Nombre;
        protected $Apellidos;
        protected $Sexo;
        protected $Fecha_nacimiento;
        protected $Direccion;
        protected $Telefono;
        protected $Email;

        public function __construct(){
            parent::__construct();
        }

        public function set_registro($Curp, $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email){
            $sql = "SELECT * FROM paciente WHERE CURP = '$Curp'";
            $consulta = $this->_db->query($sql);
            $respuesta = $consulta->fetch_all(MYSQLI_ASSOC);
            if(!$respuesta){
                $sql = "INSERT INTO paciente(CURP, Nombre, Apellidos, Sexo, Fecha_nacimiento, Direccion, Telefono, Email)VALUES('$Curp', '$Nombre', '$Apellidos', '$Sexo', '$Fecha_nacimiento', '$Direccion', '$Telefono', '$Email')";
                if($this->_db->query($sql)) {
                    $resultado = $this->select_paciente();
                    return $resultado;
                    $this->_db->close();
                } else {
                    return "ocurrio";
                }
            } else {
                return "existe";
            }
        }

        public function select_paciente(){
            $sql = "SELECT * FROM paciente";
            $resultado = $this->_db->query($sql);
            return $array = $resultado->fetch_all(MYSQLI_ASSOC);
        }
    }
?>