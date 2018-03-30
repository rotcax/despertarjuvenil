<?php

	session_start();
	session_destroy();

	header('location: '.'/despertarjuvenil/sesion.php');
?>