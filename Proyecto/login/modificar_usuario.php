<?php
$conexion = mysqli_connect("localhost","root","","gym_nexus");
session_start();

$user = $_SESSION['user'];

$foto = $_POST["foto"];
$email = $_POST["email"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];
$contra = $_POST["contra"];
$ccontra = $_POST["ccontra"];

if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    if($contra ==$ccontra){
        if(strlen($contra)>=8){
            $cn= "UPDATE usuario SET email='$email', nombre='$nombre', apellido='$apellido', telefono='$telefono', contra='$contra', foto='$foto' WHERE user='$user'";
            $a = mysqli_query($conexion, $cn);
            
            echo '<script type="text/javascript">';
            echo 'alert("Los datos han sido actualizados correctamente.");';
            echo 'window.location.href = "administracion.php";';
            echo '</script>';
        }
    }
}
else{
    echo '<script type="text/javascript">';
    echo 'alert("Error, verifique que todos los campos hayan sido completados correctamente.");';
    echo 'window.location.href = "administracion.php";';
    echo '</script>';
}
?>