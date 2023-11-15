<?php
   include('php/veriUsario.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/reporElectronico.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
<title>Reporte de marcaje</title>

</head>
<body>

<?php 
include 'php/moduloEnc.php';
 ?>

<div class="auxContenedor">
    <?php 
include 'php/moduloMenu.php';
 ?>

<label class="textosGuia">Fecha Inicio </label><input id="fechaInicio" type="date" onchange="imprimeMarcaje()">

<svg class="btn" onclick="muestraMarcaje()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
</svg>



</div>
<div id="txtHint"></div>

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
  xmlhttp.open("GET","semana.php?fechaIni="+fechaIni,true);
  xmlhttp.send();
 
}


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


muestraMarcaje();


</script>
<script type="text/javascript" src="js/funciones.js"></script>

</body>
</html>
