<?php
$conexion = mysqli_connect("localhost", "root", "", "gym_nexus");

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    if ($_POST['ccontra'] == $_POST['contra']) {
        if (strlen($_POST['contra']) >= 8) {
            $email = $_POST['email'];
            $user = $_POST['user'];

            // Verificar si el correo electrónico ya está registrado
            $verificarEmail = "CALL VerificarEmail('$email', @email_count)";
            mysqli_query($conexion, $verificarEmail);
            $result = mysqli_query($conexion, "SELECT @email_count as email_count");
            $row = mysqli_fetch_assoc($result);
            $email_count = $row['email_count'];

            // Verificar si el nombre de usuario ya está registrado
            $verificarUser = "CALL VerificarUser('$user', @user_count)";
            mysqli_query($conexion, $verificarUser);
            $result = mysqli_query($conexion, "SELECT @user_count as user_count");
            $row = mysqli_fetch_assoc($result);
            $user_count = $row['user_count'];

            if ($email_count == 0 && $user_count == 0) {
                // Insertar usuario utilizando el stored procedure
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $contra = $_POST['contra'];
                $telefono = $_POST['telefono'];

                $insertarUsuario = "CALL InsertarUsuario('$nombre', '$apellido', '$email', '$contra', '$user', '$telefono')";
                mysqli_query($conexion, $insertarUsuario);

                echo '<script type="text/javascript">';
                echo 'alert("Usuario registrado correctamente.");';
                echo 'window.location.href = "login.html";';
                echo '</script>';
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("La dirección de correo electrónico y/o nombre de usuario ya han sido registrados anteriormente.");';
                echo 'window.location.href = "signup.html";';
                echo '</script>';
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("La contraseña debe tener más de 8 caracteres.");';
            echo 'window.location.href = "signup.html";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("La contraseña no coincide.");';
        echo 'window.location.href = "signup.html";';
        echo '</script>';
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("La dirección de correo electrónico no cumple los requisitos solicitados.");';
    echo 'window.location.href = "signup.html";';
    echo '</script>';
}
?>

 

