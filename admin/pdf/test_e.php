<?php

	include("../../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();
	$alufic = $_GET['f'];
	

	//$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '".$_POST['ALUFIC']."'")or die(mysql_error());
	$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '$alufic'")or die(mysql_error());
	$result = $mysql->f_array($sql);

	//guardar ficha y asignar aula al alumno tambien actualizar la estructura
	//echo $result['CARCVE1'];
	//echo "<br>".$result['PDOCVE'];
	$sql2 = $mysql->query("SELECT * FROM dfaula WHERE PDOCVE = '".$result['PDOCVE']."' AND CARCVE = ".$result['CARCVE1']." AND FAUULT < 40 ORDER BY AULCVE ASC");
	$result2 = $mysql->f_array($sql2);
	//echo "<br>";
	//echo $result2['AULCVE'];


	$sql_limite = $mysql->query("SELECT FCAULT,FCALIM FROM dfcarr WHERE PDOCVE = '".$result['PDOCVE']."' AND CARCVE = ".$result['CARCVE1']);
	$r_limite = $mysql->f_array($sql_limite);


	echo "ultima ficha:".$r_limite['FCAULT']."<br>";
	echo "limite ficha:".$r_limite['FCALIM']."<br>";

	if($r_limite['FCAULT'] < $r_limite['FCALIM']){
		$mysql->query("UPDATE dfaula SET FAUULT = FAUULT+1 WHERE PDOCVE = '".$result['PDOCVE']."' AND AULCVE = '".$result2['AULCVE']."'")or die(mysql_error());

		echo $result['CARCVE1']."<br>";
		echo "EL AULA:".$result2['AULCVE']."<br>";
		$mysql->query("UPDATE dfcarr SET FCAULT = FCAULT+1 WHERE PDOCVE = '".$result['PDOCVE']."' AND CARCVE = ".$result['CARCVE1']);
		echo "si";
	}else{
		echo "se lleno al limite";
	}




?>