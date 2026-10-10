<?php
$conexion = mysqli_connect("localhost","root","","gym_nexus");
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
$nombregym = $_SESSION['nombregym'];

// Verificar si el usuario ya valoró este gimnasio
$consultaUsuarioValoracion = "SELECT * FROM puntuaciones WHERE nombregym = '$nombregym' AND usuario = '$user'";
$resultadoUsuarioValoracion = mysqli_query($conexion, $consultaUsuarioValoracion);
$usuarioYaValorado = mysqli_num_rows($resultadoUsuarioValoracion) > 0;

// Verificar si el usuario ya indicó que va al gimnasio
$consultaUsuarioVaAlGimnasio = "SELECT * FROM usuarios_gimnasios WHERE nombregym = '$nombregym' AND usuario = '$user'";
$resultadoUsuarioVaAlGimnasio = mysqli_query($conexion, $consultaUsuarioVaAlGimnasio);
$usuarioVaAlGimnasio = mysqli_num_rows($resultadoUsuarioVaAlGimnasio) > 0;

// Manejo de comentarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    $comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);
    $fecha = date("Y-m-d H:i:s");
    $insertarComentario = "INSERT INTO comentarios (nombregym, usuario, comentario, fecha) VALUES ('$nombregym', '$user', '$comentario', '$fecha')";
    mysqli_query($conexion, $insertarComentario);
    
    // Redirigir después de agregar un comentario
    header("Location: perfil.php");
    exit();
}

// Manejo de puntuación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['puntuacion']) && !$usuarioYaValorado) {
    $puntuacion = intval($_POST['puntuacion']);
    if ($puntuacion >= 1 && $puntuacion <= 5) {
        // Insertar la nueva puntuación en la tabla de puntuaciones
$insertarPuntuacion = "INSERT INTO puntuaciones (nombregym, usuario, puntuacion) VALUES ('$nombregym', '$user', $puntuacion)";
mysqli_query($conexion, $insertarPuntuacion);

// Actualizar la valoración en la tabla de gimnasios
$consultaPromedio = "SELECT AVG(puntuacion) AS promedio FROM puntuaciones WHERE nombregym = '$nombregym'";
$resultadoPromedio = mysqli_query($conexion, $consultaPromedio);
$filaPromedio = mysqli_fetch_assoc($resultadoPromedio);
$promedio = $filaPromedio['promedio'];

$actualizarGimnasio = "UPDATE gimnasio SET valoracion = '$promedio' WHERE nombregym = '$nombregym'";
mysqli_query($conexion, $actualizarGimnasio);


        // Calcular el nuevo promedio de valoración
        $consultaPromedio = "SELECT AVG(puntuacion) AS promedio FROM puntuaciones WHERE nombregym = '$nombregym'";
        $resultadoPromedio = mysqli_query($conexion, $consultaPromedio);
        $filaPromedio = mysqli_fetch_assoc($resultadoPromedio);
        $promedio = $filaPromedio['promedio'];

        // Redirigir después de puntuar
header("Location: perfil.php");
exit();
    }
}

// Manejo de indicación de asistencia al gimnasio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['va_al_gimnasio']) && !$usuarioVaAlGimnasio) {
    // Insertar la indicación de asistencia en la tabla usuarios_gimnasios
    $insertarAsistencia = "INSERT INTO usuarios_gimnasios (nombregym, usuario) VALUES ('$nombregym', '$user')";
    mysqli_query($conexion, $insertarAsistencia);

    // Redirigir después de indicar asistencia
    header("Location: perfil.php");
    exit();
}

$cn = "SELECT * FROM gimnasio where nombregym= '" . $nombregym . "'";
$ce = mysqli_query($conexion, $cn);
$b = mysqli_fetch_array($ce);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="prfilcss.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

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

<div class="row">


<div class="col-lg-3">

    <div class="divfp" style=" font-family: 'Poppins', sans-serif;">
        <div class="divfpjr" style=" font-family: 'Poppins', sans-serif;">
    <img class="fpg" src="<?php echo $b['foto']; ?>" alt="Error al cargar la foto de perfil." onerror="this.onerror=null;this.src='default.png';">
    <h1><?php echo $b['nombregym']; ?></h1>
    <h5><p>Valoración: <?php echo $b['valoracion']; ?></p></h5>
    </div></div>

    <div class="datosgym">
<!-- Formulario para puntuar (solo se muestra si el usuario no ha valorado) -->
<?php if (!$usuarioYaValorado) { ?>
    <form method="POST" action="">
        <label for="puntuacion">Puntuar Gimnasio:</label>
        <select class="selectpunt" name="puntuacion" id="puntuacion">
            <option value="1">★☆☆☆☆</option>
            <option value="2">★★☆☆☆</option>
            <option value="3">★★★☆☆</option>
            <option value="4">★★★★☆</option>
            <option value="5">★★★★★</option>
        </select>
        <input class="bpunt" type="submit" value="Puntuar">
    </form>
    <?php } else { ?>
    <p>Ya has valorado este gimnasio.</p>
    <?php } ?>

    <!-- Formulario para indicar asistencia al gimnasio (solo se muestra si el usuario no ha indicado asistencia) -->
    <?php if (!$usuarioVaAlGimnasio) { ?>
    <form style="text-align:center;" method="POST" action="">
        <input type="hidden" name="va_al_gimnasio" value="1">
        <input class="botonasistencia" type="submit" value="Voy a este gimnasio">
    </form>
    <?php } else { ?>
    <p>Ya has indicado que vas a este gimnasio.</p>
    <?php } ?>

    <p>Precios: <br> Mensual $<?php echo $b['mensualidad']; ?> <br> Diario: $<?php echo $b['dia']; ?></p>
    <p>Horarios: <?php echo $b['horario']; ?></p>
    <p>Teléfono: <?php echo $b['telefono']; ?></p>
    <p>Dirección: <?php echo $b['direccion']; ?></p><a class="verubicacion" href='<?php echo $b['maps']; ?>' target="_blank">Ver ubicación en Bing Maps</a>
    

    </div>


</div>
    <div class="col-lg-9">

    <div class="divdesc">

    <div class="row">
        <div class="col">
    <p>Descripción:</p>
    <p style="text-align: justify !important;"><?php echo $b['descripcion']; ?></p>
    </div>
    <div class="col">
    <p>Equipamiento:</p>
    <p  style="text-align: justify !important;"><?php echo $b['equipamiento']; ?></p>
    </div>
    <div class="col">
    <p>Servicios:</p>
    <p style="text-align: justify !important;"><?php echo $b['servicios']; ?></p>
    </div></div>
    </div>
    


    <div class="fotos">

    <div id="carouselExampleControls" class="carousel slide" style="border-radius: 40px;" data-ride="carousel">
    <div style="border-radius: 6px;"  class="carousel-inner">

    <?php if (!empty($b['foto1'])) { ?>
    <div class="carousel-item active">
    <img style="height: 500px;" class="d-block w-100" src="<?php echo $b['foto1']; ?>" alt="La foto no ha sido cargada">
    <?php } ?>
    </div>

    <?php if (!empty($b['foto2'])) { ?>
    <div class="carousel-item">
    <img style="height: 500px;" class="d-block w-100" src="<?php echo $b['foto2']; ?> " alt="La foto no ha sido cargada">
<?php } ?>
    </div>

    <?php if (!empty($b['foto3'])) { ?>
    <div class="carousel-item">
    <img style="height: 500px;"  class="d-block w-100" src="<?php echo $b['foto3']; ?>" alt="La foto no ha sido cargada">
<?php } ?>
    </div>

    <?php if (!empty($b['foto4'])) { ?>
    <div class="carousel-item">
<img style="height: 500px;"  class="d-block w-100" src="<?php echo $b['foto4']; ?>" alt="La foto no ha sido cargada">
<?php } ?>
    </div>

    <?php if (!empty($b['foto5'])) { ?>
    <div class="carousel-item">
<img style="height: 500px;"  class="d-block w-100" src="<?php echo $b['foto5']; ?>" alt="La foto no ha sido cargada">
<?php } ?>
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



</div></div>
    
    <!-- Formulario de Comentarios -->

    <div class="com">
    <h2>Comentarios</h2>
    <form method="POST" action="">
        <textarea name="comentario" cols="50" rows="3" placeholder="Escribe tu comentario aquí..." required></textarea>
        <input type="submit" class="bcom" value="Publicar Comentario">
    </form>
    
        <div class="comjr">
    <!-- Mostrar Comentarios -->
    <div>
        <?php
        $consultaComentarios = "SELECT * FROM comentarios WHERE nombregym = '$nombregym' ORDER BY fecha DESC";
        $resultados = mysqli_query($conexion, $consultaComentarios);

        while ($comentario = mysqli_fetch_assoc($resultados)) {
            echo "<p><strong>{$comentario['usuario']}</strong> ({$comentario['fecha']}): {$comentario['comentario']}</p>";
        }
        ?>
        </div>
    </div>

    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
