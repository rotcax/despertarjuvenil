<?php
	
	require 'fpdf/fpdf.php';

	class PDF extends FPDF{

		function Header(){

			$this->SetX(25);
			//$this->Image('img/.png', 5, 5, 30);
			$this->SetFont('Arial', 'B', 15);
			$this->Cell(25);
			$this->Cell(120, 10, 'Reporte De Usuarios Registrados', 0, 0, 'C');
			$this->Ln(25);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0, 10, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
		}
	}
?>