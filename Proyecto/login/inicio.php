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
$gym = $_SESSION['gym'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="iniciostyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>GymNexus</h1>
    <h2>Bienvenido, <?php echo $user; ?>!</h2>

    <form method="POST" action="inicio_a_admin.php">
        <input type="submit" value="Administrar perfíl" />
    </form>

    <form method="POST" action="logout.php">
        <input type="submit" value="Cerrar sesión" />
    </form>

    <h3>Filtros:</h3>
    <form method="POST" action="" class="filters">
        <label for="precio_mensual_min">Precio mensual: </label>
        <input type="number" name="precio_mensual_min" id="precio_mensual_min" placeholder="Mínimo">
        <input type="number" name="precio_mensual_max" id="precio_mensual_max" placeholder="Máximo">
        <br>
        <label for="precio_diario_min">Precio diario: </label>
        <input type="number" name="precio_diario_min" id="precio_diario_min" placeholder="Mínimo">
        <input type="number" name="precio_diario_max" id="precio_diario_max" placeholder="Máximo">
        <br>
        <label for="orden">Ordenar por Valoración:</label>
        <select name="orden" id="orden">
            <option value="asc">De menor a mayor valoración</option>
            <option value="desc">De mayor a menor valoración</option>
        </select>
        <br>
        <label for="nombre">Buscar por Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del gimnasio">
        <br>
        <label for="descripcion">Horario:</label>
        <input type="text" name="horario" id="horario" placeholder="Horario del gimnasio">
        <br>
        <label for="direccion">Ubicación:</label>
        <input type="text" name="direccion" id="direccion" placeholder="Ubicación del gimnasio">
        <br>
        <label for="servicios">Servicios:</label>
        <input type="text" name="servicios" id="servicios" placeholder="Servicios del gimnasio">
        <br>
        <label for="equipamiento">Equipamiento:</label>
        <input type="text" name="equipamiento" id="equipamiento" placeholder="Equipamiento del gimnasio">
        <br>
        <input type="submit" value="Filtrar">
    </form>

    <h3>Gimnasios:</h3>
    <?php

    $sql = "SELECT * FROM gimnasio WHERE 1"; // Comenzamos con una consulta base
    
    // Aplicar filtros si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $precio_mensual_min = $_POST["precio_mensual_min"];
        $precio_mensual_max = $_POST["precio_mensual_max"];
        $precio_diario_min = $_POST["precio_diario_min"];
        $precio_diario_max = $_POST["precio_diario_max"];
        $orden = $_POST["orden"];
        $nombre = $_POST["nombre"];
        $horario = $_POST["horario"];
        $direccion = $_POST["direccion"];
        $servicios = $_POST["servicios"];
        $equipamiento = $_POST["equipamiento"];

        if (!empty($precio_mensual_min)) {
            $sql .= " AND mensualidad >= $precio_mensual_min";
        }
        if (!empty($precio_mensual_max)) {
            $sql .= " AND mensualidad <= $precio_mensual_max";
        }
        if (!empty($precio_diario_min)) {
            $sql .= " AND dia >= $precio_diario_min";
        }
        if (!empty($precio_diario_max)) {
            $sql .= " AND dia <= $precio_diario_max";
        }
        if (!empty($nombre)) {
            $sql .= " AND nombregym LIKE '%$nombre%'";
        }
        if (!empty($horario)) {
            $sql .= " AND horario LIKE '%$horario%'";
        }
        if (!empty($direccion)) {
            $sql .= " AND direccion LIKE '%$direccion%'";
        }
        if (!empty($servicios)) {
            $sql .= " AND servicios LIKE '%$servicios%'";
        }
        if (!empty($equipamiento)) {
            $sql .= " AND equipamiento LIKE '%$equipamiento%'";
        }

        if ($orden == "asc") {
            $sql .= " ORDER BY valoracion ASC";
        } elseif ($orden == "desc") {
            $sql .= " ORDER BY valoracion DESC";
        }
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los gimnasios en una tabla
        echo "<div 'gyms'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<img src='". $row["foto"] . "' alt='Sin foto de perfíl'>";
            echo "<br>";
            echo "<a>" . $row["nombregym"] . "</a>";
            echo "<br>";
            echo "<a>" . $row["direccion"] . "</a>";
            echo "<form method='POST' action='inicio_a_perfil.php'>";
            echo "<input type='hidden' name='nombregym' value='" . $row["nombregym"] . "'>";
            echo "<input type='submit' value='Ver más' />";
            echo "</form>";
            echo "</div>";
            echo "<br><br>";
        }
        

        echo "</div>";
    } else {
        echo "No se encontraron gimnasios disponibles.";
    }
    ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
