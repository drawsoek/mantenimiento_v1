<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SINCO</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        border-radius: 10px 10px 10px 10px;
        box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }

    </style>

</head>
<body>
<?php
include("db/conexionMysql.php");
$mysql = new mysql;
$mysql->connect();
	$fallo = false;
	if(!empty($_POST['enviado'])){
		$query = @$mysql->query("SELECT * FROM usuarios where nombre = '".$_POST['usuario']."' and password = '".$_POST['password']."'");
        if(@$result = $mysql->f_array($query)){
			$_SESSION['usuario'] = $result['nombre'];
            $_SESSION['idusuario'] = $result['id_usuario'];
			@header("Location: index.php");
		}else{
			$fallo = true;
		}
	}

	if($fallo){
?>
    <div class="alert alert-error" style="margin:-10px auto 0 auto; width:300px;">
    USUARIO Y/O CONTRASEÑA INCORRECTOS
    </div>
<?php
	}
?>
    <div class="modal" id="myModal">
    <div class="modal-header">
    <h3>Login</h3>
    </div>
    <div class="modal-body">
    <form action="<?= $PHP_SELF; ?>" method="post">
    <fieldset>
    <div class="control-group">
    <label class="control-label" for="user">USUARIO</label>
    <div class="controls">
    <input type="text" class="input-xlarge" id="usuario" name="usuario">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="password">PASSWORD</label>
    <div class="controls">
    <input type="password" class="input-xlarge" id="password" name="password">
    </div>
    </div>
    </fieldset>
    </div>
    <div class="modal-footer">
    <input type="submit" class="btn btn-success" value="Entrar" name="enviado">
    </div>
	</form>
    </div>
</body>
</html>
