<?php
    require_once("../php/connection.php");
    require_once ("../controller/ControllerPaciente.php");
    $tipo_consulta = $_POST['tipo_operacion'];
    switch ($tipo_consulta) {
        case 'guardar':
            $CURP               = $_POST['Curp'];
            $Nombre             = $_POST['Nombre'];
            $Apellidos          = $_POST['Apellidos'];
            $Sexo               = $_POST['Sexo'];
            $Fecha_nacimiento   = $_POST['Fecha_nacimiento'];
            $Direccion          = $_POST['Direccion'];
            $Telefono           = $_POST['Telefono'];
            $Email              = $_POST['Email'];
            $consultas  = new paciente();
            $ejecutar = $consultas->set_registro(strtoupper($CURP), $Nombre, $Apellidos, $Sexo, $Fecha_nacimiento, $Direccion, $Telefono, $Email);
            echo json_encode($ejecutar);
        break;  
        default:
            # code...
            break;
    }

?>