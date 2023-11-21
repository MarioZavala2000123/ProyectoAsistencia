var a=0;
function viOpciones(){
a++;
if (a==1) {
  document.getElementById('options').style.display='block';
 }else{
  document.getElementById('options').style.display='none';
  a=0;

}
}



function cerrarSesion(){
	document.getElementById('btnCerrar').click();

}

function report(){
	document.getElementById('btnRepor').click();

}
function reporteSemana(){
	document.getElementById('btnSemPrin').click();

}


