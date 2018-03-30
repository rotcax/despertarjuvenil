<?php
	require 'back/conexion.php';
	require 'back/funcs.php';
	
	session_start();
	
	if(isset($_SESSION["id_usuario"])){

		header("Location: inicio.php");
	}
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		$errors[] = login($usuario, $password);	
	}
?>


<!DOCTYPE html>
<html class="no-js">
	<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar Sesión</title>
    <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href= "css/other.css" rel = "stylesheet">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="css/mdb.css" rel="stylesheet">

	<link href = "css/sweetalert.css" rel = "stylesheet">

	<link rel="shortcut icon" href="img/favicon.ico">

	</head>

	<body style = "background: url(img/fondo/rostro.png) no-repeat fixed center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; text-align: center;">

		<div>

		
			<div class = "text">
				<h1 class = "titulo">Adelante Ciudadano</h1>
				<h3 class = "sub">Inicie su sesión y conozca todo sobre su comunidad</h3>
			</div>


			<div class="container">    
			<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" id = "divt"> 
					
					<div id = "panel" class="panel-body" >
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" name = "proceso">
							
							<div id = "bottom" class="input-group">
								<span class="input-group-addon" id = "transp"><i class="glyphicon glyphicon-user"></i></span>
								<input style = "color: white" id="usuario" type="text" class="form-control" name="usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" placeholder="usuario o email" required>                                        
							</div>
							
							<div id = "bottom" class="input-group">
								<span class="input-group-addon" id = "transp"><i class="glyphicon glyphicon-lock"></i></span>
								<input style = "color: white" id="password" type="password" class="form-control" name="password" placeholder="password" required>
							</div>
							
							<div id = "margen" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success" name = "aceptar">Iniciar Sesi&oacute;n</a>
									<button id="btn-signup" type="button" class="btn btn-danger"><a style = "color: white" href = "index.php">Regresar</a></button> 
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div id = "linea">
										<a href="recuperar_password.php" id ="texto">¿Se te olvid&oacute; tu contraseña?</a>
									</div>
									<div class = "col-md-12 control sub" id = "margen">
									No tiene una cuenta! <a href="registro.php" id = "texto">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
						<?php echo resultBlock($errors); ?>
					</div>                     
				</div>  
			</div>
		</div>

		<footer class = "sub" id = "margen">
            <p><em>Página Realizada por: Victor Caceres</em></p>
            <p><strong>MVC CORP</strong></p>
        </footer>

		</div>


		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

		<script type="text/javascript" src="js/mdb.min.js"></script>

		<script src = "js/sweetalert.min.js"></script>

		<script src = "js/alerta.js"></script>
	</body>
</html>