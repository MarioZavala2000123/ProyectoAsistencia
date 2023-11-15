<?php 
include 'php/conexion.php';

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Marcajes DIGM</title>
	<style>
table {
  font-family: "segoe ui light";
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

<?php 

  $fechaInicioNew=date_create($_GET['fechaIncio']);
  $fechaFinNew=date_create($_GET['fechaFin']);
  $diff = date_diff($fechaInicioNew,$fechaFinNew);
  $diasDiferencia = $diff->format('%R%a');


$fechaInicio = $_GET['fechaIncio'];
$fechaFin = $_GET['fechaFin'];
//$fechaFin=date_format($fechaFin, "d/m/Y"); 
$fechaInicio=date("d-m-Y",strtotime($fechaInicio)); 
$fechaFin=date("d-m-Y",strtotime($fechaFin)); 


$dato=0;
  
while ($dato<=$diasDiferencia) {


$instruc2 = "SELECT nombre,MIN(fecha_hora) as hora_entrada,max(fecha_hora) as hora_salida FROM(SELECT * from (SELECT M.codigo_tarjeta,T2.nombre,M.fecha_hora FROM digmpro.digm_marcaje M,(
SELECT U.cod_usuario,U.nombre, T1.cod_usuario,T1.codigo_tarjeta FROM digmpro.digm_usuarios U,(SELECT T.codigo_tarjeta, A.cod_usuario,A.cod_tarjeta 
FROM digmpro.digm_tarjeta_huella T,digmpro.digm_asignacion_tarjeta A 
where T.codigo_tarjeta = A.cod_tarjeta order by cod_usuario asc) T1 where U.cod_usuario = T1.cod_usuario) T2 where M.codigo_tarjeta = T2.codigo_tarjeta order by M.fecha_hora desc) t3
where fecha_hora >= '$fechaInicio 00:00:00' and fecha_hora <= '$fechaInicio 23:00:00' order by fecha_hora asc) T5  GROUP BY nombre order by hora_entrada";
$query1 = mysqli_query($conexion,$instruc2);
  echo "<h2>Fecha: $fechaInicio</h2>";
  echo "<table>";
  echo"<tr>
    <th>Colaborador</th>
    <th>Ingreso</th>
    <th>Salida</th>
  </tr>";
while ($r=mysqli_fetch_assoc($query1)) {
  echo "<tr><td>".$r['nombre']."</td><td>".substr($r['hora_entrada'],11,8)."</td><td>".substr($r['hora_salida'],11,8)."</td></tr>";
}
$dato++;

$fechaInicio=date("d-m-Y",strtotime($fechaInicio."+ 1 days")); 
echo "</table>";

}
 ?>

</body>
</html>
