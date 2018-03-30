<?php
	require 'back/conexion.php';
	require 'back/funcs.php';

	$errors = array();
	
	if(!empty($_POST))
	{
		$email = $mysqli->real_escape_string($_POST['email']);
		
		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}
		
		if(emailExiste($email))
		{			
			$user_id = getValor('id', 'correo', $email);
			$nombre = getValor('nombre', 'correo', $email);
			
			$token = generaTokenPass($user_id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/despertarjuvenil/cambiar_password.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Password - Despertar Juvenil Ayacucho';
			$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>Cambiar Contrase&ntilde;a</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				echo "<script type=\"text/javascript\">window.location='mensaje2.php';</script>";
				exit;
			}else{

				$errors[] = "Error al enviar Email";
			}
			}else {
			$errors[] = "La direccion de correo electronico no existe";
		} 
	}
?>


<!DOCTYPE html>
<html class="no-js">
	<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recuperar Sesión</title>
    <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href= "css/other.css" rel = "stylesheet">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="css/mdb.css" rel="stylesheet">

	<link href = "css/sweetalert.css" rel = "stylesheet">

	<link rel="shortcut icon" href="img/favicon.ico">

	</head>

	<body style = "background: url(img/fondo/soporte-pc.png) no-repeat fixed center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; text-align: center;">

		<div>

		
			<div class = "text">
				<h1 class = "titulo">¿Olvido su Contraseña?</h1>
				<h3 class = "sub">Ingrese su correo electrónico y le ayudaremos a recuperarla</h3>
			</div>


			<div class="container">    
			<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" id = "divt"> 
					
					<div id = "panel" class="panel-body" >
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" name = "proceso">
							
							<div id = "bottom" class="input-group">
								<span class="input-group-addon" id = "transp"><i class="glyphicon glyphicon-user"></i></span>
								<input style = "color: white" id="usuario" type="email" class="form-control" name="email" value="" placeholder="Email" required>                                        
							</div>
							
							<div id = "margen" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success" name = "aceptar">Enviar</a>
									<button id="btn-signup" type="button" class="btn btn-danger"><a style = "color: white" href = "#">Regresar</a></button> 
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div class = "col-md-12 control sub">
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

		</div>


		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

		<script type="text/javascript" src="js/mdb.min.js"></script>

		<script src = "js/sweetalert.min.js"></script>

	</body>
</html>