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

	//guardar ficha y asignar aula al alumno tambien actualizar la estructura

	$sql2 = $mysql->query("SELECT * FROM dfaula WHERE PDOCVE = '".$result['PDOCVE']."' AND CARCVE = ".$result['CARCVE1']." AND FAUULT < 40 ORDER BY AULCVE ASC");
	$result2 = $mysql->f_array($sql2);
	//echo "<br>";
	//echo $result2['AULCVE'];


	$sql_limite = $mysql->query("SELECT FCAULT,FCALIM FROM dfcarr WHERE PDOCVE = '".$result['PDOCVE']."' AND CARCVE = ".$result['CARCVE1']);
	$r_limite = $mysql->f_array($sql_limite);

/*
	echo "ultima ficha:".$r_limite['FCAULT']."<br>";
	echo "limite ficha:".$r_limite['FCALIM']."<br>";
*/

	if($r_limite['FCAULT'] < $r_limite['FCALIM']){
		//Incrementa FAUULT
		$mysql->query("UPDATE dfaula SET FAUULT = FAUULT+1 WHERE PDOCVE = '".$result['PDOCVE']."' AND AULCVE = '".$result2['AULCVE']."'")or die(mysql_error());


		$aula_alumno = $result2['AULCVE'];
		//Incrementa FCAULT
		$mysql->query("UPDATE dfcarr SET FCAULT = FCAULT+1 WHERE PDOCVE = '".$result['PDOCVE']."' AND CARCVE = ".$result['CARCVE1']);
		
		//Cambia estatus en citas
		$mysql->query("UPDATE citas SET status = 3 WHERE ALUFIC = '".$result["ALUFIC"]."'");

		$q_final = "INSERT INTO dficha".strtoupper("(ALUFIC, ALUAPP, ALUAPM, ALUNOM, ALUSEX, ALUNAC, ALULNA, ALURFC, ALUCUR, ALUESC, ALUEGR, ALUARE, ALUPRO, ALUCLL, ALUNUM, ALUCOL, ALUCPO, ALUMUN, ALUCIU, ALUTE1, ALUTE2, ALUMAI, ALUPAD, ALUMAD, ALUPADV, ALUMADV, ALUPADT, ALUMADT, ALUTNO, ALUTCL, ALUTNU, ALUTCO, ALUTCP, ALUTMU, ALUTCI, ALUTTE1, ALUTTE2, ALUTMAI, ALUTCE, ALUTRA, CARCVE1, CARCVE2, ALUECI, PDOCVE, AULCVE, FICFEC) VALUES ('".$result['ALUFIC']."', '".$result['ALUAPP']."', '".$result['ALUAPM']."', '".$result['ALUNOM']."', '".$result['ALUSEX']."', '".$result['ALUNAC']."', '".$result['ALULNA']."', '".$result['ALURFC']."', '".$result['ALUCUR']."', ".$result['ALUESC'].", ".$result['ALUEGR'].", '".$result['ALUARE']."', '".$result['ALUPRO']."', '".$result['ALUCLL']."', '".$result['ALUNUM']."', '".$result['ALUCOL']."', '".$result['ALUCPO']."', '".$result['ALUMUN']."', '".$result['ALUCIU']."', '".$result['ALUTE1']."', '".$result['ALUTE2']."', '".$result['ALUMAI']."', '".$result['ALUPAD']."', '".$result['ALUMAD']."', '".$result['ALUPADV']."', '".$result['ALUMADV']."', '".$result['ALUPADT']."', '".$result['ALUMADT']."', '".$result['ALUTNO']."', '".$result['ALUTCL']."', '".$result['ALUTNU']."', '".$result['ALUTCO']."', '".$result['ALUTCP']."', '".$result['ALUTMU']."', '".$result['ALUTCI']."', '".$result['ALUTTE1']."', '".$result['ALUTTE2']."', '".$result['ALUTMAI']."', '".$result['ALUTCE']."' ,'0' , '".$result['CARCVE1']."', '".$result['CARCVE2']."','".$result['ALUECI']."', '".$result['PDOCVE']."', '".$aula_alumno."', CURDATE())");

		$q_datos = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = $alufic");
		$r_datos = $mysql->f_numerico($q_datos);

		$mysql->query($q_final);



$pdf = new FPDF('P','mm','Letter');
$pdf->SetMargins(0, 0, 0);
$pdf->SetXY(0, 0);

$pdf->SetFont('Arial','',9);
$pdf->AddPage();

//la imagen de fondo
$pdf->Image('FICHA.JPG',10,-5,200);//218

//FICHA Up

//Numero De Ficha
$pdf->Text(48, 24, $result["ALUFIC"]);
//Aula
$pdf->Text(80, 23,$aula_alumno );// $aula_alumno 76+4, 31-8
//Periodo
$periosql = $mysql->query("SELECT * FROM dperio WHERE PDOCVE = '".$result["PDOCVE"]."'")or die(mysql_error());
$perioresult = $mysql->f_array($periosql);

$pdf->Text(148, 17, $perioresult["PDODES"]);
//Fecha
$pdf->Text(148, 22, date('Y-m-d'));//148, 29
//Opcion 1
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE1"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(38, 38, $carreresult["CARNCO"]);
//Opcion 2
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE2"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 37, $carreresult["CARNCO"]);
//Opcion 3
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE3"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 51, $carreresult["CARNCO"]);
//Nombre
$pdf->Text(44, 31, utf8_decode($result["ALUAPP"]).' '.utf8_decode($result["ALUAPM"]).' '.utf8_decode($result["ALUNOM"]));
//Calle
$pdf->Text(18, 48, utf8_decode($result["ALUCLL"]));
//Numero
$pdf->Text(78, 48, $result["ALUNUM"]);
//Colonia
$pdf->Text(114, 48, utf8_decode($result["ALUCOL"]));
//C.Postal
$pdf->Text(186, 48, $result["ALUCPO"]);
//Municipio
$estado=substr($result["ALULNA"],0,2);
$municipio=substr($result["ALULNA"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(20, 53, utf8_decode($resultmunicipio["MUNNOM"]));
// Estado
$estado=substr($result["ALULNA"],0,2);
$sqlestado = $mysql->query("SELECT * FROM destad WHERE ESTCVE = ".$estado)or die(mysql_error());
$resultestado = $mysql->f_array($sqlestado);
$pdf->Text(80, 53, utf8_decode($resultestado["ESTNOM"]));

//Ciudad
$pdf->Text(160, 53, utf8_decode($result["ALUCIU"]));
//Telefono 1
$pdf->Text(18, 59, $result["ALUTE1"]);
//Telefono 2
$pdf->Text(49, 59, $result["ALUTE2"]);
//Correo Electronico
$pdf->Text(86, 59, $result["ALUMAI"]);
// RFC
$pdf->Text(168, 59, $result["ALURFC"]);
//Escuela de Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$escuela = $result["ALUESC"];
//$sqlescuelaproc = $mysql->query("SELECT * FROM descue WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio." and ESCCVE=".$escuela)or die(mysql_error());
$sqlescuelaproc = $mysql->query("SELECT * FROM descue WHERE ESCCVE=".$escuela)or die(mysql_error());
$resultescuelaproc = $mysql->f_array($sqlescuelaproc);

$pdf->Text(16, 70, utf8_decode($resultescuelaproc["ESCNOM"]));

//Municipio Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);
$pdf->Text(90, 70, $resultmunicipio["MUNNOM"]);
//Estado De Procedencia
$estado=substr($result["ALUMUN"],0,2);
$sqlestado = $mysql->query("SELECT * FROM destad WHERE ESTCVE = ".$estado)or die(mysql_error());
$resultestado = $mysql->f_array($sqlestado);
$pdf->Text(150, 70, utf8_decode($resultestado["ESTNOM"]));
// Año Egreso
$pdf->Text(20, 77,$result["ALUEGR"] );
//Promedio
$pdf->Text(38, 77,$result["ALUPRO"] );
//Area
switch($result["ALUARE"])
{
	case 1: $area="FISICO-MATEMATICAS";break;
	case 2: $area="QUIMICO-BIOLOGICAS";break;
	case 3: $area="ECONOMICO ADMTVAS.";break;
	case 4: $area="SOCIALES Y HUMANIDADES";break;
	case 5: $area="BACHILLERATO GENERAL";break;
	case 6: $area="OTRA AREA";break;

}
$pdf->Text(48, 77,$area);
//Municipio De Nacimiento
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(90, 77, utf8_decode($resultmunicipio["MUNNOM"]));
//Estado Nacimiento
$estado=substr($result["ALUMUN"],0,2);
$sqlestado = $mysql->query("SELECT * FROM destad WHERE ESTCVE = ".$estado)or die(mysql_error());
$resultestado = $mysql->f_array($sqlestado);

$pdf->Text(150, 77, utf8_decode($resultestado["ESTNOM"]));
//Observaciones
$pdf->Text(16, 93, "LOS EXAMENES SE REALIZARAN EL DIA 07 DE JUNIO DE 2013 DE ACUERDO A LO SIGUIENTE: ");
$pdf->Text(16, 97, "* PRESENTACION DE LOS SUSTENTANTES EN EL AULA      08:00hrs. ");
$pdf->Text(16, 101, "* EXAMEN CENEVAL                                                                   09:00 - 13:00 hrs. ");

//-------------------------------------------------------------


//FICHA Down

//Numero De Ficha
$pdf->Text(47, 165, $result["ALUFIC"]);
//Aula
$pdf->Text(82, 164, $aula_alumno);
//Periodo
$periosql = $mysql->query("SELECT * FROM dperio WHERE PDOCVE = '".$result["PDOCVE"]."'")or die(mysql_error());
$perioresult = $mysql->f_array($periosql);

$pdf->Text(148, 158, $perioresult["PDODES"]);
//fecha
$pdf->Text(148, 162, date('Y-m-d'));//148, 29
//Opcion 1
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE1"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(36, 179, $carreresult["CARNCO"]);
//Opcion 2
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE2"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 179, $carreresult["CARNCO"]);
//Opcion 3
$carresql = $mysql->query("SELECT CARNCO FROM dcarre WHERE CARCVE = '".$result["CARCVE3"]."'")or die(mysql_error());
$carreresult = $mysql->f_array($carresql);

$pdf->Text(140, 205, $carreresult["CARNCO"]);
//Nombre
$pdf->Text(44, 172, utf8_decode($result["ALUAPP"]).' '.utf8_decode($result["ALUAPM"]).' '.utf8_decode($result["ALUNOM"]));
//Calle
$pdf->Text(16, 189, utf8_decode($result["ALUCLL"]));
//Numero
$pdf->Text(78, 189, $result["ALUNUM"]);
//Colonia
$pdf->Text(120, 189, utf8_decode($result["ALUCOL"]));
//C.Postal
$pdf->Text(190, 189, $result["ALUCPO"]);
//Municipio
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(20, 195, $resultmunicipio["MUNNOM"]);
// Estado
$estado=substr($result["ALULNA"],0,2);
$sqlestado = $mysql->query("SELECT * FROM destad WHERE ESTCVE = ".$estado)or die(mysql_error());
$resultestado = $mysql->f_array($sqlestado);
$pdf->Text(80, 195, utf8_decode($resultestado["ESTNOM"]));

//Ciudad
$pdf->Text(160, 195, $result["ALUCIU"]);
//Telefono 1
$pdf->Text(16, 201, $result["ALUTE1"]);
//Telefono 2
$pdf->Text(50, 201, $result["ALUTE2"]);
//Correo Electronico
$pdf->Text(86, 201, $result["ALUMAI"]);
// RFC
$pdf->Text(172, 201, $result["ALURFC"]);
//Escuela de Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$escuela = $result["ALUESC"];
//$sqlescuelaproc = $mysql->query("SELECT * FROM descue WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio." and ESCCVE=".$escuela)or die(mysql_error());
$sqlescuelaproc = $mysql->query("SELECT * FROM descue WHERE ESCCVE=".$escuela)or die(mysql_error());
$resultescuelaproc = $mysql->f_array($sqlescuelaproc);

$pdf->Text(15, 212, utf8_decode($resultescuelaproc["ESCNOM"]));

//Municipio Procedencia
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);

$pdf->Text(90, 212, $resultmunicipio["MUNNOM"]);
//Estado De Procedencia
$estado=substr($result["ALULNA"],0,2);
$sqlestado = $mysql->query("SELECT * FROM destad WHERE ESTCVE = ".$estado)or die(mysql_error());
$resultestado = $mysql->f_array($sqlestado);
$pdf->Text(150, 212, utf8_decode($resultestado["ESTNOM"]));

// Año Egreso
$pdf->Text(18, 218,$result["ALUEGR"] );
//Promedio
$pdf->Text(38, 218,$result["ALUPRO"] );
//Area
switch($result["ALUARE"])
{
	case 1: $area="FISICO-MATEMATICAS";break;
	case 2: $area="QUIMICO-BIOLOGICAS";break;
	case 3: $area="ECONOMICO ADMTVAS.";break;
	case 4: $area="SOCIALES Y HUMANIDADES";break;
	case 5: $area="BACHILLERATO GENERAL";break;
	case 6: $area="OTRA AREA";break;

}
$pdf->Text(48, 218,$area);

//Municipio De Nacimiento
$estado=substr($result["ALUMUN"],0,2);
$municipio=substr($result["ALUMUN"],2,3);
$sqlmunicipio = $mysql->query("SELECT * FROM dmunic WHERE ESTCVE = ".$estado." and MUNCVE=".$municipio)or die(mysql_error());
$resultmunicipio = $mysql->f_array($sqlmunicipio);
$pdf->Text(90, 218, utf8_decode($resultmunicipio["MUNNOM"]));
//Estado Nacimiento
$estado=substr($result["ALUMUN"],0,2);
$sqlestado = $mysql->query("SELECT * FROM destad WHERE ESTCVE = ".$estado)or die(mysql_error());
$resultestado = $mysql->f_array($sqlestado);

$pdf->Text(150, 218, utf8_decode($resultestado["ESTNOM"]));

//Observaciones
$pdf->Text(16, 232, "LOS EXAMENES SE REALIZARAN EL DIA 07 DE JUNIO DE 2013 DE ACUERDO A LO SIGUIENTE: ");
$pdf->Text(16, 236, "* PRESENTACION DE LOS SUSTENTANTES EN EL AULA      08:00hrs. ");
$pdf->Text(16, 240, "* EXAMEN CENEVAL                                                                   09:00 - 13:00 hrs. ");

//genera el PDF
$pdf->Output();
$mysql->close();
	}else{
		echo "<h1>Se llego al limite de fichas para esta carrera.</h1>";
	}

	
}
?>
