<?php
include 'admin/php/conexion.php';

$codAuto=$_GET['codAuto'];

//echo $codAuto;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Listado vehículos</title>
	<link rel="stylesheet" type="text/css" href="css/cintaFotos.css">
	
</head>
<body>

<div class="encabezado">
<img class="icoPrincipal" src="img/LOGOUSPG.jpg">
<h2 class="textoPrincipal">LENIN CAR GALERÍA</h2>
</div>
<div class="lateralIzquierdo">
<?php
$codAuto=$_GET['codAuto'];
//echo $codAuto;
$instruccion="SELECT * FROM fotos_autos WHERE id_vehiculo='$codAuto'";

$resultado=mysqli_query($conexion,$instruccion);
$resultadob=mysqli_query($conexion,$instruccion);

/*echo"<div><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='flechas w-6 h-6'>
<path stroke-linecap='round' stroke-linejoin='round' d='M15.75 19.5L8.25 12l7.5-7.5' />
</svg>
</div>";*/
echo "<div>";
while($r=mysqli_fetch_assoc($resultado)){
	$correlativo=$r['correlativo'];
	$ubicacion=$r['ubicacion'];
    echo"<img onclick='ampliarImagen($correlativo)' class='imagenCinta' src='admin/$ubicacion' alt=''>";
  }

echo "</div>";
echo "<div>";

while($b=mysqli_fetch_assoc($resultadob)){
	$correlativo=$b['correlativo'];
	$ubicacion=$b['ubicacion'];
    echo "<img id='f$correlativo' class='fotoGrande' src='admin/$ubicacion' alt=''>";	
  }
	
echo "</div>";
  
 
 /* echo"<div><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='flechas w-6 h-6'>
<path stroke-linecap='round' stroke-linejoin='round' d='M8.25 4.5l7.5 7.5-7.5 7.5' />
</svg>
</div>";*/
?>
</div>

<div class="">
<?php
$codAuto=$_GET['codAuto'];
$instruccion2="SELECT * FROM vehiculos 
	LEFT JOIN marcas ON vehiculos.marca = marcas.id_marcar 
	LEFT JOIN colores ON vehiculos.color = colores.id_color
    WHERE correlativo='$codAuto'";
$resultado2=mysqli_query($conexion,$instruccion2);
while($r2=mysqli_fetch_assoc($resultado2)){
    $marca=$r2['marca'];
    $linea=$r2['linea'];
    $tipo=$r2['tipo'];
    $transmision=$r2['transmision'];
    $modelo=$r2['modelo'];
    $km=$r2['km'];
    $traccion=$r2['traccion'];
    $combustible=$r2['combustible'];
    $color=$r2['color'];
    $precio=$r2['precio'];
    $minCredito=$r2['aniosMinimoCredito'];
    $mensualidad=$r2['mensualidadAprox'];
    $puertas=$r2['cantidad_puertas'];
}
echo"<div>
<p class='box lateralDerecho'>MARCA</p>
<p class='obtenidos lateralDerecho'>".$marca."</p>
<p class='box lateralDerecho'>LÍNEA</p>
<p class='obtenidos lateralDerecho'>".$linea."</p>
<p class='box lateralDerecho'>TIPO</p>
<p class='obtenidos lateralDerecho'>".$tipo."</p>
<p class='box lateralDerecho'>TRANSMISIÓN</p>
<p class='obtenidos lateralDerecho'>".$transmision."</p>
<p class='box lateralDerecho'>MODELO</p>
<p class='obtenidos lateralDerecho'>".$modelo."</p>
<p class='box lateralDerecho'>KILOMETRAJE</p>
<p class='obtenidos lateralDerecho'>".$km."</p>
<p class='box lateralDerecho'>TRACCIÓN</p>
<p class='obtenidos lateralDerecho'>".$traccion."</p>
<p class='box lateralDerecho'>COMBUSTIBLE</p>
<p class='obtenidos lateralDerecho'>".$combustible."</p>
<p class='box lateralDerecho'>COLOR</p>
<p class='obtenidos lateralDerecho'>".$color."</p>
<p class='box lateralDerecho'>PRECIO</p>
<p class='obtenidos lateralDerecho'>".$precio."</p>
</div>";
?>
</div>
	<script>
        function ampliarImagen(foto){
            //afectando una clase
            var loteFotos=document.getElementsByClassName("fotoGrande");
            for (let index = 0; index < loteFotos.length; index++) {
                loteFotos[index].style.display="none";  
            }
            //afectando un Id
            document.getElementById("f"+foto).style.display="block";
            
        }
    </script>
</head>
<body>

