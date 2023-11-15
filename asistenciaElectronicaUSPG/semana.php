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

//$fechaInicio = $_GET['fechaIncio'];
$fechaInicio = $_GET['fechaIni'];
//echo $fechaInicio;
$fechaContador =$_GET['fechaIni'];
$co=0;
//$fechaFin = $_GET['fechaFin'];


include 'php/estableceComunicacion.php';

echo "<table><tr>";
echo "<th rowspan='3'>Técnico</th>";
  while ($co<5){
    echo "<th colspan='4'>$fechaContador</th>";
$co++;
$fechaContador= date("d-m-Y",strtotime($fechaInicio."+ ".$co." days"));
 }
echo "<th rowspan='3'>Minutos totales Posterior Ingreso</th>";
echo "<th rowspan='3'>Minutos totales Posterior Salida</th>";


echo "</tr><tr>";

$co=0;
while ($co<5) {
  echo "<th colspan='2'>Ingreso</th><th colspan='2'>Salida</th>";
  $co++;

}
echo "</tr>";

echo "</tr><tr>";

$co=0;
while ($co<10) {
  echo "<th>H</th><th>M</th>";
  $co++;
}
echo "</tr>";
 
$co=0;


 $instruc="SELECT U.nombre,T2.cod_usuario From (SELECT cod_usuario, t1.codigo_tarjeta
  FROM digmpro.digm_asignacion_tarjeta t, (SELECT codigo_tarjeta 
  FROM digmpro.digm_marcaje where fecha_hora > '$fechaInicio' and fecha_hora < '$fechaContador' group by codigo_tarjeta) T1 where t.cod_tarjeta=t1.codigo_tarjeta)T2, digmpro.digm_usuarios U where U.cod_usuario=T2.cod_usuario";
$query = pg_query($con_ad,$instruc);


while ($f=pg_fetch_assoc($query)){
  $auxCelda=0;
  $minutosAdicionalesEntrada=0;
  $minutosAdicionalesSalida=0;

  $co=0;
  $fechaPivote= $fechaInicio;
  echo "<tr><th>".$f['nombre']."</th>";
  $i = $f['cod_usuario'];
   
//ciclo de días
while ($co<5) {
  $instruc2 = "SELECT nombre,DATE_PART('hours',hora_entrada::timestamp-'$fechaPivote 08:00:00'::timestamp) as horas_ingreso,DATE_PART('minute',hora_entrada::timestamp-'$fechaPivote 08:00:00'::timestamp) as minutos_ingreso,DATE_PART('hours',hora_salida::timestamp-'$fechaPivote 16:00:00'::timestamp)  as horas_salida,DATE_PART('minute',hora_salida::timestamp-'$fechaPivote 16:00:00'::timestamp) as minutos_salida FROM (SELECT nombre,MIN(fecha_hora) as hora_entrada,max(fecha_hora) as hora_salida FROM(SELECT * from (SELECT M.codigo_tarjeta,T2.nombre,M.fecha_hora FROM digmpro.digm_marcaje M,(SELECT U.cod_usuario,U.nombre, T1.cod_usuario,T1.codigo_tarjeta FROM digmpro.digm_usuarios U,(SELECT T.codigo_tarjeta, A.cod_usuario,A.cod_tarjeta FROM digmpro.digm_tarjeta_huella T,digmpro.digm_asignacion_tarjeta A 
where T.codigo_tarjeta = A.cod_tarjeta and A.cod_usuario = $i order by cod_usuario asc) T1 where U.cod_usuario = T1.cod_usuario) T2 where M.codigo_tarjeta = T2.codigo_tarjeta order by M.fecha_hora desc) t3 where fecha_hora >= '$fechaPivote 00:00:00' and fecha_hora <= '$fechaPivote 23:00:00' order by fecha_hora asc) T5 GROUP BY nombre order by hora_entrada) as t9";

    $query1 = pg_query($con_ad,$instruc2);
    while ($r=pg_fetch_assoc($query1)) {
    echo "<td>".$r['horas_ingreso']."</td><td>".$r['minutos_ingreso']."</td><td>".$r['horas_salida']."</td><td>".$r['minutos_salida']."</td>";
   $auxCelda++;
   if ($r['minutos_ingreso']>0) {
      $minutosAdicionalesEntrada+=$r['minutos_ingreso'];
   }
   if ($r['minutos_salida']>0) {
      $minutosAdicionalesSalida+=$r['minutos_salida'];
   }
    }
   //echo $auxCelda."<br>";

   $co++;
    $fechaPivote= date("Y-m-d",strtotime($fechaPivote."+ 1 days"));
  }
   while ($auxCelda<5) {
    echo "<td>-</td><td>-</td><td>-</td><td>-</td>";
   $auxCelda++;
   }
   echo "<td>$minutosAdicionalesEntrada</td><td>$minutosAdicionalesSalida</td>";
  echo "</tr>";
}
  echo "</table>";
 ?>

</body>
</html>
