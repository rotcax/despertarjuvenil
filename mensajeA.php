<?php
	require 'back/conexion.php';
	include 'back/funcs.php';
	
	if(isset($_GET["id"]) AND isset($_GET['val']))
	{	
		$idUsuario = $_GET['id'];
		$token = $_GET['val'];
		
		$mensaje = validaIdToken($idUsuario, $token);
	}
?>

<!DOCTYPE html>
<html class="no-js">
	<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>!Cuenta Activada¡</title>
    <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href= "css/other.css" rel = "stylesheet">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="css/font-awesome.min.css" rel="stylesheet">

	<link href="css/mdb.css" rel="stylesheet">

	<link href="css/into.css" rel="stylesheet">

	<link rel="shortcut icon" href="img/favicon.ico">

	</head>

	<body style = "background: url(img/fondo/camino.png) no-repeat fixed center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; text-align: center;">

		<div>

		
			<div class = "text" style = "margin-top: 150px">
				<h1 class = "titulo">Estimado Usuario</h1>
				<h3 class = "sub"><?php echo $mensaje; ?></h3>
				
				<button id="btn-signup" type="button" class="btn btn-danger"><a style = "color: white" href = "sesion.php">Iniciar Sesión</a></button>
			</div>

			





		<footer id = "info" style = "margin-top: 200px">
            <p><em>Página Realizada por: Victor Caceres</em></p>
            <p><strong>MVC CORP</strong></p>
        </footer>
			
		</div>

		 <script src="js/jquery-2.1.3.min.js"></script>

        <script src="js/vendor/bootstrap.min.js"></script>

		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

		<script type="text/javascript" src="js/mdb.min.js"></script>
	</body>
</html>