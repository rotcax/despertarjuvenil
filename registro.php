<?php

    require 'back/conexion.php';
    require 'back/funcs.php';

   $errors = array();
    
    if(!empty($_POST))
    {
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $con_password = $mysqli->real_escape_string($_POST['con_password']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
        $activo = 0;
        $tipo_usuario = 2;
        $secret = '6LfTeRkUAAAAALAs8BLwFcGw7r6f6oGDTumkRgE_';
        
        if(!$captcha){

            $errors[] = "Debe verifica el captcha";
        }

        if(isNull($nombre, $usuario, $password, $con_password, $email))
		{
			$errors[] = "Debe llenar todos los campos";
		}
        
        if(!isEmail($email))
        {
            $errors[] = "La dirección de correo introducida es inválida";
        }
        
        if(!validaPassword($password, $con_password))
        {
            $errors[] = "Las contraseñas deben de coincidir";
        }       
        
        if(usuarioExiste($usuario))
        {
            $errors[] = "El nombre de usuario $usuario ya existe";
        }
        
        if(emailExiste($email))
        {
            $errors[] = "El correo electronico $email ya existe";
        }
        
        if(count($errors) == 0)
        {
            
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
            
            $arr = json_decode($response, TRUE);
            
            if($arr['success'])
            {
                
                $pass_hash = hashPassword($password);
                $token = generateToken();
                
                $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);         
                if($registro > 0)
                {               
                    $url = 'http://'.$_SERVER["SERVER_NAME"].'/despertarjuvenil/mensajeA.php?id='.$registro.'&val='.$token;
                    
                    $asunto = 'Activar Cuenta - Sistema de Usuarios';
                    $cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, haga click aqui <a href='$url'>Activar Cuenta</a>";
                    
                    if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
                        
                        echo "<script type=\"text/javascript\">window.location='mensaje1.php';</script>";
                        exit;
                        
                        } else {
                        $erros[] = "Error al enviar Email";
                    }
                    
                    } else {
                    $errors[] = "Error al Registrar";
                }
                
                } else {
                $errors[] = 'Error al comprobar Captcha';
            }
        }
    }
?>


<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Registro de Usuarios</title>
        <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
 
        <link rel="stylesheet" href="owl-carousel/owl.theme.css">
        
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <link href="css/mdb.css" rel="stylesheet">

        <link href = "css/other.css" rel = "stylesheet">

        <link href = "css/sweetalert.css" rel = "stylesheet">

        <link rel="shortcut icon" href="img/favicon.ico">
        
    </head>

    <body>
       <div id="top" class="navbar navbar-dark navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>
                    <a class="navbar-brand" href="index.php"><strong>DESPERTAR</strong> JUVENIL AYACUCHO</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="quienes_somos.php">¿Quienes Somos?</a></li>
                        <li><a href="comites.php">Comites</a></li> 
                        <li class = "active"><a href="registro.php">Registrate</a></li> 
                        <li><a href = "sesion.php">Ingresar</a></li>
                        <li><a href = "noticias.php">Noticias</a></li>                   
                        <li><a href = "soporte.php">Soporte</a></li>  
                        <li><a href = "denuncias.php">Denuncias</a></li>
                        <li><a href="ubicacion.php">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="carousel-header" class="carousel slide" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/carrusel/calle.png" alt="">
                </div>
        </div>

        <div id="about" class="content-block content-block-cyan">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h1 align="center">No esperes más ¡Regístrate!</h1>
                        
                    </div>
                </div>
            </div>
        </div>



        <div class = "container">
            <div id = "signupbox" class = "mainbox col-md-8 col-md-offset-2" style = "margin-top: 15px">
                <div class = "panel panel-info" style = "background: rgba(0,0,0,0.4);">
                    <div class="panel-body" >
                        
                        <form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" name = "datos">
                            
                            <div class="form-group">
                                <div class="md-form col-sm-12">
                                    <input type="text" class="form-control sub" name = "nombre" id = "nombre" value = "<?php if(isset($nombre)) echo $nombre; ?>" required>
                                    <label for="nombre" class = "col-md-3">Nombre:</label>
                                 </div>
                            </div>
                            
                            <div class = "form-group">            
                                <div class="md-form col-sm-12">
                                    <input type="text" class="form-control sub" name = "usuario" id = "usuario" value = "<?php if(isset($usuario)) echo $usuario; ?>" required>
                                    <label for="usuario" class = "col-md-3">Usuario:</label>
                                </div>
                            </div>

                            <div class = "form-group">
                                 <div class="md-form col-sm-12">
                                    <input type="email" class="form-control sub" name = "email" id = "email" value = "<?php if(isset($email)) echo $email; ?>" required>
                                    <label for="email" class = "col-md-3">Correo:</label>
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class="md-form col-sm-12">
                                    <input type="password" class="form-control sub" name  = "password" id = "contraseña" required>
                                    <label for="password" class = "col-md-3">Contraseña:</label>
                                </div>
                            </div>

                            <div class = "form-group">
                                 <div class="md-form col-sm-12">
                                    <input type="password" class="form-control sub" name = "con_password" id = "confirmar" required>
                                    <label for="password" class = "col-md-6">Confirme Su Contraseña:</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="captcha" class="col-md-3"></label>
                                <div class="g-recaptcha col-md-9" data-sitekey="6LfTeRkUAAAAAOcem2TIw5pvYwRyyCPx4n7B-vjt"></div>
                            </div>
                            
                            <div class="form-group">    
                                <center>                                  
                                     <button id="btn-signup" type="submit" class="btn btn-info" name = "enviar_btn">Registrar</button>
                                     <button id="btn-signup" type="button" class="btn btn-danger"><a style = "color: white" href = "sesion.php">Iniciar Sesión</a></button> 
                                </center>
                            </div>
                        </form>

                        <?php echo resultBlock($errors); ?>
                    </div>
                </div>
                </div>
            </div>
       

        
        <footer class="content-block content-block-dark">
            <p><em>Página Realizada por: Victor Caceres</em></p>
            <p><strong>MVC CORP</strong></p>
        </footer>  

        <script src="js/jquery-2.1.3.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

        <script src="js/vendor/bootstrap.min.js"></script>
     
        <script src="owl-carousel/owl.carousel.js"></script>

        <script src="js/main.js"></script>

        <script type="text/javascript" src="js/mdb.min.js"></script>

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script src = "js/sweetalert.min.js"></script>

        <script src = "js/validaciones.js"></script>

    </body>

</html>