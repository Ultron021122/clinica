<?php
header('Content-Type: application/json');

$pdo = new PDO("mysql:host=localhost; dbname=sistema_clinico;","root","");
$query=$pdo->prepare("SELECT * FROM citas");
$query->execute();

$resultado=$query->fetchAll(PDO::FETCH_ASSOC);
$array = array();
$num = 0;
foreach ($resultado as $row) {
    $array[$num]["title"]='Cita médica '.$row['Hora'];
    $array[$num]["start"]=$row['Fecha'].'T'.$row['Hora'];
    $array[$num]["description"]=$row['Motivo'];
    $num ++;
}
echo json_encode($array);
// print_r($json);
?>
