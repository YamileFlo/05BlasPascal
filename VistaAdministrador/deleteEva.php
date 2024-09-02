<?php
include('../Includes/Connection.php');

if (isset($_GET['ideva'])) {
    $ideva = intval($_GET['ideva']);
    
    $query = "DELETE FROM evaluaciones WHERE ideva = $ideva";
    if (mysqli_query($conexion, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
