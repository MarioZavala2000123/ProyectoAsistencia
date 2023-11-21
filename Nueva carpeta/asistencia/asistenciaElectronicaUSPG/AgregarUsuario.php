<?php
include 'php/conexion.php';
$nombre=$_POST['nombreColaborador'];
$usuario=$_POST['us_colaborador'];
$pass=password_hash($_POST['us_contra'],PASSWORD_DEFAULT);
$instruccion="INSERT INTO usuarios (idUser, Nombre, usuario, pass) VALUES (NULL, '$nombre', '$usuario', '$pass');";
mysqli_query($conexion,$instruccion);
header('location:index.php');



?>