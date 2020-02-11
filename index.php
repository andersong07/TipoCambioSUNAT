<?php
	
	// Conexion MySQL
	$usuario = 'root';
	$password = '110604';
	$server = '127.0.0.1';
	$basededatos = 'tmanten';
	$status = 0;
	$conexion = new MySQLi($server,$usuario,$password,$basededatos);
	$dia = getdate();
	$fechaActual = $dia[year].'-'.$dia[mon].'-'.$dia[mday];	
	
	$link = 'http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias';
	$texto=file_get_contents($link);
	$ntexto=strip_tags($texto,"<td>");
    $ntexto=str_replace("'","",$ntexto);
    $v = array("'",'"','%','width=4',' align=center',' class=tne10','class=H3','width=8');
    $ntexto=str_replace($v,"",$ntexto);
    $ntexto=explode('<td >',$ntexto);
	
	//print_r($ntexto);
	$totalArray = count($ntexto);
	$compra = (float)$ntexto[$totalArray-2];
	$venta = (float)$ntexto[$totalArray-1];
	
	// Nos conectamos para actualizar
	$query = "SELECT COUNT(*) AS RESULT FROM CAM WHERE FECHA='".$fechaActual."'";
	$result = mysqli_query($conexion,$query);
	$data = mysqli_fetch_array($result);
	if($data['RESULT']==0)
		$status = 1;
	
	// actualizamos conforme al status 
	if($status == 0){
		$query = "UPDATE CAM SET compra=".$compra.",venta=".$venta." WHERE fecha='".$fechaActual."'";
	}else{
		$query = "INSERT INTO CAM VALUES('".$fechaActual."',".$compra.",".$venta.",1.16)";
	}
	
	mysqli_query($conexion,$query);
	
	$conexion->close();

?>