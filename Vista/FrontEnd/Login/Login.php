<?php

// Conexion Ususario
//require_once("../../../php/Funciones-Conexion/GetUsuario.php");

// Proceso de datos cuando se envian

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Comprobar si el usuario esta vacio
    if(empty(trim($_POST["vCorreoLogin"]))) {
        $vCorreoLogin_err = "Porfavor ingrese su Correo";
    
    } else {
        $vCorreoLogin = trim($_POST["vCorreoLogin"]);
        // echo "vCorreoLogin";
        // echo $vCorreoLogin;
    }

    if(empty(trim($_POST["vContraseñaLogin"]))) {
        $vContraseñaLogin_err = "Porfavor ingrese su Contraseña";
    
    } else {
        $vContraseñaLogin = trim($_POST["vContraseñaLogin"]);
        // echo "vContraseñaLogin";
        // echo $vContraseñaLogin;
    }

    //$idTarjeta = consultaUsuario($vCorreoLogin, $vContraseñaLogin);

    //Validacion usuario
        if ($idTarjeta>0){
        //header('Location: ../../../php/Sesion.php?idTarjeta=' . $idTarjeta );
       // echo $idTarjeta;
        
        } 
        else {
        //Mostrar mensaje de error
        //echo "no hizo nada";
        //header('Location: Login.html');
        echo "NO ESTA CARGANDO EL USUARIO";
    }
}
?>