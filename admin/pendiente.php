<?php
	include("../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();

	$mysql->query("UPDATE citas SET status = 2 WHERE ALUFIC = '".$_POST['nombre']."'")or die(mysql_error());
	echo "ok";

?>