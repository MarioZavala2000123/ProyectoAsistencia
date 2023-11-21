<?php 	
 include 'php/estableceComunicacion.php';


 	$fechaInicioNew=date_create($_GET['fechaInicio']);
	$fechaFinNew=date_create($_GET['fechaFin']);
	$diff = date_diff($fechaInicioNew,$fechaFinNew);
	$diasDiferencia = $diff->format('%R%a');


$fechaInicio = $_GET['fechaInicio'];
$fechaFin = $_GET['fechaFin'];

$fechaFin=date("d-m-Y",strtotime($fechaFin));
$fechaInicio=date("d-m-Y",strtotime($fechaInicio)); 



 require('fpdf/fpdf.php');
	$pdf = new FPDF('P','mm','letter');
	$pdf->AliasNbPages();
$dato=0;
	
while ($dato<=$diasDiferencia) {

$pdf->AddPage();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(0,8,'MUNICIPALIDAD DE GUATEMALA',0,1,'C',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,5,utf8_decode('DIRECCION DE INFORMACIÓN GEOGRAFICA MUNICIPAL'),0,1,'C',0);
	$pdf->Cell(0,5,utf8_decode('Control de ingreso y egreso'),0,1,'C',0);
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(0,5,utf8_decode('Fecha: '.$fechaInicio),0,1,'L',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(110,12,utf8_decode('Colaborador: '),0,0,'C',1);
	$pdf->Cell(20,12,utf8_decode('Ingreso'),0,0,'C',1);
	$pdf->Cell(20,12,utf8_decode('Salida'),0,1,'C',1);

$instruc1 = "SELECT nombre,MIN(fecha_hora) as hora_entrada,max(fecha_hora) as hora_salida FROM(SELECT * from (SELECT M.codigo_tarjeta,T2.nombre,M.fecha_hora FROM digmpro.digm_marcaje M,(SELECT U.cod_usuario,U.nombre, T1.cod_usuario,T1.codigo_tarjeta FROM digmpro.digm_usuarios U,(SELECT T.codigo_tarjeta, A.cod_usuario,A.cod_tarjeta FROM digmpro.digm_tarjeta_huella T,digmpro.digm_asignacion_tarjeta A where T.codigo_tarjeta = A.cod_tarjeta order by cod_usuario asc) T1 where U.cod_usuario = T1.cod_usuario) T2 where M.codigo_tarjeta = T2.codigo_tarjeta order by M.fecha_hora desc) t3 where fecha_hora >= '$fechaInicio 00:00:00' and fecha_hora <= '$fechaInicio 23:00:00' order by fecha_hora asc) T5  GROUP BY nombre";

$query1 = pg_query($con_ad,$instruc1);

while ($f = pg_fetch_assoc($query1)){
	$pdf->Cell(110,12,utf8_decode($f['nombre']),1,0,'L',0);
	$pdf->Cell(20,12,substr($f['hora_entrada'],11,8),1,0,'L',0);
	$pdf->Cell(20,12,substr($f['hora_salida'],11,8),1,1,'L',0);
	}
	$dato++;
$fechaInicio=date("d-m-Y",strtotime($fechaInicio."+ 1 days")); 
	}

$pdf->Output('D','reporte'.$fechaFin.'.pdf');
	

 ?>