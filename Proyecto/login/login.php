<?php 
     $conexion = mysqli_connect("localhost","root","","gym_nexus");
     session_start();
     
     
    if (isset($_POST['email']) && isset($_POST['contra']))
     {
      $cn="SELECT * FROM usuario where  email= '" . $_POST['email'] . "' OR user= '" . $_POST['email'] . "'";
      $ce = mysqli_query($conexion, $cn);
      $a = mysqli_fetch_array($ce);
      $_SESSION['gym'] = false;
      $_SESSION['admin'] = false;

      if(strlen($a['user'])==0){  // Posible error acá.
        $cn="SELECT * FROM gimnasio where  email= '" . $_POST['email'] . "' OR user= '" . $_POST['email'] . "'";
        $ce = mysqli_query($conexion, $cn);
        $a = mysqli_fetch_array($ce);
        $_SESSION['gym'] = true;
        $_SESSION['admin'] = false;
      }

      if(strlen($a['user'])==0){
        $cn="SELECT * FROM administradores where  email= '" . $_POST['email'] . "' OR user= '" . $_POST['email'] . "'";
        $ce = mysqli_query($conexion, $cn);
        $a = mysqli_fetch_array($ce);
        $_SESSION['gym'] = false;
        $_SESSION['admin'] = true;
      }
      
       if ($a['email']==$_POST['email'] || $a['user']==$_POST['email'])
       {
        if ($a['contra']==$_POST['contra']){
          $_SESSION['user']=$a['user'];
          $_SESSION['logged_in'] = true;

          if($_SESSION['admin'] == true){
            header('location: admin.php');
            exit();}

          header('location: inicio2.php');
          exit();
        }
        else{
          echo '<script type="text/javascript">'; 
          echo 'alert("Contraseña incorrecta.");';
          echo 'window.location.href = "login.html";';
          echo '</script>';
       }}
       else
       {
        echo '<script type="text/javascript">'; 
        echo 'alert("Dirección de correo electrónico o usuario inexistente.");'; 
        echo 'window.location.href = "login.html";';
        echo '</script>';
       }
     } 
    ?>