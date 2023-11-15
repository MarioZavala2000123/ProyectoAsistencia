<?php
   include("php/estableceComunicacion.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['us_colaborador'];
     $mypassword = $_POST['us_contra']; 
  
    
      $sql = "SELECT IdColaborador FROM colaboradores WHERE usuario = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($conexion,$sql);
  
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
      
         $_SESSION['login_user'] = $myusername;
         header("location: repor.php");
      }
   }
?>



<!DOCTYPE html>
<html>
<head>
	<title>Portal de Instructores</title>
	<link rel="stylesheet" type="text/css" href="css/loginINTECAP.css">
</head>
<body>
<div class="auxLogin">
	<div class="lateralIzquierdo">
		<img class="Logo" src="img/LOGOUSPG.jpg">
	</div>
	<div class="lateralDerecho">
		
		
		<form style="width: 100%" action="" method="POST">
			<svg xmlns="http://www.w3.org/2000/svg" class="iconUser centrar h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
</svg>
				<h2 class="textoPrincipal">Credenciales</h2>
		
			<div class="auxCampos">
				
				<div class="auxDetampos"></div>
				<div class="auxDetampos">
					
			<input class="camposIngreso" type="text" name="us_colaborador" placeholder="Usuario...">

			<input class="camposIngreso" type="password" name="us_contra" placeholder="Contraseña...">
			</div>
			<div class="auxDetampos">
					<button class="camposIngreso btnIniciar"><svg style="width: 50px;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
</svg>
</button>
			</div>
			</div>
			
		
		</form>

	</div>

</div>



</body>
</html>

 

