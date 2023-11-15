<?php
include 'admin/php/conexion.php';
$cod=$_GET['codigoCar'] ;
$Instruccion = "SELECT * FROM vehiculos v INNER JOIN marcas m   ON v.marca = m.id_marcar   INNER JOIN colores c ON  v.color = c.id_color
WHERE correlativo=$cod";
$resultado=mysqli_query($conexion,$Instruccion);
while ($r=mysqli_fetch_assoc($resultado)){
  $marca=$r['marca'];
  $linea=$r['linea'];
  $modelo=$r['modelo'];
  $color=$r['color'];
  $precio=$r['precio'];
  $km=$r['km'];
  }

// TABLA DE TIPO 
$InstruccionTipo="SELECT * FROM tipo_vehiculo ";
$resultado=mysqli_query($conexion,$InstruccionTipo);

while ($r=mysqli_fetch_assoc($resultado)){
  $tipo=$r['tipo'];
  $idtipo=$r['id_tipo'];
}

$Instruccion2 = "SELECT * FROM vehiculos v INNER JOIN traccion t   ON v.traccion = t.id_traccion   INNER JOIN transmision n ON  v.transmision = n.id_transmicion
INNER JOIN  combustible b ON  v.combustible = b.id_combustible";
$resultado=mysqli_query($conexion,$Instruccion2);
while ($r=mysqli_fetch_assoc($resultado)){
  $tracc=$r['traccion'];
  $trans=$r['transmision'];
$gas=$r['combustible'];


}








?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/vehiculo.css">

  
  <title>VisualizarAutos</title>
</head>

<style>


/* Encabezado con línea azul */
.encabezado {
  font-size: 45px; /* Establece el tamaño de la fuente del encabezado */
  font-weight: bold; /* Establece la negrita de la fuente */
  border-bottom: 2px solid blue; /* Establece un borde sólido de 2px de ancho y color azul en la parte inferior del encabezado */
  padding-bottom: 10px; /* Agrega un relleno interno en la parte inferior del encabezado para separar el texto de la línea */
  text-align: center;
color: skyblue;



}

.Respuestas{
  color: blue;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;




}


/* Estilos del contenedor */
.contenedor {
  width: 450px; /* Establece el ancho del contenedor en 500 píxeles */
  overflow: hidden; /* Oculta cualquier contenido que se desborde del contenedor */
  margin-left: 40cm
  


}

/* Estilos del borde */
.borde {
  border: 2px solid blue; /* Establece un borde sólido de 1 píxel de ancho y color negro */
  float: left; /* Alinea el borde a la izquierda del contenedor */
  margin-right: 90px; /* Establece un margen derecho de 10 píxeles para separar el borde del texto */
  padding: 10px; /* Agrega un relleno interno de 10 píxeles para separar el contenido del borde */
  color: blue;
  width: 19ch;
  text-align: center;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

}


.img{
  width: 500px;
  height: 300px;
  margin-top: 100px;
  


}

.parteCentral{
  display: grid;
  grid-template-columns: 60% 40%;
}

</style>

<body>
  <div class="encabezado">
  <h1  class="encabezado " style="text-align: center;">Predio Chapin  </h1><br>

  </div>

  <div class="">
  <?php 
    $resultado = mysqli_query($conexion, "SELECT * FROM fotos_autos WHERE id_vehiculo = $cod") ;
    while ($fila = mysqli_fetch_array($resultado)) {
      $nombre_imagen = $fila['id_vehiculo'];
      $ruta_imagen = $fila['ubicacion'];
      
      echo "<img     src='admin/$ruta_imagen' alt='$nombre_imagen' class='thumbnail'>";
    }
  ?>
</div>

<div   class="parteCentral" >
<?php 
  $resultado = mysqli_query($conexion, "SELECT * FROM fotos_autos WHERE id_vehiculo = $cod") ;
  if ($fila = mysqli_fetch_assoc($resultado)) {
    $nombre_imagen = $fila['id_vehiculo'];
    $ruta_imagen = $fila['ubicacion'];
  echo "<img class='img   '   src='admin/$ruta_imagen' alt='$nombre_imagen'  >";
  }
?>

<div>
<div class="contenedor">
  <div class="borde">
    <p>Marca</p>
  </div>
  <p class="Respuestas"    ><?php echo  $marca ; ?>.</p>
</div><br>
<div class="contenedor">
<div class="borde">
    <p>Linea</p>
  </div>
  <p class="Respuestas" ><?php echo  $linea ; ?></p>
</div><br><br>

<div class="contenedor">
  <div class="borde">
    <p>Tipo</p>
  </div>
  <p  class="Respuestas" >   <?php echo  $tipo ; ?> </p>
</div><br>


<div class="contenedor">
  <div class="borde">
    <p>Transmision</p>
  </div>
  <p class="Respuestas" >      <?php echo  $trans; ?></p>
</div><br>

<div class="contenedor">
  <div class="borde">
    <p>Modelo</p>
  </div>
  <p class="Respuestas" ><?php echo  $modelo ?></p>
</div>

<br>



<div class="contenedor">
  <div class="borde">
    <p>Kilometraje</p>
  </div>
  <p  class="Respuestas" ><?php echo  $km ?></p>
</div>



<br>



<div class="contenedor">
  <div class="borde">
    <p class="Respuestas" >Traccion</p>
  </div>
  <p class="Respuestas"   ><?php echo  $tracc ?></p>
</div>

<br>



<div class="contenedor">
  <div class="borde">
    <p>Combustible</p>
  </div>
  <p  class="Respuestas" >  <?php echo  $gas ?> </p>
</div>

<br>



<div class="contenedor">
  <div class="borde">
    <p>Color</p>
  </div>
  <p  class="Respuestas"  ><?php echo  $color ; ?></p>
</div>

<br>



<div class="contenedor">
  <div class="borde">
    <p>Precio</p>
  </div>
  <p  class="Respuestas" ><?php echo  $precio  ; ?></p>
</div>



</div>










</div>



<script>
  const images = document.querySelectorAll('.thumbnail');
  images.forEach(image => {
    image.addEventListener('click', () => {
      const mainImage = document.querySelector('.image-container img');
      mainImage.src = image.src;
    });
  });
</script>

<style>
  .image-container {
    display: flex;
    justify-content: center;
    margin-top: 10%;
    align-items: center;
    margin-bottom: 55px;
  }
  
  .image-container img {
    max-width: 90%;
    height: auto;
  }
  
  .thumbnail-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: -030%;
  }
  
  .thumbnail {
    max-width: 100px;
    height: auto;
    margin: 0 10px;
    cursor: pointer;
    opacity: 0.6;
    transition: opacity 0.3s ease-in-out;
  }
  
  .thumbnail:hover {
    opacity: 1;
  }
</style>

</p>














</body>



</html>