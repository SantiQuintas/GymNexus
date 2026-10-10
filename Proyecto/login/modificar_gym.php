<?php
$conexion = mysqli_connect("localhost","root","","gym_nexus");
session_start();

$user = $_SESSION['user'];

$email = $_POST["email"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];
$contra = $_POST["contra"];
$ccontra = $_POST["ccontra"];
$foto = $_POST["foto"];
$cuil = $_POST["cuil"];
$nombregym = $_POST["nombregym"];
$descripcion = $_POST["descripcion"];
$servicios = $_POST["servicios"];
$equipamiento = $_POST["equipamiento"];
$mensualidad = $_POST["mensualidad"];
$dia = $_POST["dia"];
$horario = $_POST["horario"];
$direccion = $_POST["direccion"];
$maps = $_POST["maps"];
$foto1 = $_POST["foto1"];
$foto2 = $_POST["foto2"];
$foto3 = $_POST["foto3"];
$foto4 = $_POST["foto4"];
$foto5 = $_POST["foto5"];

if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    if($contra ==$ccontra){
        if(strlen($contra)>=8){
            $cn = "UPDATE gimnasio SET maps='$maps', email='$email', nombre='$nombre', apellido='$apellido', telefono='$telefono', contra='$contra', foto='$foto', cuil='$cuil', nombregym='$nombregym', descripcion='$descripcion', servicios='$servicios', equipamiento='$equipamiento', mensualidad='$mensualidad', dia='$dia', horario='$horario', direccion='$direccion', foto1='$foto1', foto2='$foto2', foto3='$foto3', foto4='$foto4', foto5='$foto5' WHERE user='$user'";
            $a = mysqli_query($conexion, $cn);
            
            echo '<script type="text/javascript">';
            echo 'alert("Los datos han sido actualizados correctamente.");';
            echo 'window.location.href = "administraciongym.php";';
            echo '</script>';
        }
    }
}
else{
    echo '<script type="text/javascript">';
    echo 'alert("Error, verifique que todos los campos hayan sido completados correctamente.");';
    echo 'window.location.href = "administraciongym.php";';
    echo '</script>';
}
?>