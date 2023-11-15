<?php 
//archivo que establece la conexion entre php y base de datos
$server="localhost";
$user="root";
$pass="";
$bd="asistencia";

$conexion = mysqli_connect($server,$user,$pass,$bd);
 ?>