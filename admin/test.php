<?php

$ie = false;
if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)) $ie = true;
if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)) $ie = true;


if($ie){
	echo "SI";

} else {
  //IE Detected
?>
<div class="sie-content">
  <div class="login-text">
    <h1 class="title">El acceso esta bloqueado para Internet Explorer y similares</h1>  
    <p class="login-p">Recomendamos actualices el navegador a <a class="browser" href="https://www.google.com/intl/es/chrome/browser/?hl=es" target="_blank">Chrome</a> o <a class="browser" target="_blank" href="http://www.mozilla.org/es-MX/firefox/new/">Firefox</a>. Da clic en el nombre para bajar el que deseas.</p>
  </div>
</div>
<?php  
}
?>

