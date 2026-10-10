<!DOCTYPE html>
<html lang="es">
<head>

    <title>Recuperar contraseña</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="cambiocontra_cs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  
</head>

<body>


    <div class="divgral">
    <form action="cambiarcontra.php" method="post">
        <label for="">Ingrese la nueva contraseña: </label>
        <input type="password" name="newpass" placeholder="Nueva contraseña">
        <br>
        <label for="">Confirmar nueva contraseña: </label>
        <input type="password" name="cnewpass" placeholder="Confirmar nueva contraseña">
        <br>
        <button type="submit">Confirmar</button>
        <input type="hidden" name="user" value="<?php echo $_GET['user']?>">
    </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>