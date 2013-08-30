<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
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
url: 'json.php',

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
		$("#formcontent").hide(1000);
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
    if (id == null)
    {
    	alert("Selecciona una fila por favor");
    }else{
    	elid = $('.trSelected').attr('id');
    	elid = elid.replace("row",'');
    	//alert(elid);
    	$("#formedit").load("getDatos.php", {nombre: elid});
    	$("#formcontent").show('slow');
    }  
}

function recargaGrid(com,grid){
		$("#grid").recargaGridd();
   }

</script>



</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="http://www.medialoot.com">Inicio</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>ID USUARIO (<a href="#">3 Messages</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html">SINCO</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Fichas</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">op1</a></li>
			<li class="icn_edit_article"><a href="#">op2</a></li>
			<li class="icn_categories"><a href="#">op3</a></li>
			<li class="icn_tags"><a href="#">op4</a></li>
		</ul>
		<h3>Reportes</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#">op5</a></li>
			<li class="icn_photo"><a href="#">op6</a></li>
			<li class="icn_audio"><a href="#">op7</a></li>
			<li class="icn_video"><a href="#">op8</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Opciones</a></li>
			<li class="icn_jump_back"><a href="#">Salir</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2013 SINCO</strong></p>
			<p>Residenes 2013</p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 class="alert_info">informativo.</h4>
		
		<article class="module width_full">
			<header><h3>Seguimiento de fichas</h3></header>
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
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Content Manager</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Entry Name</th> 
    				<th>Category</th> 
    				<th>Created On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Lorem Ipsum Dolor Sit Amet</td> 
    				<td>Articles</td> 
    				<td>5th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Ipsum Lorem Dolor Sit Amet</td> 
    				<td>Freebies</td> 
    				<td>6th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Sit Amet Dolor Ipsum</td> 
    				<td>Tutorials</td> 
    				<td>10th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Articles</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Articles</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>  
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Comment</th> 
    				<th>Posted by</th> 
    				<th>Posted On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Lorem Ipsum Dolor Sit Amet</td> 
    				<td>Mark Corrigan</td> 
    				<td>5th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Ipsum Lorem Dolor Sit Amet</td> 
    				<td>Jeremy Usbourne</td> 
    				<td>6th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Sit Amet Dolor Ipsum</td> 
    				<td>Super Hans</td> 
    				<td>10th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Alan Johnson</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Dobby</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
			</tbody> 
			</table>

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<article class="module width_quarter">
			<header><h3>Messages</h3></header>
			<div class="message_list">
				<div class="module_content">
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
				</div>
			</div>
			<footer>
				<form class="post_message">
					<input type="text" value="Message" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
					<input type="submit" class="btn_post_message" value=""/>
				</form>
			</footer>
		</article><!-- end of messages article -->
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Post New Article</h3></header>
				<div class="module_content">
						<fieldset>
							<label>Post Title</label>
							<input type="text">
						</fieldset>
						<fieldset>
							<label>Content</label>
							<textarea rows="12"></textarea>
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Category</label>
							<select style="width:92%;">
								<option>Articles</option>
								<option>Tutorials</option>
								<option>Freebies</option>
							</select>
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Tags</label>
							<input type="text" style="width:92%;">
						</fieldset><div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<select>
						<option>Draft</option>
						<option>Published</option>
					</select>
					<input type="submit" value="Publish" class="alt_btn">
					<input type="submit" value="Reset">
				</div>
			</footer>
		</article><!-- end of post new article -->
		
		<h4 class="alert_warning">A Warning Alert</h4>
		
		<h4 class="alert_error">An Error Message</h4>
		
		<h4 class="alert_success">A Success Message</h4>
		
		<article class="module width_full">
			<header><h3>Basic Styles</h3></header>
				<div class="module_content">
					<h1>Header 1</h1>
					<h2>Header 2</h2>
					<h3>Header 3</h3>
					<h4>Header 4</h4>
					<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>

<p>Donec id elit non mi porta <a href="#">link text</a> gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>

					<ul>
						<li>Donec ullamcorper nulla non metus auctor fringilla. </li>
						<li>Cras mattis consectetur purus sit amet fermentum.</li>
						<li>Donec ullamcorper nulla non metus auctor fringilla. </li>
						<li>Cras mattis consectetur purus sit amet fermentum.</li>
					</ul>
				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>


</body>

</html>