<?php
if($_GET['token'] != "ZHJhd3NvZWs="){
	echo "No autorizado!";
}else{
require('fpdf.php');
include("../../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();
	$alufic = $_GET['f'];
	//$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '".$_POST['ALUFIC']."'")or die(mysql_error());
	$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '$alufic'")or die(mysql_error());
	$result = $mysql->f_array($sql);

$pdf = new FPDF();
$pdf->SetMargins(0, 0, 0);
$pdf->SetXY(0, 0);

$pdf->SetFont('Arial','',11);
$pdf->AddPage();

//la imagen de fondo
$pdf->Image('FICHA.JPG',0,0,218);

//FICHA Up

//Numero De Ficha
$pdf->Text(43, 31, $result["ALUFIC"]);
//Aula
$pdf->Text(76, 31, $result["AULCVE"]);
//Periodo
$periosql = $mysql->query("SELECT * FROM dperio WHERE PDOCVE = '".$result["PDOCVE"]."'")or die(mysql_error());
$perioresult = $mysql->f_array($periosql);

$pdf->Text(148, 24, $perioresult["PDODES"]);
//Opcion 1
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE1"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(29, 47, $carreresult["CARNCO"]);
//Opcion 2
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE2"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 46, $carreresult["CARNCO"]);
//Opcion 3
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE3"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 51, $carreresult["CARNCO"]);
//Nombre
$pdf->Text(40, 39, $result["ALUAPP"].' '.$result["ALUAPM"].' '.$result["ALUNOM"]);
//Calle
$pdf->Text(10, 57, $result["ALUCLL"]);
//Numero
$pdf->Text(78, 57, $result["ALUNUM"]);
//Colonia
$pdf->Text(120, 57, $result["ALUCOL"]);
//C.Postal
$pdf->Text(190, 57, $result["ALUCPO"]);
//Municipio
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(20, 64, $resultmunicipio["MUNNOM"]);
// Estado
$pdf->Text(80, 64, Estado);

//Ciudad
$pdf->Text(160, 64, $result["ALUCIU"]);
//Telefono 1
$pdf->Text(16, 70, $result["ALUTE1"]);
//Telefono 2
$pdf->Text(46, 70, $result["ALUTE2"]);
//Correo Electronico
$pdf->Text(86, 70, $result["ALUMAI"]);
// RFC
$pdf->Text(172, 70, $result["ALURFC"]);
//Escuela de Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$escuela = $result["ALUESC"];
$sqlescuelaproc = $mysql->query("SELECT * FROM descue WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio." and ESCCVE=".$escuela)or die(mysql_error());
$resultescuelaproc = $mysql->f_array($sqlescuelaproc);

$pdf->Text(10, 82, $resultescuelaproc["ESCNOM"]);

//Municipio Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(90, 82, $resultmunicipio["MUNNOM"]);
//Estado De Procedencia
$pdf->Text(150, 82, Estado);
// Año Egreso
$pdf->Text(10, 89,$result["ALUEGR"] );
//Promedio
$pdf->Text(28, 89,$result["ALUPRO"] );
//Area
$pdf->Text(44, 89,$result["ALUARE"] );
//Municipio De Nacimiento
$pdf->Text(80, 89, Aqui);
//Estado Nacimiento
$pdf->Text(150, 89,Aqui );
//Observaciones
$pdf->Text(15, 103, VeoEscucho);



//-------------------------------------------------------------


//FICHA Down

//Numero De Ficha
$pdf->Text(43, 185, $result["ALUFIC"]);
//Aula
$pdf->Text(76, 185, $result["AULCVE"]);
//Periodo
$periosql = $mysql->query("SELECT * FROM dperio WHERE PDOCVE = '".$result["PDOCVE"]."'")or die(mysql_error());
$perioresult = $mysql->f_array($periosql);

$pdf->Text(148, 178, $perioresult["PDODES"]);
//Opcion 1
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE1"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(29, 201, $carreresult["CARNCO"]);
//Opcion 2
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE2"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 200, $carreresult["CARNCO"]);
//Opcion 3
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE3"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 205, $carreresult["CARNCO"]);
//Nombre
$pdf->Text(40, 193, $result["ALUAPP"].' '.$result["ALUAPM"].' '.$result["ALUNOM"]);
//Calle
$pdf->Text(10, 211, $result["ALUCLL"]);
//Numero
$pdf->Text(78, 211, $result["ALUNUM"]);
//Colonia
$pdf->Text(120, 211, $result["ALUCOL"]);
//C.Postal
$pdf->Text(190, 211, $result["ALUCPO"]);
//Municipio
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(20, 218, $resultmunicipio["MUNNOM"]);
// Estado
$pdf->Text(80, 218, Estado);

//Ciudad
$pdf->Text(160, 218, $result["ALUCIU"]);
//Telefono 1
$pdf->Text(16, 224, $result["ALUTE1"]);
//Telefono 2
$pdf->Text(46, 224, $result["ALUTE2"]);
//Correo Electronico
$pdf->Text(86, 224, $result["ALUMAI"]);
// RFC
$pdf->Text(172, 224, $result["ALURFC"]);
//Escuela de Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$escuela = $result["ALUESC"];
$sqlescuelaproc = $mysql->query("SELECT * FROM descue WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio." and ESCCVE=".$escuela)or die(mysql_error());
$resultescuelaproc = $mysql->f_array($sqlescuelaproc);

$pdf->Text(10, 236, $resultescuelaproc["ESCNOM"]);

//Municipio Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(90, 236, $resultmunicipio["MUNNOM"]);
//Estado De Procedencia
$pdf->Text(150, 236, Estado);
// Año Egreso
$pdf->Text(10, 243,$result["ALUEGR"] );
//Promedio
$pdf->Text(28, 243,$result["ALUPRO"] );
//Area
$pdf->Text(44, 243,$result["ALUARE"] );
//Municipio De Nacimiento
$pdf->Text(80, 243, Aqui);
//Estado Nacimiento
$pdf->Text(150, 243,Aqui );
//Observaciones
$pdf->Text(15, 257, VeoEscucho);
//genera el PDF
$pdf->Output();
}
?>
