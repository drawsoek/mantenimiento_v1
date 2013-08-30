<?php
session_start();


if(empty($_SESSION['usuario'])){
include("login.php");


}else{
	if($_SESSION['usuario'] == "ITC"){

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Admin Panel</title>
	<!-- ###### En memoria de Juan Antonio Gamez Acosta [Pukker] 2013 ###### -->
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<link href="css/bootstrap.css" rel="stylesheet">
		<!-- incluimos el jquery -->
	 <script src="http://code.jquery.com/jquery.js"></script>
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>-->
	<script src="js/hideshow.js" type="text/javascript"></script>
	<!--<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<link rel="stylesheet" type="text/css" href="css/flexigrid.css" />

	<!-- incluimos el plugin -->
	<script type="text/javascript" src="js/flexigrid.js"></script>
<!-- establecemos las configuraciones -->
<script type="text/javascript">
$(document).ready(function(){

$("#grid").flexigrid({

/* indicamos la dirección del archivo que desde el servidor se encarga de
acceder a la base de datos, puede ser un XML o una cadena en formato JSON
devuelta por un archivo PHP, por ejemplo.
*/
<?php
	switch($_GET['o']){
		case "c": echo "url: 'json2.php',";
		break;
		case "t": echo "url: 'json3.php',";
		break;
		case "re": echo "url: 'json4.php',";
		break;
		default: echo "url: 'json.php',";
		
	}
/*
	if($_GET['o']=="c"){
		echo "url: 'json2.php',";
	}else{
		echo "url: 'json.php',";
	}
 */
?>


// indicamos en que formato se manejaran los datos
dataType: 'json',

/* establecemos una lista de columnas a usar, indicando :
  display -> el nombre que vera el usuario
  name -> nombre interno de la columna
  width -> anchura de la columna
  sortable -> si la columna se puede ordenar
  align -> la alineación del texto.
*/

colModel : [
  {display: 'Ficha', name : 'ALUFIC', width : 60, sortable : true, align: 'center'},
  {display: 'Ap. Paterno', name : 'ALUAPP', width : 140, sortable : true, align: 'center'},
  {display: 'Ap. Materno', name : 'ALUAPM', width : 140, sortable : true, align: 'left'},
  {display: 'Nombre', name : 'ALUNOM', width : 180, sortable : true, align: 'left'}
   	<?php
  if($_GET['o']=="c" || $_GET['o' == "re"]){
  	echo ",{display: 'Fecha de la cita', name : 'fecha', width : 100, sortable : true, align: 'left'}";
  }
  ?>
],

/* agregamos los botones que apareceran en la barra de herramientas
por ejemplo, botones para añadir, editar y eliminar registros.
con la propiedad BClass indicamos el tipo de boton, se establecera asi
la imagen de fondo para el botón
ejemplo: {name: 'Eliminar', bclass: 'add', onpress : funcion_eliminar}
*/
buttons : [
  {name: 'Editar', bclass: 'edit', onpress: editFicha},
  {separator: true},
  {name: 'Recargar', bclass: 'reload', onpress: recargaGrid},
  {separator: true}
],

// indicamos que columnas se pueden usar para filtrar las busquedas
searchitems : [
  {display: 'Ficha', name : 'ALUFIC'},
   	<?php
  if($_GET['o']=="c" || $_GET['o' == "re"]){
  	echo "{display: 'Fecha', name : 'fecha'},";
  }
  ?>
  {display: 'Nombre', name : 'ALUNOM', isdefault: true}
],

// indicamos el nombre de la columna con la
// q se ordenaran los registros por defecto
sortname: "ALUFIC",

// indicamos que por defecto los registros se mostraran ascendentemente
sortorder: "asc",

// esta propiedad permite activar o desactivar los botones de navegación de la página
usepager: true,

// titulo que aparecerá en la ventana
title: 'Fichas',

// indicamos si se permite al usuario especificar el número de resultados por página.
useRp: true,

// numero de registros a mostrar, por defecto 10
rp: 10,

singleSelect: true,

// esta propiedad permite establecer si se puede o no, minimizar la Flexigrid
// (icono en la esquina superior derecha)
showTableToggleBtn: false,

// ancho de la flexigrid por defecto
width: 730,

// alto de la flexigrid por defecto
height: 255

});
	//Cierra el div del edita form
	$("#hide_form").click(function () {
		$("#formcontent").hide();
		$("#formedit").text("Cargando...");
	});

$("#formcontent").on("click", "#finalizar_btn", function(event){
    $("#formcontent").hide();
});

$("#formcontent").on("click", "#cancel_btn", function(event){
    $("#formcontent").hide();
	$("#formedit").text("Cargando...");
});

$("#formcontent").on("click", "#pendiente_btn", function(event){
    $("#formcontent").hide();
	$("#formedit").text("Cargando...");
	$("#formedit").load("pendiente.php", {nombre: $('#idficha').val()});
});

});//cierre de onready

// funcion para los botones de filtro
function editFicha(com,grid){
   $('#grid').flexOptions({
      // indicamos los parametros del filtro
      /*
      newp:1, params:[
         {name:'letter_pressed', value: com},
         {name:'qtype',value:$('select[name=qtype]').val()}
      ]
      */

   });

	//conseguimos el valor del id
	var id = $('.trSelected').attr('id');
	//  comprobamos que se haya seleccionado
    //if (id == null)
    if (false)
    {
    	alert("Selecciona una fila por favor");
    }else{
    	/*
    	elid = $('.trSelected').attr('id');
    	elid = elid.replace("row",'');
    	$('#idficha').val(elid);
    	//alert(elid);
    	$("#formedit").text("Cargando..");
    	*/
    	<?php
	if($_GET['o']=="c" || $_GET[o] == "t" ){
		//echo "$(\"#formedit\").load(\"getDatos2.php\", {nombre: elid});";
		echo "$(\"#formedit\").load(\"getDatos.php\", {nombre: 'si'});";
	}else{
		//echo "$(\"#formedit\").load(\"getDatos.php\", {nombre: elid});";
		echo "$(\"#formedit\").load(\"getDatos.php\", {nombre: 'si'});";
	}
		?>
    	
    	$("#formcontent").show('slow');
    }  
}

function recargaGrid(com,grid){
		$("#grid").recargaGridd();
   }

</script>



</head>


<body>
<input type="hidden" name="idficha" id="idficha">
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="index.php">Inicio</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>ID USUARIO <!--(<a href="#">3 Messages</a>)--></p>
			<a class="logout_user" href="logout.php" title="Logout">Logout</a>
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.php">SINCO</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Busqueda" onFocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>

		<h3>Solicitudes</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="index.php?o=ns">Nueva solicitud</a></li>
			<li class="icn_categories"><a href="index.php?o=c">Seguimiento de sol.</a></li>
		</ul>

		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="index.php">Solicitudes</a></li>
			<li class="icn_categories"><a href="index.php?o=c">Ordenes de trabajo</a></li>
			<li class="icn_categories"><a href="index.php?o=re">Nueva orden de trabajo</a></li>
		</ul>
		<h3>Reportes</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="index.php?o=r">REPORTE</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_jump_back"><a href="logout.php">Salir</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2013 SINCO</strong></p>
			<p>Residenes 2013</p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<?php
				include("db/conexionMysql.php");
				$mysql = new mysql;
				$mysql->connect();

				$sql = $mysql->query("SELECT COUNT(*) as fichas FROM citas WHERE fecha = CURDATE()")or die(mysql_error());
				$result = $mysql->f_array($sql);

				$sql_ambiental = $mysql->query("SELECT COUNT(*) as fichas FROM citas WHERE fecha = CURDATE() and CARCVE1 = '18'")or die(mysql_error());
				$result_ambiental = $mysql->f_array($sql_ambiental);

				$sql_renovable = $mysql->query("SELECT COUNT(*) as fichas FROM citas WHERE fecha = CURDATE() and CARCVE1 = '19'")or die(mysql_error());
				$result_renovable = $mysql->f_array($sql_renovable);

				$sql_bioquimica = $mysql->query("SELECT COUNT(*) as fichas FROM citas WHERE fecha = CURDATE() and CARCVE1 = '6'")or die(mysql_error());
				$result_bioquimica = $mysql->f_array($sql_bioquimica);
				
				$sql_tics = $mysql->query("SELECT COUNT(*) as fichas FROM citas WHERE fecha = CURDATE() and CARCVE1 = '16'")or die(mysql_error());
				$result_tics = $mysql->f_array($sql_tics);

		?>
		<h4 class="alert_info">Citas hoy: <?= $result['fichas'] ?> &nbsp;&bull;&nbsp; Ing.Ambiental: <?= $result_ambiental['fichas'] ?> &nbsp;&bull;&nbsp; Ing. Renovable: <?= $result_renovable['fichas'] ?> &nbsp;&bull;&nbsp; Ing. Bioquimica: <?= $result_bioquimica['fichas'] ?> &nbsp;&bull;&nbsp; Ing. TICS: <?= $result_tics['fichas'] ?></h4>
		<!-- <h4 class="alert_success">AVISO: El nombre de los padres ya sale correcto, en el menu "TODAS LAS CITAS" ya pueden buscar por fecha de cita.</h4> -->

<?php
	if($_GET['o'] == "r"){
?>
		<article class="module width_full">

			<header><h3>REPORTES</h3></header>
			<div class="module_content">
				<!-- CONTENT OLD
				<article class="stats_graph">
					<img src="http://chart.apis.google.com/chart?chxr=0,0,3000&chxt=y&chs=520x140&cht=lc&chco=76A4FB,80C65A&chd=s:Tdjpsvyvttmiihgmnrst,OTbdcfhhggcTUTTUadfk&chls=2|2&chma=40,20,20,30" width="520" height="140" alt="" />
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Today</p>
						<p class="overview_count">1,876</p>
						<p class="overview_type">Hits</p>
						<p class="overview_count">2,103</p>
						<p class="overview_type">Views</p>
					</div>
					<div class="overview_previous">
						<p class="overview_day">Yesterday</p>
						<p class="overview_count">1,646</p>
						<p class="overview_type">Hits</p>
						<p class="overview_count">2,054</p>
						<p class="overview_type">Views</p>
					</div>
				</article>
			-->
			<?
				$s_rbio = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 1 AND aficha.CARCVE1 = 6")or die(mysql_error());
				$r_rbio = $mysql->f_array($s_rbio);

				$s_rtics = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 1 AND aficha.CARCVE1 = 16")or die(mysql_error());
				$r_rtics = $mysql->f_array($s_rtics);
				
				$s_rambiental = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 1 AND aficha.CARCVE1 = 18")or die(mysql_error());
				$r_rambiental = $mysql->f_array($s_rambiental);
				
				$s_renovable = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 1 AND aficha.CARCVE1 = 19")or die(mysql_error());
				$r_rrenovable = $mysql->f_array($s_renovable);


				$s_arbio = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 3 AND aficha.CARCVE1 = 6")or die(mysql_error());
				$r_arbio = $mysql->f_array($s_arbio);

				$s_artics = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 3 AND aficha.CARCVE1 = 16")or die(mysql_error());
				$r_artics = $mysql->f_array($s_artics);
				
				$s_arambiental = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 3 AND aficha.CARCVE1 = 18")or die(mysql_error());
				$r_arambiental = $mysql->f_array($s_arambiental);
				
				$s_arenovable = $mysql->query("SELECT COUNT(aficha.ALUFIC) as fichas FROM aficha INNER JOIN citas ON (aficha.ALUFIC = citas.ALUFIC)  AND citas.status = 3 AND aficha.CARCVE1 = 19")or die(mysql_error());
				$r_arrenovable = $mysql->f_array($s_arenovable);

			?>
					<article class="stats_overview">
						<div style="width: 100%; margin-left: 10px;">&bull;<strong>Fichas por atender(con cita)</strong></div>
					<div class="overview_today">
						<!--<p class="overview_day">Today</p>-->
						<p class="overview_count"><?= $r_rbio['fichas'] ?></p>
						<p class="overview_type">BIOQUIMICA</p>
						<p class="overview_count"><?= $r_rtics['fichas'] ?></p>
						<p class="overview_type">TICS</p>
					</div>
					<div class="overview_previous">
						<!-- <p class="overview_day">Yesterday</p> -->
						<p class="overview_count"><?= $r_rambiental['fichas'] ?></p>
						<p class="overview_type">AMBIENTAL</p>
						<p class="overview_count"><?= $r_rrenovable['fichas'] ?></p>
						<p class="overview_type">RENOVABLES</p>
					</div>
				</article>
				<article class="stats_overview">
						<div style="width: 100%; margin-left: 10px;">&bull;<strong>Fichas atendidas</strong></div>
					<div class="overview_today">
						<!--<p class="overview_day">Today</p>-->
						<p class="overview_count"><?= $r_arbio['fichas'] ?></p>
						<p class="overview_type">BIOQUIMICA</p>
						<p class="overview_count"><?= $r_artics['fichas'] ?></p>
						<p class="overview_type">TICS</p>
					</div>
					<div class="overview_previous">
						<!-- <p class="overview_day">Yesterday</p> -->
						<p class="overview_count"><?= $r_arambiental['fichas'] ?></p>
						<p class="overview_type">AMBIENTAL</p>
						<p class="overview_count"><?= $r_arrenovable['fichas'] ?></p>
						<p class="overview_type">RENOVABLES</p>
					</div>
				</article>
			<!-- REPORTE ANTERIOR 
			<strong>Fichas por atender</strong>
			<p>FICHAS DE BIOQUIMICA (con cita): <?= $r_rbio['fichas'] ?></p>
			<p>FICHAS TICS (con cita): <?= $r_rtics['fichas'] ?></p>
			<p>FICHAS INGENIERIA AMBIENTAL (con cita): <?= $r_rambiental['fichas'] ?></p>
			<p>FICHAS INGENIERIA EN ENERGIAS RENOVABLES (con cita): <?= $r_rrenovable['fichas'] ?></p>
			<hr>
			<strong>Fichas atendidas</strong>
			<p>FICHAS DE BIOQUIMICA: <?= $r_arbio['fichas'] ?></p>
			<p>FICHAS TICS: <?= $r_artics['fichas'] ?></p>
			<p>FICHAS INGENIERIA AMBIENTAL: <?= $r_arambiental['fichas'] ?></p>
			<p>FICHAS INGENIERIA EN ENERGIAS RENOVABLES: <?= $r_arrenovable['fichas'] ?></p>
			-->
				<div class="clear"></div>
			</div>
	</article><!-- end of stats article -->
<?php
}
?>

<?php

switch($_GET['o']){
	case "ns": include("solicitud/nsolicitud.php");
	break;
	case "test1": include("solicitud/sol1.php");
	break;
	case "test2": include("solicitud/sol4.php");
	break;

}
?>


		<div class="spacer"></div>
		
				<article class="module width_full">

			<header><h3>
				<?php if($_GET['o'] != "c") { echo "Seguimiento de fichas"; }else{ echo "TODAS LAS CITAS"; } ?></h3></header>
			<div class="module_content">
				<!-- CONTENT OLD
				<article class="stats_graph">
					<img src="http://chart.apis.google.com/chart?chxr=0,0,3000&chxt=y&chs=520x140&cht=lc&chco=76A4FB,80C65A&chd=s:Tdjpsvyvttmiihgmnrst,OTbdcfhhggcTUTTUadfk&chls=2|2&chma=40,20,20,30" width="520" height="140" alt="" />
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Today</p>
						<p class="overview_count">1,876</p>
						<p class="overview_type">Hits</p>
						<p class="overview_count">2,103</p>
						<p class="overview_type">Views</p>
					</div>
					<div class="overview_previous">
						<p class="overview_day">Yesterday</p>
						<p class="overview_count">1,646</p>
						<p class="overview_type">Hits</p>
						<p class="overview_count">2,054</p>
						<p class="overview_type">Views</p>
					</div>
				</article>
			-->

			<div id="formcontent" style="border:1px solid #d2d2d2; border-radius:5px; display:none; margin-bottom:5px;">
				<div id="hide_form" style="float:right;"><img src="images/icn_alert_error.png"></div>
				<div id="formedit"></div>
			</div>
			<table id="grid" style="display:none"></table>

				<div class="clear"></div>
			</div>
	</article><!-- end of stats article -->
		
	</section>


</body>

</html>
<?php

	}
}

?>