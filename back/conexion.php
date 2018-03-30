<?php

	$mysqli = new mysqli("localhost", "root", "", "despertarjuvenil");

	if(mysqli_connect_errno()){

		echo 'Conexion Fallida con la BBDD: ', mysqli_connect_error();
		exit();
	}
?>