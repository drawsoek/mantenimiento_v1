	<article class="module width_full">

			<header><h3>Nueva orden de trabajo</h3></header>
			<div class="module_content">

<?php


	$sql = $mysql->query("SELECT * FROM solicitudes_mto WHERE id_status = 1")or die(mysql_error());
	$result = $mysql->f_array($sql);

	$sql_worker = $mysql->query("SELECT * FROM usuarios WHERE id_area = 1")or die(mysql_error());
	$result_worker = $mysql->f_array($sql_worker);


?>
<h1>Crear orden de trabajo</h1>

<form name="nsol" action="index.php?o=ns" method="post">
<fieldset>

<fieldset style="width:46%; display:inline-block; margin-right: 3%; margin-left: 10px;">
	<label>Solicitud:</label>
	<div class="clear"></div>
	<fieldset style="width:90%; float:left; margin-right: 3%; margin-left: 2px;">
		Folio: <select style="width:90%;" name="area" id="area">
	                                        <?php
	                                            do{
	                                                echo "<option value='".$result['id_solicitud']."'>".$result['id_solicitud']." - ".$result['fecha']."</option>";
	                                            }while($result = $mysql->f_array($sql));
	                                        ?>
		</select>
	</fieldset>
</fieldset>

<fieldset style="width:46%; display:inline-block; ">
	<label>Trabajador:</label>
	<div class="clear"></div>
	<fieldset style="width:90%; float:left; margin-right: 3%; margin-left: 2px;">
		Nombre: <select style="width:90%;" name="area" id="area">
	                                        <?php
	                                            do{
	                                                echo "<option value='".$result_worker['id_usuario']."'>".$result_worker['nombre']."</option>";
	                                            }while($result_worker = $mysql->f_array($sql_worker));
	                                        ?>
		</select>
	</fieldset>
</fieldset>
	<div class="clear"></div>
<br><br>


	<div class="clear"></div>
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