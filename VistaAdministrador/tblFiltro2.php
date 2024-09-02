<?php
include('../Includes/Connection.php');

if (isset($_GET['bimestre']) && isset($_GET['idasig'])) {
    $bimestre = intval($_GET['bimestre']);
    $idasig = intval($_GET['idasig']);

    $consulta = mysqli_query($conexion, "SELECT e.ideva, e.evaluacion, e.porcentaje, b.nombre AS nombre_bime 
                                        FROM evaluaciones e 
                                        INNER JOIN bimestres b ON e.bimestre = b.idbime 
                                        WHERE e.bimestre = '$bimestre' AND e.idasig = '$idasig'");
    while ($row = mysqli_fetch_assoc($consulta)) {
        echo "<tr>";
        echo "<td>" . $row['ideva'] . "</td>";
        echo "<td>" . $row['nombre_bime'] . "</td>";
        echo "<td>" . $row['evaluacion'] . "</td>";
        echo "<td>" . $row['porcentaje'] . "%</td>";
        echo "<td>
                <button class='btn btn-info' onclick='editarEvaluacion(" . $row['ideva'] . ", \"" . $row['evaluacion'] . "\", " . $row['porcentaje'] . ")'>Editar</button>
                <button class='btn btn-danger' onclick='confirmarBorrado(" . $row['ideva'] . ")'>Eliminar</button>
              </td>";
        echo "</tr>";
    }
}
?>
