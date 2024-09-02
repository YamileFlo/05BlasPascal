<?php
include('../Includes/Connection.php');

if (isset($_POST['ideva']) && isset($_POST['evaluacion']) && isset($_POST['porcentaje'])) {
    $ideva = intval($_POST['ideva']);
    $evaluacion = mysqli_real_escape_string($conexion, $_POST['evaluacion']);
    $porcentaje = floatval($_POST['porcentaje']);
    
    $query = "UPDATE evaluaciones SET evaluacion = '$evaluacion', porcentaje = $porcentaje WHERE ideva = $ideva";
    if (mysqli_query($conexion, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
