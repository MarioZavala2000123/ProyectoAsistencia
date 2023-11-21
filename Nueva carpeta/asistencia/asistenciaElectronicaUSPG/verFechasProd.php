<?php 
include 'php/conexion.php';

 ?> 


<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<table>
  <tr>
    <th>Colaborador</th>
    <th>Hora Ingreso</th>
    <th>Hora Salida</th>
  </tr>
  <?php 
  $instruccion = "SELECT * FROM `asistencias` ORDER BY idAsistencia desc";
  $query = mysqli_query($conexion,$instruccion);
    while ($r=mysqli_fetch_assoc($query)) {
      echo "<tr><td>".$r['idAsistencia']."</td><td>".$r['idTarjeta']."</td><td>".$r['FechaHoraAsistencia']."</td></tr>";
   
    }


   ?>
  
  
</table>

</body>
</html>
