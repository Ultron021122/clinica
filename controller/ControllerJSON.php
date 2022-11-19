<?php
    // header('Content-Type: application/json');
    require_once("../php/connection.php");
    require_once("ControllerCita.php");
    require_once("ControllerMedico.php");
    session_start();

    // $pdo = new PDO("mysql:host=localhost; dbname=sistema_clinico;","root","");
    $ID = $_SESSION['id'];
    // $query=$pdo->prepare("SELECT * FROM citas");
    // $query->execute();
    // $resultado=$query->fetchAll(PDO::FETCH_ASSOC);
    $medico = new medico();
    $cita = new cita();

    $MedicoID = $medico->agenda_medico_usuario($ID);
    $medico_ID = $MedicoID[0]['ID'];
    $cita_medico = $cita->mostrar_citas_medico($medico_ID);

    $array = array();
    $num = 0;
    foreach ($cita_medico as $row) {
        $array[$num]["title"]='Cita médica '.$row['Hora'];
        $array[$num]["start"]=$row['Fecha'].'T'.$row['Hora'];
        $array[$num]["description"]=$row['Motivo'];
        $array[$num]["url"]="expediente_medico.php?expediente=".$row['Paciente_ID'];
        $num ++;
    }
    // <?php echo "expediente.php?username=".$items['CURP_paciente']
    echo json_encode($array);
    // print_r($json);
?>
