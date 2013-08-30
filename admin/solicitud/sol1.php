		<article class="module width_full">
<?php
/*
	include("../db/conexionMysql.php");
	$mysql = new mysql;
	$mysql->connect();

	$sql = $mysql->query("SELECT * FROM aficha WHERE ALUFIC = '".$_POST['nombre']."'")or die(mysql_error());
	$result = $mysql->f_array($sql);
	*/
?>
<fieldset style="width:98%; margin-left:5px">
		<label>LISTA DE VERIFICACION</label><br><br>
	<fieldset class="lineafield" style="width:96%; margin-left:5px">
			<div class="clear"></div>

		<fieldset style="width:96%; margin-left:5px">
 			<label>Jefe del Departamento de:</label>
 			<input type="text" name="nomjefe" id="njefe" style="width:60%">
 			<div class="clear"></div><br>
        	<input type="checkbox" name="remase" value="1">Recursos Materiales y Servicios<br>
        	<input type="checkbox" name="mante" value="2">Mantenimiento de Equipo<br>
        	<input type="checkbox" name="cc" value="3">Centro de Computo<br>
    	</fieldset>
    	<fieldset style="width:96%; margin-left:5px">
    		<label>Jefe del Area Verificada:</label>
 			<input type="text" name="njefearea" id="njefea" style="width:60%">
 		</fieldset>

 		<fieldset style="width:96%; margin-left:5px">
 			<label>Area Verificada:</label>
 			<input type="text" name="area" id="area" style="width:60%" >
 		</fieldset>
    
	</fieldset>

	<fieldset class="lineafield" style="width:96%; margin-left:5px">
	<div class="clear"></div>
 		<fieldset style="width:96%; margin-left:5px">
		<label>Espacio Verificado:</label>
		<input type="text" name="esver" id="ever" style="width: 60%">
			<div class="clear"></div>
		</fieldset>
		<fieldset style="width:96%; margin-left:5px">
			<label>Hallazgo:</label>
			
			<textarea style="width:92%" id="hzgo" name="azgo"></textarea>
		</fieldset>
		<fieldset style="width:96%; margin-left:5px">
 		<label>Atendido Inmediatamente</label>
        	<input type="checkbox" name="si" value="1">Si
        	<input type="checkbox" name="no" value="2">No
 		</fieldset>
 		<a  class="btn btn-success" href="#" id="agregar-btn">Agregar</a>
	</fieldset><br>

		<div class="clear"></div>
	<fieldset class="lineafield" style="width:96%; margin-left:5px">
		<label>REALIZO:</label>
		<div class="clear"></div>
    	<fieldset style="width:48%;float:left; margin-left:5px" >
   			<label>Depto. de Recursos Materiales y Servicios:</label>
    		<div class="clear"></div>
    		<input type="text" name="njd" id="njdepto" style="width:80%">
    	</fieldset>
    	<fieldset style="width:48%;float:right; margin-left:5px; margin-right:5px">
    		<label>Jefe del Area Verificada:</label>
    		<div class="clear"></div>
    		<input type="text" name="nomjab" id="njav" style="width:80%">
    	</fieldset>
    </fieldset>
</fieldset>

<fieldset style="width:46%; float:left; margin-left:5px;">
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
</article>