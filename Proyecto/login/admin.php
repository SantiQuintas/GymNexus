<?php
$conn = mysqli_connect("localhost","root","","gym_nexus");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
$gym = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estadísticas Generales</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="admin__css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

</head>
<body style="color:white; font-family: 'Poppins', sans-serif;">
    <h2>Estadísticas Generales del Sistema y Panel de Control</h2>

    <h3>Bienvenido, <?php echo $user; ?>!</h3>

<br><br><br><br>
    <div class="row">
        <div class="col">
    <!-- Mostrar la cantidad total de gimnasios -->
    <h3>Cantidad Total de Gimnasios:</h3>
    <?php
    $sqlTotalGimnasios = "SELECT COUNT(*) AS total_gimnasios FROM gimnasio";
    $resultTotalGimnasios = $conn->query($sqlTotalGimnasios);

    if ($resultTotalGimnasios->num_rows > 0) {
        $rowTotalGimnasios = $resultTotalGimnasios->fetch_assoc();
        $totalGimnasios = $rowTotalGimnasios['total_gimnasios'];

        echo "<p>Cantidad total de gimnasios: " . $totalGimnasios . "</p>";
    } else {
        echo "No se encontraron gimnasios registrados.";
    }
    ?>
</div>
<div class="col">
    <!-- Mostrar la cantidad total de usuarios -->
    <h3>Cantidad Total de Usuarios:</h3>
    <?php
    $sqlTotalUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuario";
    $resultTotalUsuarios = $conn->query($sqlTotalUsuarios);

    if ($resultTotalUsuarios->num_rows > 0) {
        $rowTotalUsuarios = $resultTotalUsuarios->fetch_assoc();
        $totalUsuarios = $rowTotalUsuarios['total_usuarios'];

        echo "<p>Cantidad total de usuarios: " . $totalUsuarios . "</p>";
    } else {
        echo "No se encontraron usuarios registrados.";
    }
    ?>
</div>
<div class="col">
    <!-- Mostrar el precio promedio mensual de todos los gimnasios -->
<h3>Precio Mensual Promedio de los Gimnasios:</h3>
<?php
$sqlPrecioMensualPromedio = "SELECT AVG(mensualidad) AS precio_promedio FROM gimnasio";
$resultPrecioMensualPromedio = $conn->query($sqlPrecioMensualPromedio);

if ($resultPrecioMensualPromedio->num_rows > 0) {
    $rowPrecioMensualPromedio = $resultPrecioMensualPromedio->fetch_assoc();
    $precioPromedioMensual = number_format($rowPrecioMensualPromedio['precio_promedio'], 2, '.', '');

    echo "<p>El precio mensual promedio de todos los gimnasios es: $" . $precioPromedioMensual . "</p>";
} else {
    echo "No se encontraron datos de precios mensuales en los gimnasios.";
}
?></div>
</div><br><br><br>

    <!-- Mostrar a qué gimnasio/s asiste cada usuario -->
<h3>Gimnasios Asistidos por Usuarios:</h3>
<?php
$sqlGimnasiosAsistidos = "SELECT * FROM usuarios_gimnasios";
$resultGimnasiosAsistidos = $conn->query($sqlGimnasiosAsistidos);

if ($resultGimnasiosAsistidos->num_rows > 0) {
    echo "<table border='1' style='width: 98%;'>
            <tr>
                <th>ID</th>
                <th>Nombre del Gimnasio</th>
                <th>Nombre de Usuario</th>
                <th>Fecha de Indicación</th>
            </tr>";

    while ($row = $resultGimnasiosAsistidos->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombregym"] . "</td>";
        echo "<td>" . $row["usuario"] . "</td>";
        echo "<td>" . $row["fecha_indicacion"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron registros de gimnasios asistidos por usuarios.";
}
?>
<br>
    <!-- Mostrar todos los gimnasios registrados -->
    <h3>Gimnasios Registrados:</h3>
    <?php
    $sqlConsulta = "SELECT * FROM gimnasio";
    $result = $conn->query($sqlConsulta);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='width: 98%;'>
                <tr>
                    <th>Nombre Gym</th>
                    <th>Valoración Promedio</th>
                    <th>Precio Mensual</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            $nombregym = $row["nombregym"];

            // Consulta para obtener la valoración promedio del gimnasio
            $consultaValoracionPromedio = "SELECT AVG(puntuacion) AS promedio FROM puntuaciones WHERE nombregym = '$nombregym'";
            $resultadoValoracionPromedio = mysqli_query($conn, $consultaValoracionPromedio);
            $filaValoracionPromedio = mysqli_fetch_assoc($resultadoValoracionPromedio);
            $valoracionPromedio = $filaValoracionPromedio['promedio'];

            // Consulta para obtener el precio mensual promedio
            $consultaPrecioMensualPromedio = "SELECT AVG(mensualidad) AS promedio FROM gimnasio WHERE nombregym = '$nombregym'";
            $resultadoPrecioMensualPromedio = mysqli_query($conn, $consultaPrecioMensualPromedio);
            $filaPrecioMensualPromedio = mysqli_fetch_assoc($resultadoPrecioMensualPromedio);
            $precioMensualPromedio = $filaPrecioMensualPromedio['promedio'];

            echo "<tr>";
            echo "<td>" . $nombregym . "</td>";
            echo "<td>" . number_format($valoracionPromedio, 2, '.', '') . " / 5</td>";
            echo "<td>$" . number_format($precioMensualPromedio, 2, '.', '') . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron gimnasios registrados.";
    }
    ?>
    <br>

    <!-- Mostrar todos los usuarios registrados -->
    <h3>Usuarios Registrados:</h3>
    <?php
    $sqlConsultaUsuario = "SELECT * FROM usuario";
    $resultUsuario = $conn->query($sqlConsultaUsuario);

    if ($resultUsuario->num_rows > 0) {
        echo "<table border='1' style='width: 98%;'>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acción</th>
                </tr>";

        while ($row = $resultUsuario->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["user"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td><form method='post' action=''>
                    <input type='hidden' name='eliminar_usuario' value='" . $row["id_user"] . "'>
                    <input type='submit' value='Eliminar'>
                </form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron usuarios registrados.";
    }
    ?>
<br>

    <div id="valgympromedio">
    <!-- Mostrar la valoración promedio de todos los gimnasios -->
    <h3>Valoración Promedio de Gimnasios:</h3>
    <?php
    $sqlPromedioValoracion = "SELECT AVG(puntuacion) AS promedio FROM puntuaciones";
    $resultPromedioValoracion = $conn->query($sqlPromedioValoracion);

    if ($resultPromedioValoracion->num_rows > 0) {
        $rowPromedioValoracion = $resultPromedioValoracion->fetch_assoc();
        $promedioValoracion = number_format($rowPromedioValoracion['promedio'], 2, '.', '');

        echo "<p> " . $promedioValoracion . " / 5</p>";
    } else {
        echo "No se encontraron valoraciones.";
    }
    ?></div>
    <br><br><br>

    <div id="eliminargym">
    <!-- Eliminar un gimnasio -->
    <h3>Eliminar Gimnasio:</h3>
    <form method="POST" action="">
        <label for="eliminar_gimnasio">Selecciona un gimnasio para eliminar:</label>
        <select name="eliminar_gimnasio" id="eliminar_gimnasio">
            <?php
            $result = $conn->query($sqlConsulta);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_gym'] . "'>" . $row['nombregym'] . "</option>";
            }
            ?>
        </select>
        <div style="text-align:center;">
        <input type="submit" value="Eliminar Gimnasio">
        </div>
    </form>
    </div>
    <br><br><br>
    <?php
    // Manejar el borrado de gimnasios si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_gimnasio'])) {
        $idEliminarGimnasio = $_POST['eliminar_gimnasio'];
        $sqlEliminarGimnasio = "DELETE FROM gimnasio WHERE id_gym = $idEliminarGimnasio";
        if ($conn->query($sqlEliminarGimnasio) === TRUE) {
            echo "Gimnasio eliminado correctamente.";
        } else {
            echo "Error al eliminar el gimnasio: " . $conn->error;
        }
    }
    ?>

    <!-- Mostrar comentarios y eliminar comentarios -->
<h3>Comentarios en Gimnasios:</h3>
<?php
$sqlComentarios = "SELECT * FROM comentarios";
$resultComentarios = $conn->query($sqlComentarios);

if ($resultComentarios->num_rows > 0) {
    echo "<table border='1' style='width: 98%;'>
            <tr>
                <th>Nombre del Gimnasio</th>
                <th>Usuario</th>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>";

    while ($row = $resultComentarios->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombregym"] . "</td>";
        echo "<td>" . $row["usuario"] . "</td>";
        echo "<td>" . $row["comentario"] . "</td>";
        echo "<td>" . $row["fecha"] . "</td>";
        echo "<td>
            <form method='post' action=''>
                <input type='hidden' name='eliminar_comentario' value='" . $row["id"] . "'>
                <input type='submit' value='Eliminar'>
            </form>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron comentarios en gimnasios.";
}
?>

<?php
// Manejar la eliminación de comentarios si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_comentario'])) {
    $idEliminarComentario = $_POST['eliminar_comentario'];
    $sqlEliminarComentario = "DELETE FROM comentarios WHERE id = $idEliminarComentario";
    if ($conn->query($sqlEliminarComentario) === TRUE) {
        echo "Comentario eliminado correctamente.";
    } else {
        echo "Error al eliminar el comentario: " . $conn->error;
    }
}
?>

<!-- Agrega un botón para exportar a Excel -->
<form method="post" action="exportar_excel.php">
    <input type="submit" name="exportar_excel" value="Exportar a Excel">
</form>


    <form style="margin-bottom: 40px;" method="POST" action="logout.php">
        <input type="submit" value="Cerrar Sesión" />
    </form>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
