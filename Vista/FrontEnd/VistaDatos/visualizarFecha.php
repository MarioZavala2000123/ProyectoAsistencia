<?php 
include '../../../php/conexion.php';
$fechaIncio=$_GET['fechaAsistencia'];

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

<h2>Fecha</h2>

<table>
  <tr>
    <th>Colaborador</th>
    <th>Hora Ingreso</th>
    <th>Hora Salida</th>
  </tr>
  <?php 
  $instruccion = "SELECT Nombres,MIN(fechaHoraAsistencia) AS hora_Entrada,MAX(fechaHoraAsistencia) 
  AS hora_Salida FROM( SELECT T1.Nombres,M.fechaHoraAsistencia 
  FROM( SELECT I.idTarjeta,A.colaborador,C.Nombres FROM inventariotarjetas I 
  INNER JOIN asignaciontarjeta A ON I.idTarjeta = A.idTarjeta INNER JOIN colaboradores C 
  ON A.colaborador = C.IdColaborador) T1 INNER JOIN asistencias M ON T1.idTarjeta = M.idTarjeta WHERE 
  fechaHoraAsistencia>='$fechaIncio 00:00:00' AND fechaHoraAsistencia <= '$fechaIncio 23:59:00' )T2 
  GROUP BY Nombres";
  $query = mysqli_query($conexion,$instruccion);
    while ($r=mysqli_fetch_assoc($query)) {
      echo "<tr><td>".$r['Nombres']."</td><td>".$r['hora_Entrada']."</td><td>".
      $r['hora_Salida']."</td></tr>";
   
    }


   ?>
  
  
</table>

</body>
</html>
