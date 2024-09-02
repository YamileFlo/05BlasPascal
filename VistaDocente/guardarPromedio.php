<?php
require_once('../Includes/Connection.php');

$data = json_decode(file_get_contents('php://input'), true);
$iddoc = $data['iddoc'];
$idalum = $data['idalum'];
$idasig = $data['idasig'];
$bimestre = $data['bimestre'];
$promedio = $data['promedio'];

$query = mysqli_query($conexion, "REPLACE INTO promedios (iddoc, idalumn, idasig, idbime, promedio) 
                                  VALUES ('$iddoc', '$idalum', '$idasig', '$bimestre', '$promedio')");

if (!$query) {
    echo json_encode(['success' => false, 'error' => mysqli_error($conexion)]);
    exit;
}

echo json_encode(['success' => true]);
?>
