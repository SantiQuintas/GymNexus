<?php
$conexion = mysqli_connect("localhost","root","","gym_nexus");
session_start();

$user = $_SESSION['user'];

$cn = "DELETE FROM usuario WHERE user =  '$user'";
$a = mysqli_query($conexion, $cn);

echo '<script type="text/javascript">';
echo 'alert("Usuario eliminado correctamente.");';
echo 'window.location.href = "login.html";';
echo '</script>';
?>