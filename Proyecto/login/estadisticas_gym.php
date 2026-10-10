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

$nombregym = $_SESSION['nombregym'];

// Consulta para obtener la cantidad de clientes
$consultaClientes = "SELECT COUNT(DISTINCT usuario) AS total_clientes FROM usuarios_gimnasios WHERE nombregym = '$nombregym'";
$resultadoClientes = mysqli_query($conexion, $consultaClientes);
$filaClientes = mysqli_fetch_assoc($resultadoClientes);
$totalClientes = $filaClientes['total_clientes'];

// Consulta para obtener la cantidad de asociados en el último mes
$fechaActual = date("Y-m-d");
$fechaMesPasado = date("Y-m-d", strtotime("-1 month"));
$consultaAsociadosUltimoMes = "SELECT COUNT(DISTINCT usuario) AS nuevos_asociados FROM usuarios_gimnasios WHERE nombregym = '$nombregym' AND fecha_indicacion BETWEEN '$fechaMesPasado' AND '$fechaActual'";
$resultadoAsociados = mysqli_query($conexion, $consultaAsociadosUltimoMes);
$filaAsociados = mysqli_fetch_assoc($resultadoAsociados);
$nuevosAsociados = $filaAsociados['nuevos_asociados'];

// Consulta para calcular los ingresos mensuales
$consultaIngresos = "SELECT 
    (COUNT(DISTINCT ug.usuario) * g.mensualidad) AS ingresos_mensuales
FROM 
    usuarios_gimnasios ug
INNER JOIN 
    gimnasio g ON ug.nombregym = g.nombregym
WHERE 
    ug.nombregym = '$nombregym'";

$resultadoIngresos = mysqli_query($conexion, $consultaIngresos);

if ($resultadoIngresos) {
    $filaIngresos = mysqli_fetch_assoc($resultadoIngresos);
    $ingresosMensuales = $filaIngresos['ingresos_mensuales'];
} else {
    // Manejo de errores, muestra un mensaje o registra el error
    echo "Error en la consulta de ingresos: " . mysqli_error($conexion);
    $ingresosMensuales = 0; // O cualquier otro valor por defecto
}

// Consulta para obtener quiénes valoraron el gimnasio y cuándo
$consultaValoraciones = "SELECT usuario, fecha, puntuacion FROM puntuaciones WHERE nombregym = '$nombregym'";
$resultadoValoraciones = mysqli_query($conexion, $consultaValoraciones);

// Consulta para obtener los comentarios
$consultaComentarios = "SELECT usuario, fecha, comentario FROM comentarios WHERE nombregym = '$nombregym'";
$resultadoComentarios = mysqli_query($conexion, $consultaComentarios);

// Consulta para obtener la valoración promedio del gimnasio
$consultaValoracionPromedio = "SELECT AVG(puntuacion) AS promedio FROM puntuaciones WHERE nombregym = '$nombregym'";
$resultadoValoracionPromedio = mysqli_query($conexion, $consultaValoracionPromedio);
$filaValoracionPromedio = mysqli_fetch_assoc($resultadoValoracionPromedio);
$valoracionPromedio = $filaValoracionPromedio['promedio'];

// Consulta para obtener la cantidad de clientes del mes anterior
$fechaMesAnterior = date("Y-m-d", strtotime("-2 months"));
$consultaClientesMesAnterior = "SELECT COUNT(DISTINCT usuario) AS clientes_mes_anterior FROM usuarios_gimnasios WHERE nombregym = '$nombregym' AND fecha_indicacion BETWEEN '$fechaMesAnterior' AND '$fechaMesPasado'";
$resultadoClientesMesAnterior = mysqli_query($conexion, $consultaClientesMesAnterior);
$filaClientesMesAnterior = mysqli_fetch_assoc($resultadoClientesMesAnterior);
$clientesMesAnterior = $filaClientesMesAnterior['clientes_mes_anterior'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estadísticas del Gimnasio</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="estadisticas_gym_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <h2>Estadísticas del Gimnasio: <?php echo $nombregym; ?></h2>

    <h3>Cantidad de Clientes: <?php echo $totalClientes; ?></h3>
    <h3>Nuevos Asociados en el Último Mes: <?php echo $nuevosAsociados; ?></h3>
    <h3>Crecimiento de Clientes (Mes Anterior al Último Mes): <?php echo $totalClientes - $clientesMesAnterior; ?></h3>
    <h3>Ingresos Mensuales: $<?php echo $ingresosMensuales; ?></h3>

    <h3>Usuarios que Valoraron el Gimnasio:</h3>
    <ul>
        <?php while ($fila = mysqli_fetch_assoc($resultadoValoraciones)) { ?>
            <li><?php echo $fila['usuario']; ?> (<?php echo $fila['puntuacion']; ?>/5) - <?php echo $fila['fecha']; ?></li>
        <?php } ?>
    </ul>

    <h3>Valoración Promedio del Gimnasio: <?php echo number_format($valoracionPromedio, 2, '.', ''); ?> / 5</h3>

    <h3>Comentarios:</h3>
    <ul>
        <?php while ($fila = mysqli_fetch_assoc($resultadoComentarios)) { ?>
            <li><?php echo $fila['usuario']; ?> (<?php echo $fila['fecha']; ?>): <?php echo $fila['comentario']; ?></li>
        <?php } ?>
    </ul>

    <!-- Agrega un botón para exportar a Excel -->
<form method="post" action="exportar_excelgym.php">
    <input type="submit" name="exportar_excel" value="Exportar a Excel">
</form>


    <a href="administraciongym.php">Volver a la página administración del gimnasio</a>
</body>
</html>

