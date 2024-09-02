<?php
include('../Includes/Connection.php');

$idasig = isset($_POST['idasig']) ? intval($_POST['idasig']) : 0;
$bimestre = isset($_POST['bimestre']) ? intval($_POST['bimestre']) : 0;
$evaluacion = isset($_POST['evaluacion']) ? trim($_POST['evaluacion']) : '';
$porcentaje = isset($_POST['porcentaje']) ? floatval($_POST['porcentaje']) : 0;

if ($idasig && $bimestre && !empty($evaluacion) && $porcentaje > 0) {
    $stmt = $conexion->prepare("INSERT INTO evaluaciones (idasig, bimestre, evaluacion, porcentaje) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisd", $idasig, $bimestre, $evaluacion, $porcentaje);
    if ($stmt->execute()) {
        echo "<script> document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: 'Evaluación registrada correctamente',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then((resultado) => {
                if (resultado.isConfirmed) {
                    window.location.href = 'addEvaluacion.php?idasig=$idasig';
                }
            });
        }); </script>";
    } else {
        echo "<script> document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'Error al registrar la evaluación',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }); </script>";
    }
    $stmt->close();
}
mysqli_close($conexion);

?>

