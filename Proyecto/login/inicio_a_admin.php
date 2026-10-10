<?php
session_start();

$user = $_SESSION['user'];
$gym = $_SESSION['gym'];

if ($_SESSION['gym'] == false){
    header('location: administracion.php');}
else{
    header('location: administraciongym.php');
}


?>