<?php
   include('estableceComunicacion.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conexion,"SELECT usuario from colaboradores where usuario = '$user_check'");
   
   $row = mysqli_fetch_assoc($ses_sql);
   
   $login_session = $row['usuario'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>