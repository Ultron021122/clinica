<?php
    require_once("../php/connection.php");
    require_once("../controller/ControllerDiagnostico.php");
    $tipo_consulta = $_POST['tipo_operacion'];
    switch ($tipo_consulta) {
        case 'insert':
            $ID_medico          = $_POST['ID_medico'];
            $ID_expediente      = $_POST['ID_expediente'];
            $Examen_fisico      = $_POST['Examen_fisico'];
            $Observaciones      = $_POST['Observaciones'];
            $Medicacion         = $_POST['Medicacion'];
            $consultas = new diagnostico();
            $ejecutar = $consultas->set_registro($Medicacion, $Observaciones, $Examen_fisico, $ID_medico, $ID_expediente);
            echo json_encode($ejecutar);
            break;
        case 'eliminar':
            $ID = $_POST['id'];
            $ID_expediente = $_POST['idExpediente'];
            $consultas = new diagnostico();
            $ejecutar = $consultas->eliminar_registro($ID, $ID_expediente);
            echo json_encode($ejecutar);
            break;
        default:
            # code...
            break;
    }

?>