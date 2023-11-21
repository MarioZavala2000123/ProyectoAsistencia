<?php
include 'php/conexion.php';

$codigoTarjeta = $_GET['tarjeta']; //recopilacion del codigo de nuestro dispositivo

//$codigoTarjeta = $_GET['terjeta']; //es para realizar testeo

$instruccion = "INSERT INTO asistencias (idAsistencia, idTarjeta, fechaHoraAsistencia)
VALUES (NULL, '$codigoTarjeta', current_timestamp())";
//instruccion SQL, cambiar en values el codigo tarjeta

mysqli_query($conexion, $instruccion); //enviado a base de datos codigo de tarjeta porf medio de SQL
?>