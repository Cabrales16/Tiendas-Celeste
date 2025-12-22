<?php
require('fpdf/fpdf.php');
include_once("conexion.php");

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        // Arial bold 15
        $this->SetFont('Arial','B',25);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(105,10,'Reporte de Usuarios',0,0,'C');
        // Salto de línea
        $this->Ln(15);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L'); // Cambiar a orientación horizontal
$pdf->SetFont('Arial','B',10);

// Cabecera de la tabla
$pdf->Cell(8,10,'No',1);
$pdf->Cell(25.5,10,'USUACODIGO',1);
$pdf->Cell(50,10,'USUANOMBRE',1);
$pdf->Cell(38,10,'USUAUSUARIO',1);
$pdf->Cell(40,10,'USUAPASSWORD',1);
$pdf->Cell(55,10,'USUA_CORREO',1);
// Corrige el tamaño si es necesario
$pdf->Ln();

// Datos de la tabla
$querymodificar = mysqli_query($conexion, "SELECT * FROM usuario ORDER BY USUACODIGO asc");
$numerofila = 0;
while($data = mysqli_fetch_array($querymodificar))
{
    $numerofila++;
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(8,10,$numerofila,1);
    $pdf->Cell(25.5,10,$data['USUACODIGO'],1);
    $pdf->Cell(50,10,($data['USUANOMBRE']),1);
    $pdf->Cell(38,10,$data['USUAUSUARIO'],1);
    $pdf->Cell(40,10,$data['USUAPASSWORD'],1);
    $pdf->Cell(55,10,$data['USUA_CORREO'],1);
    // Corrige el tamaño si es necesario

    $pdf->Ln();
}

// Generar el PDF
$pdf->Output('I', 'Reporte_Usuarios.pdf');
?>
