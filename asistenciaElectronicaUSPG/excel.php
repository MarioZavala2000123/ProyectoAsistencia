<?php


	require 'Classes/PHPExcel.php';
	include 'php/estableceComunicacion.php';

	$fechaInicioNew=date_create($_GET['fechaInicio']);
	$fechaFinNew=date_create($_GET['fechaFin']);
	$diff = date_diff($fechaInicioNew,$fechaFinNew);
	$diasDiferencia = $diff->format('%R%a');

	$fechaInicio=$_GET['fechaInicio'];
	$fechaFin=$_GET['fechaFin'];
	$fechaInicio=date("d-m-Y",strtotime($fechaInicio));
	$fechaFin=date("d-m-Y",strtotime($fechaFin."+ 1 days")); 

	//$fechaInicio=date("d-m-Y",strtotime($fechaInicio)); 


	$fila = 2; 
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Jeffry Fajardo")->setDescription("Reporte de Marcaje");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Marcaje");
	
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
//	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(100);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Colaborador');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Fecha');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Entrada');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Salida');



$dato=0;
while ($dato<=$diasDiferencia) {

$instruc2 = "SELECT * FROM (SELECT nombre,MIN(fecha_hora) as hora_entrada,max(fecha_hora) as hora_salida
FROM(SELECT * from (SELECT M.codigo_tarjeta,T2.nombre,M.fecha_hora FROM digmpro.digm_marcaje M,(SELECT U.cod_usuario,U.nombre, T1.cod_usuario,T1.codigo_tarjeta 
FROM digmpro.digm_usuarios U,(SELECT T.codigo_tarjeta, A.cod_usuario,A.cod_tarjeta 
FROM digmpro.digm_tarjeta_huella T,digmpro.digm_asignacion_tarjeta A where T.codigo_tarjeta = A.cod_tarjeta order by cod_usuario asc) T1 where U.cod_usuario = T1.cod_usuario) T2 where M.codigo_tarjeta = T2.codigo_tarjeta order by M.fecha_hora desc) t3 
where fecha_hora >= '$fechaInicio 00:00:00' and fecha_hora <= '$fechaInicio 23:00:00' order by fecha_hora asc) T5  GROUP BY nombre)T6";
$resultado = pg_query($con_ad,$instruc2);
	
	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = pg_fetch_assoc($resultado)){
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['nombre']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $fechaInicio);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, substr($rows['hora_entrada'],11,8));
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, substr($rows['hora_salida'],11,8));
		$fila++; //la siguiente fila
	}
	$fechaInicio=date("d-m-Y",strtotime($fechaInicio."+ 1 days"));
	$dato++; 
	}
		$fila = $fila-1;
	
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	// incluir gráfico

	
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename=Asistencia'.$fechaFin.'.xlsx"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output');
?>