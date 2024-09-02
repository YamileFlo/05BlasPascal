<?php
include('../Includes/Connection.php');

if (isset($_GET['idaula'])) {
    $idaula = intval($_GET['idaula']);
    
    $query = "DELETE FROM aulas WHERE idaula = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idaula);
    
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
    $stmt->close();
}
mysqli_close($conexion);
?>
