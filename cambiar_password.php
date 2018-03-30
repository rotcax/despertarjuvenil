<?php
	require 'back/conexion.php';
	require 'back/funcs.php';
	
	if(empty($_GET['token'])){
		header('Location: sesion.php');
	}
	
	$user_id = $mysqli->real_escape_string($_GET['user_id']);
	$token = $mysqli->real_escape_string($_GET['token']);
	
	if(!verificaTokenPass($user_id, $token))
	{
		echo 'No se pueden verificar los Datos';
		exit;
	} 
?>



<!DOCTYPE html>
<html class="no-js">
	<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cambiar Contraseña</title>
    <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href= "css/other.css" rel = "stylesheet">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="css/mdb.css" rel="stylesheet">

	<link rel="shortcut icon" href="img/favicon.ico">

	</head>

	<body style = "background: url(img/fondo/34B.png) no-repeat fixed center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; text-align: center;">
	
		<div>

		
			<div class = "text">
				<h1 class = "titulo">Ciudadano</h1>
				<h3 class = "sub">Ingrese una nueva contraseña para acceder al sistema</h3>
			</div>


			<div class="container">    
			<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" id = "divt"> 
					
					<div id = "panel" class="panel-body" >
						
						<form id="loginform" class="form-horizontal" role="form" action="guardar_password.php" method="POST" autocomplete="off">
							
							<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
							
							<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
							
							<div id = "bottom" class="input-group">
								<span class="input-group-addon" id = "transp"><i class="glyphicon glyphicon-lock"></i></span>
								<input style = "color: white" id="password" type="password" class="form-control" name="password" placeholder="Nueva Contraseña" required>
							</div>
							
							<div id = "bottom" class="input-group">
								<span class="input-group-addon" id = "transp"><i class="glyphicon glyphicon-lock"></i></span>
								<input style = "color: white" id="password" type="password" class="form-control" name="con_password" placeholder="Confirmar Contraseña" required>
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-info">Modificar</a>
									<button id="btn-signup" type="button" class="btn btn-danger"><a style = "color: white" href = "#">Iniciar Sesión</a></button>
								</div>
							</div>   
						</form>
					</div>                     
				</div>  
			</div>
		</div>

		</div>


		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

		<script type="text/javascript" src="js/mdb.min.js"></script>

	</body>
</html>