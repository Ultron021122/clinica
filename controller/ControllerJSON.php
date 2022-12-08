<?php
    // header('Content-Type: application/json');
    require_once("../php/connection.php");
    require_once("ControllerCita.php");
    require_once("ControllerMedico.php");
    session_start();

    // $pdo = new PDO("mysql:host=localhost; dbname=sistema_clinico;","root","");
    $ID = $_SESSION['id'];

    $medico = new medico();
    $cita = new cita();

    $MedicoID = $medico->agenda_medico_usuario($ID);
    $medico_ID = $MedicoID[0]['ID'];
    $_SESSION['id_medico'] = $medico_ID;
    $cita_medico = $cita->mostrar_citas_medico($medico_ID);

    $array = array();
    $num = 0;
    foreach ($cita_medico as $row) {
        $array[$num]["title"]='Cita médica '.$row['Hora'];
        $array[$num]["start"]=$row['Fecha'].'T'.$row['Hora'];
        $array[$num]["description"]=$row['Motivo'];
        $array[$num]["url"]="expediente_medico.php?paciente=".$row['Paciente_ID'];
        // $array[$num]["color"]=randomColor();
        $num ++;
    }

    function randomColor(){
        $str = "#";
        for($i = 0 ; $i < 6 ; $i++){
        $randNum = rand(0, 15);
        switch ($randNum) {
        case 10: $randNum = "A"; 
        break;
        case 11: $randNum = "B"; 
        break;
        case 12: $randNum = "C"; 
        break;
        case 13: $randNum = "D"; 
        break;
        case 14: $randNum = "E"; 
        break;
        case 15: $randNum = "F"; 
        break; 
        }
        $str .= $randNum;
        }
        return $str;
    }
    //Fin de la función.

    // <?php echo "expediente.php?username=".$items['CURP_paciente']
    echo json_encode($array);
    // print_r($json);
?>
