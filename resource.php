<?php
	// Realizar consulta a SUNAT para el tipo de Cambio Actual.
	
	$link = 'http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias';
	$texto=file_get_contents($link);
	$ntexto=strip_tags($texto,"<td>");
    $ntexto=str_replace("'","",$ntexto);
    $v = array("'",'"','%','width=4',' align=center',' class=tne10','class=H3','width=8');
    $ntexto=str_replace($v,"",$ntexto);
    $ntexto=explode('<td >',$ntexto);
	
	$totalArray = count($ntexto);
	$compra = (float)$ntexto[$totalArray-2];
	$venta = (float)$ntexto[$totalArray-1];
	
	echo "Tipo de Cambio compra ".$compra;
	echo "<br>";
	echo "Tipo de Cambio venta ".$venta;

?>