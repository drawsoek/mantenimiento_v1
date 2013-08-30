<?php
/*
	include("../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();

	$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '".$_POST['nombre']."'")or die(mysql_error());
	$result = $mysql->f_array($sql);
	*/
?>
<fieldset>
	<label>SOLICITUD MANTEMIMIENTO CORRECTIVO</label>
<fieldset class="lineafield" style="width:25%; margin-left:2px">
	<div class="clear"></div>
 	<label>Departamento A Quien Se Dirige La Solicitud:</label>
 	<div class="clear"></div><br>
        <input type="checkbox" name="remase" value="1">Recursos Materiales y Servicios<br>
        <input type="checkbox" name="mante" value="2">Mantenimiento de Equipo<br>
        <input type="checkbox" name="cc" value="3">Centro de Computo<br>
</fieldset><br><br>

<label>Folio:</label><br><br>

<fieldset>
<label>Area Solicitante:</label>
<div class="clear"></div>
<fieldset style="width:46%; float:left; margin-right: 3%; margin-left: 2px;">
	Area: <select style="width:46%;" name="area" id="areso">

            <option value="1">Departamentos</option>
            <option value="2">Departamentos</option>
	</select>
</fieldset>
</fieldset><br><br>

<fieldset>
	
<div class="clear"></div>
<fieldset style="width:46%; float:left; margin-right: 3%; margin-left: 2px;">
	<label>Nombre y Firma Del Solicitante</label>
	<input type="text" style="width:92%;" name="nomyf" id="nyf">
	<div class="clear"></div>
	
</fieldset>

</fieldset>

<fieldset>
	
<div class="clear"></div>
<fieldset class="lineafield" style="width:46%; margin-left:2px">
	<div class="clear"></div>
	<label>Fecha de Elaboracion:</label>
	<input type="text" id="fecha">
<div class="clear"></div>
 	
</fieldset>
<fieldset class="lineafield" style="width:46%; margin-left:2px">
	<div class="clear"></div>
	<label>DESCRIPCION DEL SERVICIO SOLICITADO O FALLA A REPARAR</label>
<div class="clear"></div>
 <textarea row="5"></textarea>

</fieldset>
</fieldset>

<fieldset style="width:46%; float:left; margin-left:2px;">
	<label>[ACCIONES]</label>
		<br>
		<p style="margin-left:5px;">
	  
		<a class="btn btn-success" href="pdf/ejemplopdf.php?f=<?= $result['ALUFIC'] ?>&token=ZHJhd3NvZWs=" target="_BLANK" id="finalizar_btn"><i class="icon-ok icon-white"></i>Finalizar</a>
		</p>
</fieldset>
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