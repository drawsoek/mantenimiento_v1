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
<fieldset>
	<label>ORDEN DE TRABAJO DE MANTENIMIENTO</label><br><br><br><br>

<label style="float:left">No. Control:</label>
<div class="clear"></div>
<input type="text" name="nocontrol" id="nc" style="width:10%">
<br><br>

<fieldset class="lineafield" style="width:70%; margin-left:5px ">
	<div class="clear"></div>
	<fieldset style="width:96%; margin-left:5px">
 		<label>Mantenimiento:</label>
        	<input type="checkbox" name="interno" value="1">Interno
        	<input type="checkbox" name="externo" value="2">Externo
 	</fieldset>
 	<fieldset style="width:96%; margin-left:5px">
		<label>Tipo de Servicio:</label>
		<input type="text" name="servicio" id="tserv" style="width: 50%">
			<div class="clear"></div>
	</fieldset>
	<fieldset style="width:96%; margin-left:5px">
		<label>Asignado A:</label>
		<input type="text" name="asinado" id="ass" style="width:50%">
	</fieldset>
</fieldset><br>


<div class="clear"></div>
<fieldset class="lineafield" style="width:96%; margin-left:5px">
    <fieldset style="width:96%; margin-left:5px">
	<label>Fecha de Realizacion:</label>
			<div class="controls">
                <div class="input-append date" id="alufnac" data-date="2013/01/01" data-date-format="yyyy/dd/mm">
                        <input class="span1" size="16" type="text" value="2013/01/01" readonly>
                        <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
            </div>
	<div class="clear"></div>
    </fieldset>
<fieldset style="width:96%; margin-left:5px">
    	<label>Trabajo Realizado:</label>
    		<div class="clear"></div>
    	<textarea style=" width:96%"></textarea>
    </fieldset>
    <fieldset style="width:96%; margin-left:5px">
    	<label>Materiales Utilizados:</label>
    		<div class="clear"></div>
    	<textarea style=" width:96%"></textarea>
    </fieldset style="width:96%; margin-left:5px">
</fieldset>
	<fieldset class="lineafield" style="width:96%; margin-left:5px">

    	<fieldset style="width:46%;float:left; margin-left:5px" >
    	<label>Verificado y Liberado Por:</label>
    		<div class="clear"></div>
    	<input type="text" name="verifico" id="ver" style="width:80%">
    	</fieldset>
    	<fieldset style="width:46%;float:left; margin-left:5px ">
    	<label>Aprovado Por:</label>
    		<div class="clear"></div>
    	<input type="text" name="aprovado" id="apro" style="width:80%">
    	</fieldset>
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
</article>