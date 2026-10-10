 <?php
    $conexion = mysqli_connect("localhost","root","","gym_nexus");

  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    if($_POST['ccontra']==$_POST['contra'])
    {
        if(strlen($_POST['contra'])>=8)
        {
              $cnmail= "SELECT 'email' from gimnasio where email= '" . $_POST['email'] ."'" ;
              $cnuser= "SELECT 'user' from gimnasio where user= '" . $_POST['user'] ."'" ;

              $consul = mysqli_query($conexion, $cnmail); 
              $consul2 = mysqli_query($conexion, $cnuser); 
              
               if (!mysqli_num_rows($consul) && !mysqli_num_rows($consul2)) {
                $cn = "INSERT INTO gimnasio (servicios, horario, nombregym, email, user, nombre, apellido, equipamiento, cuil, contra, direccion, telefono, mensualidad, dia) VALUES ('" . $_POST['servicios'] . "','" . $_POST['horario'] . "','" . $_POST['nombregym'] . "','" . $_POST['email'] . "','" . $_POST['user'] . "','" . $_POST['nombre'] . "','" . $_POST['apellido'] . "','" . $_POST['equipamiento'] . "','" . $_POST['cuil'] . "','" . $_POST['contra'] . "','" . $_POST['direccion'] . "','" . $_POST['telefono'] . "','" . $_POST['mensualidad'] . "','" . $_POST['dia'] . "')";
               $consultas = mysqli_query($conexion, $cn);

               echo '<script type="text/javascript">';
               echo 'alert("Gimnasio registrado correctamente.");';
               echo 'window.location.href = "login.html";';
               echo '</script>';
             }
             else{
              echo '<script type="text/javascript">';
              echo 'alert("La dirección de correo electrónico y/o nombre de usuario ya han sido registrados anteriormente.");';
              echo 'window.location.href = "gymsignup.html";';
              echo '</script>';
             }
         }

       else
       {
         echo '<script type="text/javascript">';
         echo 'alert("La contraseña debe tener más de 8 caracteres.");';
         echo 'window.location.href = "signup.html";';
         echo '</script>';
       }
     }

    else
    {
      echo '<script type="text/javascript">';
      echo 'alert("La contraseña no coincide.");';
      echo 'window.location.href = "signup.html";';
      echo '</script>';
    }
  }
    else{
      echo '<script type="text/javascript">';
      echo 'alert("La dirección de correo electrónico no cumple los requisitos solicitados.");';
      echo 'window.location.href = "signup.html";';
      echo '</script>';
    }
 ?>

 

