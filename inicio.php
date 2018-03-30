<?php
	session_start();
	require 'back/conexion.php';
	require 'back/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: sesion.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html class="no-js">
	<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bienvenido</title>
    <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href= "css/other.css" rel = "stylesheet">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="css/font-awesome.min.css" rel="stylesheet">

	<link href="css/mdb.css" rel="stylesheet">

	<link href="css/into.css" rel="stylesheet">

	<link rel="shortcut icon" href="img/favicon.ico">

	</head>

	<body style = "background: url(img/fondo/road.png) no-repeat fixed center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; text-align: center;">

		<div>

		<div id="top" class="navbar navbar-dark navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>
                    <a class="navbar-brand activar" href="inicio.php"><strong>DESPERTAR</strong> JUVENIL AYACUCHO</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a class = "activar" href="#">Inicio</a></li>
                        <li><a class = "activar" href="solicitud.php">Solicitud</a></li>
                        <li><a class = "activar" href="sitios.php">Sitios</a></li> 
                        <li><a class = "activar" href="cuentas.php">Cuentas</a></li> 
                        <li><a class = "activar" href = "noticias_clap.php">CLAP</a></li>
                        <li><a class = "activar" href = "back/logout.php">Salir</a></li>										
                    </ul>
                </div>
            </div>
        </div>

		
			<div class = "text" style = "margin-top: 60px">
				<h1 class = "titulo">Bienvenido <?php echo utf8_decode($row['nombre']); ?></h1>
				<h3 class = "sub">¡Ya eres parte de nuestra comunidad!</h3>
			</div>

			<br>

			<div id = "solicitud">
				<a class = "boton" href = "solicitud.php"><h2>Solicitar Planillas</h2></a>
			</div>

			<div id = "sitios">
				<a class = "boton" href = "sitios.php"><h2>Sitios Destacados</h2></a>
			</div>

			<br>

			<div id = "cuentas">
				<a class = "boton" href = "cuentas.php"><h2>Números de Cuenta</h2></a>
			</div>

			<div id = "clap">
				<a class = "boton" href = "noticias_clap.php"><h2>Noticias CLAP</h2></a>
			</div>

			<br>

			<?php if($_SESSION['tipo_usuario']==1) { ?>
			<div id = "gestion">
				<a class = "boton" href = "gestion.php"><h2>Gestión de Usuario</h2></a>
			</div>
			<?php } ?>

			<div id = "salir">
				<a class = "boton" href = "back/logout.php"><h2>Salir</h2></a>
			</div>





		<footer id = "info">
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