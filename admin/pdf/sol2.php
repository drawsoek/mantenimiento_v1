<?php
if($_GET['token'] != "ZHJhd3NvZWs="){
	echo "No autorizado!";
}else{
require('fpdf.php');
include("../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();
	$idsol = $_GET['f'];
	

	//$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '".$_POST['ALUFIC']."'")or die(mysql_error());
	$sql = $mysql->query("SELECT * FROM solicitudes_mto WHERE id_solicitud = '$idsol'")or die(mysql_error());
	$result = $mysql->f_array($sql);


$pdf = new FPDF('P','mm','Letter');
$pdf->SetMargins(0, 0, 0);
$pdf->SetXY(0, 0);

$pdf->SetFont('Arial','',9);
$pdf->AddPage();

//la imagen de fondo
$pdf->Image('fondo02.jpg',10,10,200);//218

//nom firma
$sql2 = $mysql->query("SELECT firma FROM usuarios WHERE id_usuario = ".$result['id_usuario'])or die(mysql_error());
$result2 = $mysql->f_array($sql2);
$pdf->Text(85, 111, $result2['firma']);

//fecha

$pdf->Text(65, 126, $result['fecha']);

//Descripcion
$descripcion = wordwrap($result["descripcion"], 120, "*", true);
$desc2 = explode("*" , $descripcion);
$tam = sizeof($desc2);
$salto = 145;
for($i = 0; $i < $tam; $i++){
$pdf->Text(20, $salto, $desc2[$i]);
$salto = $salto+4;
}


//genera el PDF
$pdf->Output();
$mysql->close();


	
}
?>
