<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "gym_nexus");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="qs_css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>GymNexus | ¿Quienes Somos?</title>
</head>
<body>

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


    <h3 style="color:whitesmoke; padding-left:75px; margin-top:40px;">¿Quienes somos?</h3>
    <p style="color:whitesmoke; padding-left:80px; padding-right:80px; text-align: justify;">Somos un grupo de estudiantes del Instituto Juan XXIII que se encuentra
        desarrollando un sistema que le permitirá a todo aquel que deseé adoptar un estilo de
        vida más saludable y relacionado con la actividad física. GymNexus, nuestro proyecto,
        permite que sus usuarios, encuentren el gimnasio que más se adapte a sus
        preferencias, logrando así fomentar virtudes como la disciplina, el esfuerzo, la salud y
        la constancia. ¡No te vayas! Todavía tenemos mucho por contarte...
        </p>


        
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
                <a class="links" href=""><p>Términos y Condiciones</p></a>
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



<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>