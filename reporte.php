<?php
	
	include 'back/page.php';
	require 'back/conexion.php';

	$query = "SELECT usuario, nombre, correo FROM usuarios";
	$resultado = $mysqli->query($query);

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232, 232, 232, 232);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetX(25);
	$pdf->Cell(30, 6, 'USUARIO', 1, 0, 'C', 1);
	$pdf->Cell(20, 6, 'NOMBRE', 1, 0, 'C', 1);
	$pdf->Cell(60, 6, 'CORREO', 1, 1, 'C', 1);

	$pdf->SetFont('Arial', '', 10);

	while($row = $resultado->fetch_assoc()){
		
		$pdf->SetX(25);
		$pdf->Cell(30, 6, $row['usuario'], 1, 0, 'C');
		$pdf->Cell(20, 6, $row['nombre'], 1, 0, 'C');
		$pdf->Cell(60, 6, $row['correo'], 1, 1, 'C');
	}

	$pdf->Output();
?>