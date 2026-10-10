<?php
$conexion = mysqli_connect("localhost", "root", "", "gym_nexus");

$user = $_POST['user'];
$newpass = $_POST['newpass'];
$cnewpass = $_POST['cnewpass'];

if (strlen($newpass) >= 8) {
    if ($newpass == $cnewpass) {
        // Verificar si el usuario existe en la tabla "usuario"
        $query = "SELECT * FROM usuario WHERE user = '$user'";
        $result = mysqli_query($conexion, $query);
        
        if (mysqli_num_rows($result) > 0) {
            // Es un usuario
            $update_query = "UPDATE usuario SET contra = '$newpass' WHERE user = '$user'";
        } else {
            // No es un usuario, asumimos que es un gimnasio
            $update_query = "UPDATE gimnasio SET contra = '$newpass' WHERE user = '$user'";
        }
        
        $update_result = mysqli_query($conexion, $update_query);
        
        if ($update_result) {
            echo '<script type="text/javascript">';
            echo 'alert("Contraseña cambiada correctamente.");';
            echo 'window.location.href = "login.html";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error al cambiar la contraseña.");';
            echo 'window.location.href = "cambiocontra.php?user=' . $user . '";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("La contraseña no coincide.");';
        echo 'window.location.href = "cambiocontra.php?user=' . $user . '";';
        echo '</script>';
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("La contraseña debe tener más de 8 caracteres.");';
    echo 'window.location.href = "cambiocontra.php?user=' . $user . '";';
    echo '</script>';
}
?>



