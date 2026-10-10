<?php
session_start();

$user = $_SESSION['user'];
$_SESSION['nombregym'] = $_POST['nombregym'];


header('location: perfil.php');
?>