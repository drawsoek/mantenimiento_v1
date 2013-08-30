<?php
header("Content-type: text/x-json");

// nos conectamos
$conex = mysql_connect('itculiacan.edu.mx','programacion','W0lfr4m10*itc')or die ('Error: imposible conectar con MySQL');
//$conex = mysql_connect('localhost','root','root')or die ('Error: imposible conectar con MySQL');
// seleccionamos la db
$db = mysql_select_db('fichasdb')or die ('Error: no se puede seleccionar la base de datos');

// armamos las condiciones segun sea el caso ..
if($_POST['query']!=''){
	if($_POST['qtype'] == "fecha"){ $tabla = "citas"; }else{ $tabla = "aficha"; } 
   $where = "WHERE $tabla.".mysql_real_escape_string($_POST['qtype'])." LIKE '%".
mysql_real_escape_string($_POST['query'])."%' ";
}elseif($_POST['letter_pressed']!=''){
   $where = "WHERE $tabla.".mysql_real_escape_string($_POST['qtype'])." LIKE '".
mysql_real_escape_string($_POST['letter_pressed'])."%' ";
}elseif($_POST['letter_pressed']=='#'){
   $where = "WHERE $tabla.".mysql_real_escape_string($_POST['qtype'])." REGEXP '[[:digit:]]' ";
}else{
   $where ='';
}

// conseguimos el total de registros
$result = mysql_query('SELECT COUNT(aficha.ALUFIC) FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)'.$where."AND citas.status = 2");
$row = mysql_fetch_array($result);
$total = $row[0];

// ordenar por X campo
$sortname = empty($_POST['sortname']) ? 'name' : mysql_real_escape_string($_POST['sortname']);

// orden ascendente o descendente
$sortorder = empty($_POST['sortorder']) ? 'desc' : mysql_real_escape_string($_POST['sortorder']);

// establecemos el orden
$sort = "ORDER BY $sortname $sortorder";

// numero de pagina por defecto 1
$page = (int)(empty($_POST['page']) ? 1 : $_POST['page']);

// numero de registros a mostrar
$rp = (int)(empty($_POST['rp']) ? 10 : $_POST['rp']);

// desde donde comenzar
$start = (($page-1) * $rp);

// limite de registros a mostrar
$limit = "LIMIT $start, $rp";

// arrmamos un array con los datos a codificar
$arrDatos = array('page' => $page,'total' => $total);


// consulta general

//$result = mysql_query("SELECT ALUFIC, ALUAPP, ALUAPM, ALUNOM FROM aficha $where $sort $limit");
$result = mysql_query("SELECT aficha.ALUFIC, aficha.ALUAPP, aficha.ALUAPM, aficha.ALUNOM, citas.fecha  FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC) $where AND citas.status = 2 $sort $limit");
while ($row = mysql_fetch_assoc($result)) {
   $arrDatos['rows'][] = array(
     'id' => $row['ALUFIC'],
     'cell' => array(
        utf8_encode($row['ALUFIC']),utf8_encode($row['ALUAPP']),utf8_encode($row['ALUAPM']),utf8_encode($row['ALUNOM']),$row['fecha']
     )
  );
}

// pasamos el array a formato json
echo json_encode($arrDatos);

// cerramos la conexion
mysql_close($conex);
?>