<?php
$conexion = mysqli_connect("localhost", "root", "", "gym_nexus");
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];

$cn = "SELECT * FROM usuario where user= '" . $_SESSION['user'] . "'";
$ce = mysqli_query($conexion, $cn);
$a = mysqli_fetch_array($ce);
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <title>Administrar cuenta</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="administracionstyles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

</head> 

<body style="font-family: 'Poppins', sans-serif;">
    <nav class="navbar navbar-expand-lg navbar-dark" style=" background-color: rgba(0, 0, 0) !important;">
        <a class="navbar-brand" href="indes.php"><img src="logo.png" style="height: 46px; width: 70px;" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="inicio2.php">Inicio</a>
            </li>
                
            </ul>
            <div class="dropdown ml-auto">
                <button class="btn btn-secondary dropdown-toggle" style="background-color: transparent; border: 2px solid whitesmoke; box-shadow: none; outline: none;"
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cuenta
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="background-color: rgba(0, 0, 0); border: 2px solid white;"
                    aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                        <form method="POST" action="inicio_a_admin.php">
                            <input type="submit" class="btc" value="Administrar perfíl" />
                        </form>
                    </a>

                    <a class="dropdown-item" href="#">
                        <form method="POST" action="logout.php">
                            <input type="submit" class="btc2" value="Cerrar sesión" />
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <form action="modificar_usuario.php" method="POST">
    <div class="row">
        <div class="col-lg-3" style="text-align: center;">
            <div class="perfil" style=" height: 240px; padding: 20px 20px 0 20px">
                <img class="fp" src="<?php echo $a['foto']; ?>" alt="Error al cargar la foto de perfil."
                    onerror="this.onerror=null;this.src='default.png';">
                <label for="username">Foto de perfil (Insertar URL)</label>
                <input type="text" placeholder="URL" id="username" name="foto" value="<?php echo $a['foto']; ?>">

            </div>

        </div>
        <div class="col-lg-9">
           
                <div class="divg">


                <style>
                    label {
                        padding-left: 10px;
                    }
                </style>

                <label for="username">Nombre de Usuario (No puede ser cambiado)</label>
                <input type="text" placeholder="Nombre de usuario" id="username" name="user"
                    value="<?php echo $a['user']; ?>" disabled>

                <div class="row">
                    <div class="col" style="width: 100%;">
                        <label for="username">Nombre</label>
                        <input type="text" placeholder="Nombre" id="username" name="nombre"
                            value="<?php echo $a['nombre']; ?>" required>
                    </div>
                    <div class="col" style="width: 100%;">
                        <label for="username">Apellido</label>
                        <input type="text" placeholder="Apellido" id="username" name="apellido"
                            value="<?php echo $a['apellido']; ?>" required>
                    </div>
                </div>

                <label for="username">Email</label>
                <input type="text" placeholder="Email" id="username" name="email" value="<?php echo $a['email']; ?>"
                    required>

                <label for="username">Telefono (opcional)</label>
                <input type="text" placeholder="Telefono" id="username" name="telefono"
                    value="<?php echo $a['telefono']; ?>">

                <div class="row">
                    <div class="col" style="width:50%;">

                        <label for="password">Contraseña</label>
                        <input type="password" placeholder="Contraseña" id="contraeseña" name="contra"
                            value="<?php echo $a['contra']; ?>" required>
                    </div>
                    <div class="col">
                        <label for="password">Confirmar contraseña</label>
                        <input type="password" placeholder="Confirmar contraseña" id="contraeseña" name="ccontra"
                            value="<?php echo $a['contra']; ?>" required>
                    </div>
                </div>
                <div style="text-align:center; margin-top:20px; margin-bottom:10px;">
                    <button id="but" style="border-radius: 10px 10px 0 0;">Confirmar cambios</button>
                    <br>
            </form>
            <form action="eliminar_usuario.php" method="POST"  onsubmit="return confirm('¿Está seguro de que desea eliminar su cuenta?');">
                        <button id="but2" style="border-radius: 0 0 10px 10px; margin-top:10px; border: 2px solid;">Eliminar cuenta</button>
                    </form>
                    </div>
                    </div>
            <br>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>
