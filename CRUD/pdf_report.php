<?php
require_once __DIR__ . '/../php/auth.php';
requerir_empleado();
require('fpdf/fpdf.php');
require_once __DIR__ . '/conexion.php';

// FPDF trabaja en ISO-8859-1: se convierte el texto para que las tildes se vean bien.
function t($texto): string
{
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', (string) $texto);
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 25);
        $this->Cell(80);
        $this->Cell(105, 10, 'Reporte de Usuarios', 0, 0, 'C');
        $this->Ln(15);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, t('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$roles = [ROL_EMPLEADO => 'Empleado', ROL_CLIENTE => 'Cliente'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('Arial', 'B', 10);

// Cabecera de la tabla (el reporte original imprimía las contraseñas; ya no)
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(28, 10, t('Código'), 1);
$pdf->Cell(60, 10, 'Nombre', 1);
$pdf->Cell(45, 10, 'Usuario', 1);
$pdf->Cell(80, 10, 'Correo', 1);
$pdf->Cell(30, 10, 'Rol', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$resultado = $conexion->query('SELECT USUACODIGO, USUANOMBRE, USUAUSUARIO, USUA_CORREO, USUAROLFK FROM usuario ORDER BY USUACODIGO ASC');
$n = 0;
while ($d = $resultado->fetch_assoc()) {
    $n++;
    $pdf->Cell(10, 10, $n, 1);
    $pdf->Cell(28, 10, $d['USUACODIGO'], 1);
    $pdf->Cell(60, 10, t($d['USUANOMBRE']), 1);
    $pdf->Cell(45, 10, t($d['USUAUSUARIO']), 1);
    $pdf->Cell(80, 10, t($d['USUA_CORREO']), 1);
    $pdf->Cell(30, 10, t($roles[(int) $d['USUAROLFK']] ?? '-'), 1);
    $pdf->Ln();
}

$pdf->Output('I', 'Reporte_Usuarios.pdf');
