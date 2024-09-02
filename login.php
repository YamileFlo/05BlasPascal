<?php
session_start();
require_once "Includes/Connection.php"; // Incluye la conexión a la base de datos

if (!empty($_SESSION['active'])) {
    switch ($_SESSION['role']) {
        case 'docente':
            header('location: VistaDocente/index.php');
            break;
        case 'administrador':
            header('location: VistaAdministrador/index.php');
            break;
        case 'alumno':
            header('location: VistaAlumno/index.php');
            break;
    }
    exit();
}

if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
        $error = 'Ingrese las credenciales correctas';
    } else {
        $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

        // Consulta para docentes
        $query_docentes = mysqli_query($conexion, "SELECT * FROM docentes WHERE dni = '$user'");
        $resultado_docentes = mysqli_num_rows($query_docentes);

        // Consulta para administradores
        $query_administradores = mysqli_query($conexion, "SELECT * FROM administradores WHERE dni = '$user'");
        $resultado_administradores = mysqli_num_rows($query_administradores);

        // Consulta para alumnos
        $query_alumnos = mysqli_query($conexion, "SELECT * FROM alumnos WHERE dni = '$user'");
        $resultado_alumnos = mysqli_num_rows($query_alumnos);

        $user_found = false;
        if ($resultado_docentes > 0) {
            $dato = mysqli_fetch_array($query_docentes);
            if (password_verify($clave, $dato['clave'])) {
                $user_found = true;
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['iddoc'];
                $_SESSION['nombres'] = $dato['nombres'];
                $_SESSION['apellidos'] = $dato['apellidos'];
                $_SESSION['user'] = $dato['dni'];
                $_SESSION['role'] = 'docente';
                header('Location: VistaDocente/index.php');
            }
        } elseif ($resultado_administradores > 0) {
            $dato = mysqli_fetch_array($query_administradores);
            if (password_verify($clave, $dato['clave'])) {
                $user_found = true;
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['idadm'];
                $_SESSION['nombres'] = $dato['nombres'];
                $_SESSION['apellidos'] = $dato['apellidos'];
                $_SESSION['user'] = $dato['dni'];
                $_SESSION['role'] = 'administrador';
                header('Location: VistaAdministrador/index.php');
            }
        } elseif ($resultado_alumnos > 0) {
            $dato = mysqli_fetch_array($query_alumnos);
            if (password_verify($clave, $dato['clave'])) {
                $user_found = true;
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['idalum'];
                $_SESSION['nombres'] = $dato['nombres'];
                $_SESSION['apellidos'] = $dato['apellidos'];
                $_SESSION['user'] = $dato['dni'];
                $_SESSION['role'] = 'alumno';
                header('Location: VistaAlumno/index.php');
            }
        }

        if (!$user_found) {
            $error = 'Credenciales incorrectas';
            session_destroy();
        }

        mysqli_close($conexion);
    }
}
?>
