
<?php
require('fpdf.php');

$pdf = new FPDF('P','mm','Letter');
$pdf->SetMargins(0, 0, 0);
$pdf->SetXY(0, 0);


$pdf->SetFont('Arial','B',16);
$pdf->AddPage();

//imagen de fondo
$this->Image('solmtto.jpg',10,8,33);
$pdf->Output();
?>