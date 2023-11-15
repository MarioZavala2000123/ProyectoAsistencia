<?php

include('php/veriUsario.php');
//include 'php/conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Asistencia de colaboradores</title>
<link rel="stylesheet" type="text/css" href="css/reporElectronico.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<?php 
include 'php/moduloEnc.php';
 ?>

<div class="auxContenedor">
  <?php 
include 'php/moduloMenu.php';
 ?>
  <div class="auxMovil">
<label class="textosGuia"> Inicio </label>
<input id="fechaInicio" class="campoFecha" type="date">
</div>


  <div class="auxMovil">
  <svg class="btn" onclick="muestraMarcaje()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
</svg>

  <svg class="btn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /><a id="btnDescarga" href="excel.php?fechaInicio=">
</a></svg>

  <svg class="btn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
</svg>
</div>

<div id="btnImpresion"></div>
<div id="btnDescarga"></div>
</div>
 
<div id="txtHint"></div>

<script type="text/javascript" src="js/funciones.js"></script>
<script>

function muestraMarcaje() {

  var fechaIni = document.getElementById('fechaInicio').value;

 // console.log(fechaIni);
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","visualizarFecha.php?fechaIncio="+fechaIni,true);
  xmlhttp.send();
 
}

</script>


<script type="text/javascript">

var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1;
var yyyy = hoy.getFullYear();

if(dd<10) {
    dd='0'+dd;
} 
 
if(mm<10) {
    mm='0'+mm;
} 

var fechahoy = yyyy+"-"+mm+"-"+dd;

document.getElementById("fechaInicio").value = fechahoy;
//document.getElementById("fechaFin").value = fechahoy;

muestraMarcaje();
//imprimeMarcaje()

</script>
</body>
</html>
