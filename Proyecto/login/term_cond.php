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


    <h3 style="color:whitesmoke; padding-left:75px; margin-top:40px;">Términos y Condiciones</h3>
    <p style="color:whitesmoke; padding-left:80px; padding-right:80px; text-align: justify;"><br>Última actualización: [02/11/2023]
<br><br>
Lea atentamente los siguientes Términos y Condiciones de Uso antes de utilizar nuestro servicio.
<br>
    Aceptación de los Términos y Condiciones
    Al acceder y utilizar nuestro sitio web y servicio, usted acepta estar legalmente obligado por los términos y condiciones establecidos en este documento. Si no está de acuerdo con estos términos, por favor, no utilice nuestro servicio.
    <br><br>
    Uso del Servicio 
    <br>
    a. Nuestro servicio permite a los usuarios buscar gimnasios en su área, aplicar filtros para refinar los resultados y acceder a información detallada sobre los gimnasios.
    <br>
    b. Los usuarios pueden dejar valoraciones y comentarios sobre los gimnasios. Al hacerlo, usted se compromete a proporcionar información precisa y respetuosa.
    <br>
    c. Nos reservamos el derecho de modificar, suspender o descontinuar cualquier parte del servicio en cualquier momento.
    <br>
    <br>
    Registro de Usuario
    <br>
    a. Al registrarse en nuestro servicio, usted acepta proporcionar información precisa y actualizada.
    <br>
    b. Es responsabilidad del usuario mantener la confidencialidad de su información de inicio de sesión.
    <br>
    c. Usted es el único responsable de todas las actividades realizadas en su cuenta.
    <br>
    <br>
    Valoraciones y Comentarios
    <br>
    a. Las valoraciones y comentarios proporcionados por los usuarios deben ser honestos, respetuosos y basados en experiencias personales.
    <br>
    b. Nos reservamos el derecho de moderar y eliminar contenido que no cumpla con nuestros estándares de calidad y respeto.
    <br>
    <br>
    Privacidad
    <br>
    a. La recopilación y el uso de datos personales están sujetos a nuestra Política de Privacidad.
    <br> b. Al utilizar nuestro servicio, usted acepta la recopilación y el uso de sus datos de acuerdo con nuestra Política de Privacidad.
    <br><br>
    Propiedad Intelectual
    <br>
    a. Todo el contenido del sitio web, incluyendo texto, gráficos, logotipos, imágenes y software, está protegido por derechos de autor y otros derechos de propiedad intelectual.
    <br>b. No está permitido copiar, reproducir, distribuir o utilizar de ninguna manera el contenido sin autorización.
    <br><br>
    Limitación de Responsabilidad<br>
    a. No garantizamos la exactitud ni la disponibilidad continua del servicio.
    <br> b. No somos responsables de cualquier daño directo, indirecto o consecuente resultante del uso del servicio.
    <br><br>
    Cambios en los Términos y Condiciones
    <br>Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento. Se le notificará de cualquier cambio significativo.
    <br>
    Si tiene preguntas o inquietudes sobre estos Términos y Condiciones, póngase en contacto con nosotros a través de gymnexus@outlook.com.
    <br>
Al utilizar nuestro servicio, usted acepta estos Términos y Condiciones de Uso. Le recomendamos revisarlos periódicamente.
<br><br>
Gracias por utilizar nuestro servicio.
<br><br>
GymNexus.
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