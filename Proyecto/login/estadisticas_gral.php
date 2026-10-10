<?php
$conexion = mysqli_connect("localhost", "root", "", "gym_nexus");
session_start();

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

// Consulta para obtener todos los usuarios registrados
$consultaUsuarios = "SELECT * FROM usuario";
$resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);

// Consulta para obtener todos los gimnasios registrados
$consultaGimnasios = "SELECT * FROM gimnasio";
$resultadoGimnasios = mysqli_query($conexion, $consultaGimnasios);

// Consulta para obtener la valoración promedio de los gimnasios
$consultaValoracionPromedio = "SELECT nombregym, AVG(puntuacion) AS promedio FROM puntuaciones GROUP BY nombregym";
$resultadoValoracionPromedio = mysqli_query($conexion, $consultaValoracionPromedio);

// Consulta para obtener el precio mensual promedio de los gimnasios
$consultaPrecioMensualPromedio = "SELECT AVG(mensualidad) AS promedio FROM gimnasio";
$resultadoPrecioMensualPromedio = mysqli_query($conexion, $consultaPrecioMensualPromedio);
$filaPrecioMensualPromedio = mysqli_fetch_assoc($resultadoPrecioMensualPromedio);
$precioMensualPromedio = $filaPrecioMensualPromedio['promedio'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estadísticas Generales del Sistema</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="estadisticas_generales_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <h2>Estadísticas Generales del Sistema</h2>

    <h3>Usuarios Registrados:</h3>
    <ul>
        <?php while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) { ?>
            <li>Nombre: <?php echo $fila['nombre']; ?>, Email: <?php echo $fila['email']; ?>, Otros datos: <?php echo $fila['otros_datos']; ?></li>
        <?php } ?>
    </ul>

    <h3>Gimnasios Registrados:</h3>
    <ul>
        <?php while ($fila = mysqli_fetch_assoc($resultadoGimnasios)) { ?>
            <li>Nombre del Gimnasio: <?php echo $fila['nombregym']; ?>, Otra información del gimnasio: <?php echo $fila['otra_informacion']; ?></li>
        <?php } ?>
    </ul>

    <h3>Valoración Promedio de los Gimnasios:</h3>
    <ul>
        <?php while ($fila = mysqli_fetch_assoc($resultadoValoracionPromedio)) { ?>
            <li>Nombre del Gimnasio: <?php echo $fila['nombregym']; ?>, Valoración Promedio: <?php echo $fila['promedio']; ?></li>
        <?php } ?>
    </ul>

    <h3>Precio Mensual Promedio de los Gimnasios: $<?php echo number_format($precioMensualPromedio, 2, '.', ''); ?></h3>

    <!-- Agrega más estadísticas generales aquí -->

    <a href="administracion_sistema.php">Volver a la página de administración del sistema</a>
</body>
</html>
