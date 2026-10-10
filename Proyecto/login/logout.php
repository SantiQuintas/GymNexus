<?php
$conexion = mysqli_connect("localhost","root","","gym_nexus");
session_start();

$user = $_SESSION['user'];
$gym = $_SESSION['gym'];

session_unset();


header('location: login.html');

exit();



?>