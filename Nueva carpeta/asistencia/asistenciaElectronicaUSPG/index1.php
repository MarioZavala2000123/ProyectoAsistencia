<?php
   include("php/estableceComunicacion.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['tecnico'];
     $mypassword = $_POST['seguridad']; 
      
      $sql = "SELECT IdColaborador FROM colaboradores WHERE usuario = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($conexion,$sql);
  
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
      
         $_SESSION['login_user'] = $myusername;
         header("location: repor.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Administración DIGM</title>
	<link rel="stylesheet" type="text/css" href="css/principal.css">
	<meta charset="utf-8">
</head>
<body>
<div class="auxForm">
	
	<div class="latDerecho">
		<img class="logoIco" src="img/LOGOUSPG.jpg">
	</div>
	<div class="latIzquierdo">
		
		<form id="formPrincipal" action="" method="POST">
			<h3 class="textPrincipal">Bienvenido</h3>
			<input class="inPrincipal" placeholder="Usuario.." type="text" name="tecnico">
			<input class="inPrincipal " placeholder="Contraseña.." type="password" name="seguridad">
         <button type="submit" class="inPrincipal btnSubmit"><svg style="width: 50px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
</svg></button>
			
		</form>
		
	</div>
</div>
</body>
</html>