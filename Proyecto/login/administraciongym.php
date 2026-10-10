<?php
$conexion = mysqli_connect("localhost","root","","gym_nexus");
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];

$cn="SELECT * FROM gimnasio where user= '" . $_SESSION['user'] . "'";
$ce = mysqli_query($conexion, $cn);
$a = mysqli_fetch_array($ce);

$_SESSION['nombregym'] = $a['nombregym'];
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
</head>
<body style="font-family: 'Poppins', sans-serif; overflow-x: hidden;">


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

    <style>

        
    
    #but{
        border-radius: 10px 10px 0 0;
        margin-bottom: 10px;
        margin-top:20px;
    }

    #but2{
        border-radius: 0px 0px 10px 10px;
    }

    #butestadistic:hover{
        box-shadow: 0 0 20px rgb(0, 178, 248, 0.2);
        border-color: var(--colorbt);
        text-shadow: 0 0 20px var(--colorbt);
        color: var(--colorbt);
    }

    footer{
        margin-top:60px;
        width: 100%;
        background-color: black !important;
        color: white;
        height: 100px;
    }

    </style>
    <form action="modificar_gym.php" method="POST">
    <div class="row">
    
    <div class="col-lg-3" style="text-align: center;">
    <div class="perfil" style=" height: 240px; padding: 20px 20px 0 20px">
    <img class="fp" src="<?php echo $a['foto']; ?>" alt="Error al cargar la foto de perfil." onerror="this.onerror=null;this.src='default.png';">
    <label for="username">Foto de perfil (insertar URL)</label>
    <input type="text" placeholder="URL" id="username" name="foto" value="<?php echo $a['foto']; ?>">

    </div>

</div>


    <div class="col-lg-9">
        <div class="divg">

        <label for="username">Email</label>
        <input type="text" placeholder="Email" id="username" name="email" value="<?php echo $a['email']; ?>" required>

        <label for="username">Nombre de Usuario (no puede ser cambiado)</label>
        <input type="text" placeholder="Nombre del usuario" id="username" name="user" value="<?php echo $a['user']; ?>" disabled>

        <label for="username">Nombre</label>
        <input type="text" placeholder="Nombre" id="username" name="nombre" value="<?php echo $a['nombre']; ?>" required>
                
        <label for="username">Apellido</label>
        <input type="text" placeholder="Apellido" id="username" name="apellido" value="<?php echo $a['apellido']; ?>" required>

        <label for="username">CUIL</label>
        <input type="text" placeholder="CUIL" id="username" name="cuil" value="<?php echo $a['cuil']; ?>">

        <label for="username">Nombre del Gimnasio</label>
        <input type="text" placeholder="Nombre del gimnasio" id="username" name="nombregym" value="<?php echo $a['nombregym']; ?>" required>

        <label for="username">Descripción (opcional)</label>
        <input type="text" placeholder="Descripción" id="username" name="descripcion" value="<?php echo $a['descripcion']; ?>">

        <label for="username">Servicios ofrecidos</label>
        <input type="text" placeholder="Servicios" id="username" name="servicios" value="<?php echo $a['servicios']; ?>" required>

        <label for="username">Equipamiento disponible</label>
        <input type="text" placeholder="Equipamiento" id="username" name="equipamiento" value="<?php echo $a['equipamiento']; ?>" required>

        <label for="username">Precio de pase libre mensual (opcional)</label>
        <input type="text" placeholder="Mensualidad" id="username" name="mensualidad" value="<?php echo $a['mensualidad']; ?>">

        <label for="username">Precio de pase libre diario (opcional)</label>
        <input type="text" placeholder="Día" id="username" name="dia" value="<?php echo $a['dia']; ?>">

        <label for="username">Horario</label>
        <input type="text" placeholder="Horario" id="username" name="horario" value="<?php echo $a['horario']; ?>">

        <label for="username">Dirección</label>
        <input type="text" placeholder="Dirección" id="username" name="direccion" value="<?php echo $a['direccion']; ?>" required>

        <label for="username">Bing Maps (insertar URL)</label>
        <input type="text" placeholder="URL" id="username" name="maps" value="<?php echo $a['maps']; ?>">
    
        <label for="username">Telefono (opcional)</label>
        <input type="text" placeholder="Telefono" id="username" name="telefono" value="<?php echo $a['telefono']; ?>">

        <label for="password">Contraseña</label>
        <input type="password" placeholder="Contraseña" id="contraeseña" name="contra" value="<?php echo $a['contra']; ?>" required>

        <label for="password">Confirmar contraseña</label>
        <input type="password" placeholder="Confirmar contraseña" id="contraeseña" name="ccontra" value="<?php echo $a['contra']; ?>" required>
        <br>
        <h3 style="margin-top:40px;">Fotos del gimnasio (insertar URL)</h3>
        <label for="username">Foto 1</label>
        <input type="text" placeholder="URL" id="username" name="foto1" value="<?php echo $a['foto1']; ?>">
        <label for="username">Foto 2</label>
        <input type="text" placeholder="URL" id="username" name="foto2" value="<?php echo $a['foto2']; ?>">
        <label for="username">Foto 3</label>
        <input type="text" placeholder="URL" id="username" name="foto3" value="<?php echo $a['foto3']; ?>">
        <label for="username">Foto 4</label>
        <input type="text" placeholder="URL" id="username" name="foto4" value="<?php echo $a['foto4']; ?>">
        <label for="username">Foto 5</label>
        <input type="text" placeholder="URL" id="username" name="foto5" value="<?php echo $a['foto5']; ?>">

        <div style="text-align:center;">
        <button id="but">Confirmar cambios</button>
    </form>
    <br>
    
    <form action="eliminar_gym.php" method="POST"  onsubmit="return confirm('¿Está seguro de que desea eliminar su cuenta?');">
        <button id="but2">Eliminar cuenta</button>
    </form>
    <div class="perfil" style="padding-top:20px;">
    <form action="estadisticas_gym.php" method="POST">
        <button id="butestadistic" style="border-radius:10px;">Ver estadísticas del gimnasio</button>
    </form>
    </div>
    </div>
    </div> </div></div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <footer>
        <div class="row">

    <div class="col">

    </div>

    <div class="col">

    </div>

    <div class="col" style="padding-top:10px;">
        <div class="row">
            <h5>Seguinos</h5>
        </div>
        <div class="row">

            <div class="col">
                <span><a id="ig" style="text-decoration: none; transition: all 0.5s ease;" href="https://www.instagram.com/facu_uthurraltt/"><ion-icon name="logo-instagram"></ion-icon></a></span>
            </div>
                <div class="col">
                <span><a style="text-decoration: none; color:white;" href="https://www.facebook.com/tarogarcia"><ion-icon name="logo-facebook"></ion-icon></a></span>
        </div></div>

    </div> 
</div>

<style>
    #ig:hover{
        text-shadow: 0 0 20px rgb(227, 0, 248);
        color: rgb(227, 0, 248);
    }
</style>
   
    </footer>

</body>
</html>