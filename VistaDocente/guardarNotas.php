<?php
require_once('../Includes/Connection.php');

$data = json_decode(file_get_contents('php://input'), true);
$iddoc = $data['iddoc'];
$idalum = $data['idalum'];
$idasig = $data['idasig'];
$bimestre = $data['bimestre'];
$ideva = $data['ideva'];
$notaValue = $data['nota'];

// Check if the note already exists
$checkQuery = mysqli_query($conexion, "SELECT * FROM evaluacionnotas WHERE iddoc='$iddoc' AND idalumn='$idalum' AND evalua='$ideva'");

if (mysqli_num_rows($checkQuery) > 0) {
    // If exists, update the note
    $query = mysqli_query($conexion, "UPDATE evaluacionnotas SET nota='$notaValue' WHERE iddoc='$iddoc' AND idalumn='$idalum' AND evalua='$ideva'");
} else {
    // If not, insert a new note
    $query = mysqli_query($conexion, "INSERT INTO evaluacionnotas (iddoc, idaula, idalumn, evalua, nota) 
                                      VALUES ('$iddoc', (SELECT aula FROM alumnos WHERE idalum = '$idalum'), '$idalum', '$ideva', '$notaValue')");
}

if (!$query) {
    echo json_encode(['success' => false, 'error' => mysqli_error($conexion)]);
    exit;
}

echo json_encode(['success' => true]);
?>
