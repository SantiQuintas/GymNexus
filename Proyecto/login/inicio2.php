<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "gym_nexus");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>GymNexus | Inicio</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="inicio2_css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<style>
    .gym-container .col-lg-4 {
    margin: 0 0 20px 0; /* Espacio inferior entre los elementos */
    flex-basis: calc(33.33% - 40px); /* Ancho del 33.33% y resta 40px de espaciado entre ellos */
    box-sizing: border-box; /*  Para incluir el margen en el cálculo del ancho */
}
</style>

<body style="font-family: 'Poppins', sans-serif;">

<nav class="navbar navbar-expand-lg navbar-dark" style=" background-color: rgba(0, 0, 0) !important;">
    <a class="navbar-brand" href="indes.php"><img src="logo.png" style="height: 46px; width: 70px;" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="inicio2.php">Inicio</a>
            </li>
        </ul>
        <div class="dropdown ml-auto">
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo '<button class="btn btn-secondary dropdown-toggle" style="background-color: transparent; border: 2px solid whitesmoke; box-shadow: none; outline: none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cuenta</button>';
                echo '<div class="dropdown-menu dropdown-menu-right" style="background-color: rgba(0, 0, 0); border: 2px solid white;" aria-labelledby="dropdownMenuButton">';
                echo '<a class="dropdown-item" href="#"><form method="POST" action="inicio_a_admin.php"><input type="submit" class="btc" value="Administrar perfil" /></form></a>';
                echo '<a class="dropdown-item" href="#"><form method="POST" action="logout.php"><input type="submit" class="btc2" value="Cerrar sesión" /></form></a>';
                echo '</div>';
            } else {
                echo '<a class="btn btn-secondary" href="login.html" style="background-color: transparent; border: 2px solid whitesmoke; box-shadow: none; outline: none;">Iniciar Sesión</a>';
            }
            ?>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row" style="width: 100%;">
        <div class="col-lg-3">
            <form method="POST" action="" class="filters">
            <h1>Filtros:</h1>
        <label for="precio_mensual_min">Precio mensual: </label>
        <input type="number" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="precio_mensual_min" id="precio_mensual_min" placeholder="Mínimo">
        <br>
        <input type="number" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;"  name="precio_mensual_max" id="precio_mensual_max" placeholder="Máximo">
        <br>
        <label for="precio_diario_min">Precio diario: </label>
        <input type="number" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;"  name="precio_diario_min" id="precio_diario_min" placeholder="Mínimo">
        <br>
        <input type="number" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;"  name="precio_diario_max" id="precio_diario_max" placeholder="Máximo">
        <br>
        <label for="orden">Ordenar por Valoración:</label>
        <select style="width: 88%; color:gray; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="orden" id="orden">
            <option style="width: 88%; color:gray; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" value="asc">De menor a mayor valoración</option>
            <option value="desc">De mayor a menor valoración</option>
        </select>
        <br>
        <label for="nombre">Buscar por Nombre:</label>
        <input type="text" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="nombre" id="nombre" placeholder="Nombre del gimnasio">
        <br>
        <label for="descripcion">Horario:</label>
        <input type="text" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="horario" id="horario" placeholder="Horario del gimnasio">
        <br>
        <label for="direccion">Ubicación:</label>
        <input type="text" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="direccion" id="direccion" placeholder="Ubicación del gimnasio">
        <br>
        <label for="servicios">Servicios:</label>
        <input type="text" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="servicios" id="servicios" placeholder="Servicios del gimnasio">
        <br>
        <label for="equipamiento">Equipamiento:</label>
        <input type="text" style="color: white; background-color:transparent; outline:none; border: 1px solid white; margin-bottom:2px; border-radius:4px;" name="equipamiento" id="equipamiento" placeholder="Equipamiento del gimnasio">
        <br>
        <div style="text-align:center;">
        <input type="submit" class="bf" value="Filtrar">
        </div>
    </form>
        </div>
        <div class="col-lg-9">
            <div class="row gym-container" style="width:120%; flex-wrap: wrap; padding-top: 50px; padding-left: 40px;">

                <?php
                $sql = "SELECT * FROM gimnasio WHERE 1";

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
                    while ($row = $result->fetch_assoc()) {
                        if (strlen($row['direccion']) == 0) {
                            $row['direccion'] = "Dirección desconocida";
                        }

                        echo "<div class='col-lg-4' style='margin: 0 20px 30px 20px; border: 2px solid white; border-radius: 24px 0 24px 0; background-color: rgba(0, 0, 0, 0.520); color:white; text-align:center; padding: 10px 0px 10px 0px;'>";
                        echo "<img class='gympp' src='" . $row["foto"] . "' alt='Sin foto de perfil' onerror='this.src=\"default.png\"' style='max-width: 125px; max-height: 125px;'>";
                        echo "<br>";
                        echo "<br>";
                        echo "<a>" . $row["nombregym"] . "</a>";
                        echo "<br>";
                        echo "<a>" . $row['direccion'] . "</a>";
                        echo "<form method='POST' action='inicio_a_perfil.php'>";
                        echo "<input type='hidden' name='nombregym' value='" . $row["nombregym"] . "'>";
                        echo "<input type='submit' class='bvm' value='Ver más' />";
                        echo "</form>";
                        echo "</div>";
                        echo "<br><br>";
                    }
                } else {
                    echo "No se encontraron gimnasios disponibles.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<br><br><br>

<footer>
        <div class="row" style="height:100%;">

    <div class="col-lg-2" style="margin-left:30px; padding-top:20px; font-size:small;">
        <ul>
            <li>
                <h6 style="margin-bottom:20px;">Acerca de</h6>
            </li>
            <li>
            <a class="links"  href="quienes_somos.php"><p>¿Quienes Somos?</p></a>
            </li>
            <li>
                <a class="links" href="term_cond.php"><p>Términos y Condiciones</p></a>
            </li>
            <li>
                <a class="links" href=""><p>Contacto</p></a>
            </li>  
            <li>
                <p id="copy">GymNexus © 2023</p>
            </li>   
        </ul>
    </div>

    <div class="col" style="margin-left:30px; padding-top:20px; font-size:small;">
    <ul>
            <li>
                <h6 style="margin-bottom:20px;">Acerca de</h6>
            </li>
            <li>
            <a class="links" href=""><p>¿Quienes Somos?</p></a>
            </li>
            <li>
                <a class="links" href="term_cond.php"><p>Términos y Condiciones</p></a>
            </li>
            <li>
                <a class="links" href=""><p>Contacto</p></a>
            </li>  
            <li>
                <p id="copy">GymNexus © 2023</p>
            </li>   
        </ul>  
    </div>

    <div class="col" style="padding-top:10px;">
        <div class="row">
            <h5>Seguinos</h5>
        </div>
        <div class="row">

            <div class="col-lg-1">
                <span><a class="soc-link" id="ig" href="https://www.instagram.com/facu_uthurraltt/"><ion-icon name="logo-instagram"></ion-icon></a></span>
            </div>
                <div class="col-lg-1">
                <span><a class="soc-link" id="fb" href="https://www.facebook.com/tarogarcia"><ion-icon name="logo-facebook"></ion-icon></a></span>
            </div>
            <div class="col-lg-1">
                <span><a class="soc-link" id="in" href="https://www.linkedin.com/in/facundo-uthurralt/"><ion-icon name="logo-linkedin"></ion-icon></a></span>
            </div>
    
        </div>

    </div> 
</div>

   
    </footer>


<script type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>

