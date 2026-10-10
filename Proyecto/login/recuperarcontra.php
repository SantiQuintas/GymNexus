<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$email = $_POST['email'];

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "gym_nexus");

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

// Sentencia preparada para buscar el email en la tabla "usuario"
$stmt = $conn->prepare("SELECT id_user FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id_user);
    $stmt->fetch();

    // Ahora, obtén el campo 'user' asociado a este 'id_user'
    $user_query = $conn->prepare("SELECT user FROM usuario WHERE id_user = ?");
    $user_query->bind_param("i", $id_user);
    $user_query->execute();
    $user_query->store_result();

    if ($user_query->num_rows > 0) {
        $user_query->bind_result($user);
        $user_query->fetch();
    }
} else {
    // Si el email no se encuentra en la tabla "usuario", buscar en la tabla "gimnasio"
    $stmt = $conn->prepare("SELECT id_gym FROM gimnasio WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user);
        $stmt->fetch();

        // Ahora, obtén el campo 'user' asociado a este 'id_user' en la tabla "gimnasio"
        $user_query = $conn->prepare("SELECT user FROM gimnasio WHERE id_gym = ?");
        $user_query->bind_param("i", $id_user);
        $user_query->execute();
        $user_query->store_result();

        if ($user_query->num_rows > 0) {
            $user_query->bind_result($user);
            $user_query->fetch();
        }
    } else {
        die("Email no encontrado en ninguna de las tablas.");
    }
}

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gymnexus@outlook.com';
    $mail->Password = 'azucaramelamambreta23';
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('gymnexus@outlook.com', 'Gymnexus');
    $mail->addAddress($email, 'Prueba');
    $mail->isHTML(true);

    // Cuerpo del correo
    $mail->Subject = 'Recuperacion de contraseña';
    $mail->Body = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, por favor, visita la siguiente página para efectuar el cambio: <a href="localhost/proyecto/login/cambiocontra.php?user=' . $user . '">Recuperación de contraseña</a>';
    
    // Enviar el correo
    $mail->send();
    echo 'Mensaje enviado correctamente.';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado correctamente, error: {$mail->ErrorInfo}";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
