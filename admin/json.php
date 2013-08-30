<?php
header("Content-type: text/x-json");

// nos conectamos
$conex = mysql_connect('localhost','root','123456')or die ('Error: imposible conectar con MySQL');
//$conex = mysql_connect('localhost','root','root')or die ('Error: imposible conectar con MySQL');
// seleccionamos la db
$db = mysql_select_db('mantenimiento')or die ('Error: no se puede seleccionar la base de datos');

// armamos las condiciones segun sea el caso ..
if($_POST['query']!=''){
	$where = "WHERE ".mysql_real_escape_string($_POST['qtype'])." LIKE '%".
mysql_real_escape_string($_POST['query'])."%' ";
}elseif($_POST['letter_pressed']!=''){
   $where = "WHERE ".mysql_real_escape_string($_POST['qtype'])." LIKE '".
mysql_real_escape_string($_POST['letter_pressed'])."%' ";
}elseif($_POST['letter_pressed']=='#'){
   $where = "WHERE ".mysql_real_escape_string($_POST['qtype'])." REGEXP '[[:digit:]]' ";
}else{
   $where ='WHERE id_usuario = 1';
}
// conseguimos el total de registros
$result = mysql_query('SELECT COUNT(id_usuario) FROM solicitudes_mto where id_usuario = 1');
$row = mysql_fetch_array($result);
$total = $row[0];

// ordenar por X campo
$sortname = empty($_POST['sortname']) ? 'fecha' : mysql_real_escape_string($_POST['sortname']);

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

$result = mysql_query("SELECT id_solicitud, fecha, descripcion, depto, id_status FROM solicitudes_mto $where $sort $limit");
while ($row = mysql_fetch_assoc($result)) {
   $arrDatos['rows'][] = array(
     'id' => $row['id_solicitud'],
     'cell' => array(
        utf8_encode($row['fecha']),utf8_encode($row['descripcion']),$row['depto'], $row['id_status']
     )
  );
}

// pasamos el array a formato json
echo json_encode($arrDatos);

// cerramos la conexion
mysql_close($conex);
?>