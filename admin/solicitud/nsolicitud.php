		<article class="module width_full">

			<header><h3>Nueva solicitud</h3></header>
			<div class="module_content">

<?php


	$sql = $mysql->query("SELECT * FROM areas")or die(mysql_error());
	$result = $mysql->f_array($sql);



?>
<h1>SOLICITUD MANTEMIMIENTO CORRECTIVO</h1>
<?php
	if(!empty($_POST['enviado'])){
		$mysql->query("INSERT INTO solicitudes_mto VALUES(0, ".$_SESSION['idusuario'].", '".$_POST['area']."', NOW(), '".$_POST['descripcion']."', 1, '".$_POST['dirige']."')")or die(mysql_error());
		echo '<h4 class="alert_success">Solicitud guardada correctamente</h4>';
	}

?>
<form name="nsol" action="index.php?o=ns" method="post">
<fieldset>

<fieldset class="lineafield" style="width:45%; float:right; margin-top:39px;  margin-right:5px;">
 	<label style="font-size:10px; width:100%">Departamento a quien se dirige la solicitud:</label>
 	<div class="clear"></div>
        <input type="radio" style="margin-bottom:6px;" name="dirige" value="1">Recursos Materiales y Servicios<br>
        <input type="radio" style="margin-bottom:6px;" name="dirige" value="2">Mantenimiento de Equipo<br>
        <input type="radio" style="margin-bottom:6px;" name="dirige" value="3">Centro de Computo<br>
</fieldset>


<label>Folio:</label><br><br>

<fieldset style="width:46%; float:left; margin-right: 3%; margin-left: 10px;">
<label>Area Solicitante:</label>
<div class="clear"></div>
<fieldset style="width:90%; float:left; margin-right: 3%; margin-left: 2px;">
	Area: <select style="width:46%;" name="area" id="area">
                                        <?php
                                            do{
                                                echo "<option value='".$result['id_area']."'>".$result['nombre']."</option>";
                                            }while($result = $mysql->f_array($sql));
                                        ?>
	</select>
</fieldset>
</fieldset>
<br><br>


	
<fieldset style="width:50%; margin-left:10px; float:left; margin-top:32px;">
	<label>Nombre y Firma Del Solicitante</label><br>
	<input type="text" style="width:50%;" name="firma" id="firma">
	<div class="clear"></div>
</fieldset>


<fieldset class="lineafield" style="width:46%; margin-left:2px; margin-right:5px; float:right;">
	<div class="clear"></div>
	<label>Fecha de Elaboracion:</label>
	<?php
	$fecha = new DateTime();
	?>
	<input type="text" id="fecha" readonly="readonly" style="width:80%" value="<?= $fecha->format('Y-m-d H:i') ?>">
<div class="clear"></div>
</fieldset>

	<div class="clear"></div>


<fieldset class="lineafield" style="width:90%; margin-left:10px">
	<div class="clear"></div>
	<label>DESCRIPCION DEL SERVICIO SOLICITADO O FALLA A REPARAR</label>
<div class="clear"></div>
 <textarea name="descripcion" row="5"></textarea>

</fieldset>


<fieldset style="width:46%; float:left; margin-left:10px;">
	<label>[ACCIONES]</label>
		<br>
		<p style="margin-left:5px;">
	  
		<input type="submit" class="btn btn-success" value="ENVIAR" name="enviado">
</fieldset>
</form>
<?php
//libera memoria
/*
	$result = $mysql->free_sql($sql);
	$result = $mysql->free_sql($sql_muni);
	$result = $mysql->free_sql($sql_bach);
	$result = $mysql->free_sql($sql_muni2);
	$result = $mysql->free_sql($sql_muni3);
	$mysql->close();
	*/
?>
<div class="clear"></div>

	</div>
</article><!-- end of stats article -->