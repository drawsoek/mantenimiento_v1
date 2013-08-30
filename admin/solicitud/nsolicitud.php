		<article class="module width_full">

			<header><h3>Nueva solicitud</h3></header>
			<div class="module_content">

<?php
/*
	include("../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();

	$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '".$_POST['nombre']."'")or die(mysql_error());
	$result = $mysql->f_array($sql);
	*/
?>
<h1>SOLICITUD MANTEMIMIENTO CORRECTIVO</h1>
<fieldset>

<fieldset class="lineafield" style="width:45%; float:right; margin-top:39px;  margin-right:5px;">
 	<label style="font-size:10px; width:100%">Departamento a quien se dirige la solicitud:</label>
 	<div class="clear"></div>
        <input type="checkbox" style="margin-bottom:6px;" name="remase" value="1">Recursos Materiales y Servicios<br>
        <input type="checkbox" style="margin-bottom:6px;" name="mante" value="2">Mantenimiento de Equipo<br>
        <input type="checkbox" style="margin-bottom:6px;" name="cc" value="3">Centro de Computo<br>
</fieldset>


<label>Folio:</label><br><br>

<fieldset style="width:46%; float:left; margin-right: 3%; margin-left: 10px;">
<label>Area Solicitante:</label>
<div class="clear"></div>
<fieldset style="width:90%; float:left; margin-right: 3%; margin-left: 2px;">
	Area: <select style="width:46%;" name="area" id="areso">

            <option value="1">Departamentos</option>
            <option value="2">Departamentos</option>
	</select>
</fieldset>
</fieldset>
<br><br>


	
<fieldset style="width:50%; margin-left:10px; float:left; margin-top:32px;">
	<label>Nombre y Firma Del Solicitante</label><br>
	<input type="text" style="width:50%;" name="nomyf" id="nyf">
	<div class="clear"></div>
</fieldset>


<fieldset class="lineafield" style="width:46%; margin-left:2px; margin-right:5px; float:right;">
	<div class="clear"></div>
	<label>Fecha de Elaboracion:</label>
	<input type="text" id="fecha" style="width:80%">
<div class="clear"></div>
</fieldset>

	<div class="clear"></div>


<fieldset class="lineafield" style="width:90%; margin-left:10px">
	<div class="clear"></div>
	<label>DESCRIPCION DEL SERVICIO SOLICITADO O FALLA A REPARAR</label>
<div class="clear"></div>
 <textarea row="5"></textarea>

</fieldset>


<fieldset style="width:46%; float:left; margin-left:10px;">
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

	</div>
</article><!-- end of stats article -->