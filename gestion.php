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
?>


<!DOCTYPE html>
<html class="no-js">
	<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestión de Usuarios</title>
    <meta name="description" content="Pagina para toda la informacion del consejo comunal despetar juvenil ayacucho">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link href="css/font-awesome.min.css" rel="stylesheet">

	<link href="css/mdb.css" rel="stylesheet">

	<link href="css/into.css" rel="stylesheet">

	<link href="css/dataTables.bootstrap.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

	</head>

	<body style = "background-color: #333">
		

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
                        <li><a class = "activar" href="inicio.php">Inicio</a></li>
                        <li><a class = "activar" href="solicitud.php">Solicitud</a></li>
                        <li><a class = "activar" href="sitios.php">Sitios</a></li> 
                        <li><a class = "activar" href="cuentas.php">Cuentas</a></li> 
                        <li><a class = "activar" href = "noticias_clap.php">CLAP</a></li>
                        <li><a class = "activar" href = "back/logout.php">Salir</a></li>										
                    </ul>
                </div>
            </div>
        </div>


<div class = "container" style = "background: rgba(0,0,0,0.4); margin-top: 100px">

        <div class="panel panel-default" style = "margin-top: 15px">
                        <div class="panel-heading">
                             Tabla de registros
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tabla">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
											<th>Correo</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>

                    <button id="btn-signup" type="button" class="btn btn-info"><a style = "color: white" href = "reporte.php">Generar Reporte</a></button> 

 </div>


        <div class = "modal fade" id = "confirm-delete" tabindex = "-1" role ="dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>
						<h4>Eliminar Registro</h4>
					</div>

					<div class = "modal-body">
						¿Desea eliminar este registro?
					</div>

					<div class = "modal-footer">
						<button type = "button" class = "btn btn-default" data-dismiss = "modal">Cancelar</button>
						<a class = "btn btn-danger btn-ok">Eliminar</a>
					</div>
				</div>
			</div>
		</div>
		
			




		<footer style = "margin-top: 100px">
            <p><em>Página Realizada por: Victor Caceres</em></p>
            <p><strong>MVC CORP</strong></p>
        </footer>
			
		

		 <script src="js/jquery-2.1.3.min.js"></script>

		 <script src="js/jquery-1.10.2.js"></script>

        <script src="js/vendor/bootstrap.min.js"></script>

		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

		<script type="text/javascript" src="js/mdb.min.js"></script>

		<script src="js/jquery.dataTables.js"></script>
    	<script src="js/dataTables.bootstrap.js"></script>

        <script>
            $(document).ready(function(){

                $('#tabla').DataTable({

                    "order": [[1, "asc"]],
                    "language":{

                        "lengthMenu": "Mostrar _MENU_ registros por pagina",
                        "info": "Pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrada de _MAX_ registros)",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords":    "No se encontraron registros coincidentes",

                        "paginate": {

                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },                  
                    },

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "cargar_gestion.php"
                }); 
            });
        </script>

    	<script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                
                $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        </script>
    	
	</body>
</html>